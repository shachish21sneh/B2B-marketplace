<?php

$dbSeederPath = __DIR__ . '/../database/seeders/DatabaseSeeder.php';
$upCitiesSeederPath = __DIR__ . '/seed_all_up_suppliers.php';

$upCode = file_get_contents($upCitiesSeederPath);

// Extract the $upCitiesList array from scratch/seed_all_up_suppliers.php
preg_match('/\$upCitiesList = \[(.*?)\];\s*echo/s', $upCode, $matches);
if (!$matches) {
    die("Failed to extract upCitiesList\n");
}
$upCitiesArrayCode = '$upCitiesList = [' . $matches[1] . '];';

$seederContent = file_get_contents($dbSeederPath);

// Check if upCitiesList is already inside DatabaseSeeder.php
if (strpos($seederContent, '$upCitiesList') === false) {
    // Add the UP cities seeding logic at the end of DatabaseSeeder before closing brace
    $insertion = <<<PHP

        // 8. Uttar Pradesh Industrial Cities & 2+ Suppliers Per City
        {$upCitiesArrayCode}

        foreach (\$upCitiesList as \$cityData) {
            Location::updateOrCreate(
                ['city' => \$cityData['city']],
                [
                    'state' => 'Uttar Pradesh',
                    'country' => 'India',
                    'pincode' => \$cityData['pincode'],
                    'is_popular' => true,
                    'image' => \$cityData['image'],
                ]
            );

            foreach (['s1', 's2'] as \$sKey) {
                \$sInfo = \$cityData[\$sKey];
                \$slug = Str::slug(\$sInfo['company']);
                \$email = 'supplier_' . Str::slug(\$cityData['city'], '_') . '_' . \$sKey . '@ozura.com';
                \$mobile = '+91 95' . rand(10000000, 99999999);

                \$user = User::updateOrCreate(
                    ['email' => \$email],
                    [
                        'name' => \$sInfo['name'],
                        'mobile' => \$mobile,
                        'role' => 'supplier',
                        'status' => 'active',
                        'password' => Hash::make('password'),
                        'email_verified_at' => now(),
                        'mobile_verified_at' => now(),
                    ]
                );

                \$supplier = Supplier::updateOrCreate(
                    ['user_id' => \$user->id],
                    [
                        'subscription_plan_id' => \$premiumPlan->id,
                        'company_name' => \$sInfo['company'],
                        'slug' => \$slug,
                        'business_type' => \$sInfo['type'],
                        'year_established' => rand(2005, 2018),
                        'employees_count' => '50-100 People',
                        'gst_number' => \$sInfo['gst'],
                        'pan_number' => substr(\$sInfo['gst'], 2, 10),
                        'city' => \$cityData['city'],
                        'state' => 'Uttar Pradesh',
                        'country' => 'India',
                        'pincode' => \$cityData['pincode'],
                        'address' => \$sInfo['address'],
                        'logo' => 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=200&auto=format&fit=crop&q=80',
                        'banner' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1200&auto=format&fit=crop&q=80',
                        'description' => \$sInfo['desc'],
                        'website' => 'https://www.' . \$slug . '.ozura.in',
                        'is_verified' => true,
                        'verification_level' => 'GST',
                        'rating_avg' => round(4.5 + (rand(1, 45) / 100), 2),
                        'reviews_count' => rand(15, 60),
                        'views_count' => rand(800, 2500),
                        'is_featured' => true,
                        'status' => 'active',
                    ]
                );

                Subscription::updateOrCreate(
                    ['supplier_id' => \$supplier->id],
                    [
                        'plan_id' => \$premiumPlan->id,
                        'starts_at' => now()->subMonths(2),
                        'ends_at' => now()->addMonths(10),
                        'status' => 'active',
                        'payment_id' => 'pay_up_' . Str::random(8),
                    ]
                );

                SupplierDocument::updateOrCreate(
                    ['supplier_id' => \$supplier->id, 'doc_type' => 'GST_Certificate'],
                    [
                        'doc_number' => \$sInfo['gst'],
                        'file_path' => 'documents/verified_gst_' . \$supplier->id . '.pdf',
                        'status' => 'approved',
                        'verified_at' => now()->subMonths(2),
                    ]
                );

                \$cat = Category::where('slug', \$sInfo['cat'])->first() ?? Category::first();
                \$subcat = \$cat ? \$cat->subcategories()->first() : null;

                \$pSlug = Str::slug(\$sInfo['prod'] . '-' . \$supplier->city);
                \$product = Product::updateOrCreate(
                    ['slug' => \$pSlug],
                    [
                        'supplier_id' => \$supplier->id,
                        'category_id' => \$cat ? \$cat->id : 1,
                        'subcategory_id' => \$subcat ? \$subcat->id : null,
                        'name' => \$sInfo['prod'],
                        'description' => \$sInfo['pdesc'],
                        'price' => \$sInfo['price'],
                        'currency' => 'INR',
                        'unit' => \$sInfo['unit'],
                        'moq' => \$sInfo['moq'],
                        'specifications' => \$sInfo['specs'],
                        'is_featured' => true,
                        'is_active' => true,
                        'rating_avg' => round(4.6 + (rand(1, 35) / 100), 2),
                        'reviews_count' => rand(8, 30),
                        'views_count' => rand(400, 1500),
                    ]
                );

                ProductImage::updateOrCreate(
                    ['product_id' => \$product->id, 'is_primary' => true],
                    [
                        'image_path' => \$sInfo['pimg'],
                        'sort_order' => 1,
                    ]
                );
            }
        }
PHP;

    $lastBracePos = strrpos($seederContent, '}');
    $updatedContent = substr($seederContent, 0, $lastBracePos) . $insertion . "\n}\n";
    file_put_contents($dbSeederPath, $updatedContent);
    echo "DatabaseSeeder.php successfully updated!\n";
} else {
    echo "DatabaseSeeder.php already contains upCitiesList\n";
}
