<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Buyer;
use App\Models\Supplier;
use App\Models\SupplierDocument;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Service;
use App\Models\Requirement;
use App\Models\Inquiry;
use App\Models\Quote;
use App\Models\Message;
use App\Models\Review;
use App\Models\Location;
use App\Models\Advertisement;
use App\Models\Notification;
use App\Models\SubscriptionPayment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Notification::truncate();
        Advertisement::truncate();
        Review::truncate();
        Message::truncate();
        Quote::truncate();
        Inquiry::truncate();
        Requirement::truncate();
        Service::truncate();
        ProductImage::truncate();
        Product::truncate();
        Subcategory::truncate();
        Category::truncate();
        Location::truncate();
        SubscriptionPayment::truncate();
        Subscription::truncate();
        SubscriptionPlan::truncate();
        SupplierDocument::truncate();
        Supplier::truncate();
        Buyer::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Subscription Plans
        $freePlan = SubscriptionPlan::create([
            'name' => 'Free Starter',
            'slug' => 'free-starter',
            'price' => 0.00,
            'billing_cycle' => 'yearly',
            'product_limit' => 5,
            'inquiry_limit' => 15,
            'has_verified_badge' => false,
            'has_priority_listing' => false,
            'has_rfq_access' => false,
            'has_analytics' => false,
            'features' => [
                'List up to 5 Products',
                '15 Monthly Inquiries',
                'Basic Company Profile',
                'Standard Search Listing',
            ],
            'is_active' => true,
        ]);

        $businessPlan = SubscriptionPlan::create([
            'name' => 'Business Pro',
            'slug' => 'business-pro',
            'price' => 4999.00,
            'billing_cycle' => 'yearly',
            'product_limit' => 50,
            'inquiry_limit' => 150,
            'has_verified_badge' => true,
            'has_priority_listing' => true,
            'has_rfq_access' => true,
            'has_analytics' => true,
            'features' => [
                'List up to 50 Products',
                '150 Monthly Inquiries',
                'GST & Trust Verified Badge',
                'Priority Search Placement',
                'Full Buy Requirement (RFQ) Access',
                'Analytics & Profile View Insights',
            ],
            'is_active' => true,
        ]);

        $premiumPlan = SubscriptionPlan::create([
            'name' => 'Enterprise Elite',
            'slug' => 'enterprise-elite',
            'price' => 14999.00,
            'billing_cycle' => 'yearly',
            'product_limit' => 500,
            'inquiry_limit' => 1000,
            'has_verified_badge' => true,
            'has_priority_listing' => true,
            'has_rfq_access' => true,
            'has_analytics' => true,
            'features' => [
                'Unlimited Products Listing',
                'Unlimited Inquiries & Lead Access',
                'Gold Premium Verified Badge',
                'Top #1 Search Ranking & Homepage Feature',
                'Instant RFQ Lead Notifications via SMS/Email',
                'Dedicated Account Manager & 24/7 Support',
            ],
            'is_active' => true,
        ]);

        // 2. Locations
        $locationsData = [
            ['city' => 'Delhi', 'state' => 'Delhi', 'pincode' => '110001', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Mumbai', 'state' => 'Maharashtra', 'pincode' => '400001', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Bengaluru', 'state' => 'Karnataka', 'pincode' => '560001', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Hyderabad', 'state' => 'Telangana', 'pincode' => '500001', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1605007493699-af65834f8a00?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Ahmedabad', 'state' => 'Gujarat', 'pincode' => '380001', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1606820245089-b1d5c5896a2f?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Pune', 'state' => 'Maharashtra', 'pincode' => '411001', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1616088410192-39c4d6836423?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Chennai', 'state' => 'Tamil Nadu', 'pincode' => '600001', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Kolkata', 'state' => 'West Bengal', 'pincode' => '700001', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1558431382-27e303142255?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Surat', 'state' => 'Gujarat', 'pincode' => '395001', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1590496793929-36417d3117de?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Jaipur', 'state' => 'Rajasthan', 'pincode' => '302001', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Noida', 'state' => 'Uttar Pradesh', 'pincode' => '201301', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1562975871-33230b777a83?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Gurugram', 'state' => 'Haryana', 'pincode' => '122001', 'is_popular' => true, 'image' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?w=500&auto=format&fit=crop&q=80'],
            ['city' => 'Coimbatore', 'state' => 'Tamil Nadu', 'pincode' => '641001', 'is_popular' => false, 'image' => 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80'],
        ];

        foreach ($locationsData as $loc) {
            Location::create($loc);
        }

        // 3. Admin & Staff Users
        $adminUser = User::create([
            'name' => 'Ozura Administrator',
            'email' => 'admin@ozura.com',
            'mobile' => '+91 98765 43210',
            'role' => 'admin',
            'status' => 'active',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
        ]);

        $staffUser = User::create([
            'name' => 'Pooja Verma (Moderator)',
            'email' => 'staff@ozura.com',
            'mobile' => '+91 98765 43211',
            'role' => 'staff',
            'status' => 'active',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
        ]);

        // 4. Buyer Users & Profiles
        $buyer1User = User::create([
            'name' => 'Rajesh Kumar',
            'email' => 'buyer@ozura.com',
            'mobile' => '+91 98201 12345',
            'role' => 'buyer',
            'status' => 'active',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
        ]);

        $buyer1 = Buyer::create([
            'user_id' => $buyer1User->id,
            'company_name' => 'Apex Infra Projects Pvt Ltd',
            'business_type' => 'Infrastructure Contractor',
            'gst_number' => '27AAACA9876Q1Z2',
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'country' => 'India',
            'pincode' => '400051',
            'address' => 'Plot 42, Bandra Kurla Complex, Bandra East',
        ]);

        $buyer2User = User::create([
            'name' => 'Ananya Sharma',
            'email' => 'buyer2@ozura.com',
            'mobile' => '+91 98111 23456',
            'role' => 'buyer',
            'status' => 'active',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
        ]);

        $buyer2 = Buyer::create([
            'user_id' => $buyer2User->id,
            'company_name' => 'Zenith Retail & Supermarkets',
            'business_type' => 'Retail Chain / Wholesaler',
            'gst_number' => '07AAACZ1234F1Z8',
            'city' => 'Delhi',
            'state' => 'Delhi',
            'country' => 'India',
            'pincode' => '110020',
            'address' => 'Okhla Industrial Area Phase 3',
        ]);

        $buyer3User = User::create([
            'name' => 'Vikram Patel',
            'email' => 'buyer3@ozura.com',
            'mobile' => '+91 98250 98765',
            'role' => 'buyer',
            'status' => 'active',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
        ]);

        $buyer3 = Buyer::create([
            'user_id' => $buyer3User->id,
            'company_name' => 'Sunrise Agro Exporters Ltd',
            'business_type' => 'Exporters & Food Processing',
            'gst_number' => '24AAACS5432M1ZQ',
            'city' => 'Ahmedabad',
            'state' => 'Gujarat',
            'country' => 'India',
            'pincode' => '380015',
            'address' => 'SG Highway, Bodakdev',
        ]);

        // 5. Categories & Subcategories
        $categoriesData = [
            [
                'name' => 'Industrial Machinery',
                'slug' => 'industrial-machinery',
                'icon' => 'cog',
                'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80',
                'description' => 'Heavy industrial machinery, CNC tooling, hydraulic systems, processing plants, and packaging machines.',
                'seo_title' => 'Industrial Machinery Manufacturers & Suppliers',
                'seo_description' => 'Find verified industrial machinery suppliers, CNC machines, lathe tools, and hydraulic equipment.',
                'subcategories' => ['CNC Lathe Machines', 'Hydraulic Pumps & Valves', 'Air Compressors', 'Industrial Conveyors', 'Plastic Molding Machines', 'Water Treatment Plants']
            ],
            [
                'name' => 'Solar & Renewable Energy',
                'slug' => 'solar-products',
                'icon' => 'sun',
                'image' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600&auto=format&fit=crop&q=80',
                'description' => 'Solar panels, inverters, solar power plants, lithium batteries, and green energy solutions.',
                'seo_title' => 'Solar Panel & Inverter Suppliers in India',
                'seo_description' => 'Connect with top solar panel manufacturers, on-grid inverters, and solar battery distributors.',
                'subcategories' => ['Mono Perc Solar Panels', 'On-Grid Solar Inverters', 'Solar Tubular & Lithium Batteries', 'Solar Water Heaters', 'Solar Street Lights']
            ],
            [
                'name' => 'Electronics & Electrical',
                'slug' => 'electronics-electrical',
                'icon' => 'zap',
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80',
                'description' => 'Electronic components, industrial sensors, switchgear, electric motors, and copper wiring.',
                'seo_title' => 'Electrical Equipment & Industrial Electronic Components',
                'seo_description' => 'Wholesale electrical cables, induction motors, switchgear, and semiconductor components.',
                'subcategories' => ['Three-Phase Induction Motors', 'HT/LT Power Cables', 'Industrial Proximity Sensors', 'LT Switchgear & Panels', 'Digital Multimeters']
            ],
            [
                'name' => 'Construction Materials',
                'slug' => 'construction-materials',
                'icon' => 'building',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&auto=format&fit=crop&q=80',
                'description' => 'TMT rebar steel, cement, precast blocks, scaffolding, and architectural hardware.',
                'seo_title' => 'Construction Materials & Structural Steel Suppliers',
                'seo_description' => 'Bulk supply of TMT bars, structural steel beams, ready-mix concrete, and scaffolding.',
                'subcategories' => ['Fe 550D TMT Rebars', 'Structural Steel Beams', 'OPC / PPC Cement 50kg', 'Tubular Scaffolding Systems', 'Vitrified Floor Tiles']
            ],
            [
                'name' => 'Packaging Materials',
                'slug' => 'packaging-materials',
                'icon' => 'package',
                'image' => 'https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=600&auto=format&fit=crop&q=80',
                'description' => 'Corrugated carton boxes, stretch wrap films, BOPP tape, glass & PET bottles, and pouches.',
                'seo_title' => 'Packaging Materials & Corrugated Boxes Wholesale',
                'seo_description' => 'Wholesale corrugated boxes, packaging rolls, airtight pouches, and protective packaging.',
                'subcategories' => ['3-Ply & 5-Ply Corrugated Boxes', 'LLDPE Stretch Wrap Films', 'Printed Stand-up Pouches', 'Corrugated Shipping Rolls', 'Rigid Plastic Drums']
            ],
            [
                'name' => 'Chemicals & Minerals',
                'slug' => 'chemicals-minerals',
                'icon' => 'flask-conical',
                'image' => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=600&auto=format&fit=crop&q=80',
                'description' => 'Industrial chemicals, laboratory reagents, polymers, solvents, and specialty additives.',
                'seo_title' => 'Industrial Chemicals & Polymer Raw Material Suppliers',
                'seo_description' => 'Direct manufacturers of industrial solvents, Caustic Soda, polymer granules, and specialty chemicals.',
                'subcategories' => ['Caustic Soda Flakes', 'Industrial Solvents & IPA', 'Polymer & PVC Resins', 'Activated Carbon Granules', 'Pigments & Color Dyes']
            ],
            [
                'name' => 'Medical & Healthcare',
                'slug' => 'medical-equipment',
                'icon' => 'activity',
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&auto=format&fit=crop&q=80',
                'description' => 'Diagnostic equipment, hospital furniture, surgical instruments, and medical disposables.',
                'seo_title' => 'Medical Devices & Hospital Equipment Manufacturers',
                'seo_description' => 'Source hospital beds, patient monitors, oxygen concentrators, and surgical disposables.',
                'subcategories' => ['ICU Multipara Patient Monitors', 'Motorized Hospital Beds', 'Surgical Gloves & Disposables', 'Digital X-Ray Machines', 'Oxygen Concentrators 10L']
            ],
            [
                'name' => 'Textiles & Apparel',
                'slug' => 'textile-products',
                'icon' => 'scissors',
                'image' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=600&auto=format&fit=crop&q=80',
                'description' => 'Yarn, cotton fabrics, industrial workwear, uniform fabrics, and garment accessories.',
                'seo_title' => 'Textile Mills, Fabric Manufacturers & Uniform Suppliers',
                'seo_description' => 'Wholesale cotton yarn, denim fabrics, flame-retardant workwear, and garment fabrics.',
                'subcategories' => ['100% Combed Cotton Yarn', 'Industrial Boiler Suits & Workwear', 'Denim & Twill Fabrics', 'Non-Woven Fabric Rolls', 'Polyester Sewing Thread']
            ],
            [
                'name' => 'Agriculture & Food',
                'slug' => 'agriculture-food',
                'icon' => 'sprout',
                'image' => 'https://images.unsplash.com/photo-1586771107445-d3ca888129ff?w=600&auto=format&fit=crop&q=80',
                'description' => 'Agro commodities, organic spices, pulses, drip irrigation equipment, and cold-pressed oils.',
                'seo_title' => 'Agro Commodities & Spices Wholesalers',
                'seo_description' => 'Buy Indian spices, Basmati rice, cold pressed edible oils, and precision drip irrigation pipes.',
                'subcategories' => ['Premium Basmati Rice', 'Organic Turmeric & Chili Powder', 'Drip Irrigation Pipe Lines', 'Cold Pressed Mustard Oil', 'NPK Water Soluble Fertilizers']
            ],
            [
                'name' => 'Automobile & EV Parts',
                'slug' => 'automobile-parts',
                'icon' => 'truck',
                'image' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=600&auto=format&fit=crop&q=80',
                'description' => 'OEM automotive spares, electric vehicle powertrain parts, heavy vehicle brake assemblies, and batteries.',
                'seo_title' => 'Auto Spare Parts & EV Component Manufacturers',
                'seo_description' => 'Automotive filters, brake pads, EV charging stations, and suspension parts wholesale.',
                'subcategories' => ['Heavy Duty Ceramic Brake Pads', 'Automotive Oil & Air Filters', 'EV Fast DC Charging Stations', 'Commercial Vehicle Leaf Springs', 'Lithium EV Battery Packs']
            ],
            [
                'name' => 'Commercial Furniture',
                'slug' => 'furniture',
                'icon' => 'armchair',
                'image' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&auto=format&fit=crop&q=80',
                'description' => 'Ergonomic office workstations, executive chairs, warehouse pallet racks, and institutional furniture.',
                'seo_title' => 'Office Furniture & Warehouse Storage Racks',
                'seo_description' => 'Modular office workstations, ergonomic mesh chairs, and heavy duty warehouse pallet racking.',
                'subcategories' => ['High-Back Ergonomic Mesh Chairs', 'Modular 4-Person Office Workstations', 'Heavy Duty Pallet Storage Racks', 'Fireproof Steel Filing Cabinets']
            ],
            [
                'name' => 'Security & Safety Systems',
                'slug' => 'security-products',
                'icon' => 'shield-check',
                'image' => 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80',
                'description' => 'IP CCTV surveillance, biometric access control, fire suppression systems, and industrial PPE.',
                'seo_title' => 'Industrial Security Cameras & Fire Safety Equipment',
                'seo_description' => 'Commercial CCTV systems, biometric attendance machines, and ABC fire extinguishers.',
                'subcategories' => ['4K Ultra HD IP CCTV Cameras', 'Biometric Face & Fingerprint Terminals', 'Automatic CO2 Fire Suppression Systems', 'High-Visibility Safety Helmets & Vests']
            ],
            [
                'name' => 'IT Services & Software',
                'slug' => 'it-services',
                'icon' => 'laptop',
                'image' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=80',
                'description' => 'Custom enterprise ERP, cloud hosting, IoT industrial monitoring, and B2B portal development.',
                'seo_title' => 'B2B Software Development & Enterprise ERP Solutions',
                'seo_description' => 'Custom ERP for manufacturing, IoT SCADA solutions, and enterprise software services.',
                'subcategories' => ['Cloud Manufacturing ERP Software', 'Industrial IoT Gateway & SCADA', 'Cybersecurity Audit & Compliance', 'Custom Mobile & Web Apps']
            ],
        ];

        $createdCategories = [];
        $createdSubcategories = [];

        foreach ($categoriesData as $idx => $catItem) {
            $cat = Category::create([
                'name' => $catItem['name'],
                'slug' => $catItem['slug'],
                'icon' => $catItem['icon'],
                'image' => $catItem['image'],
                'description' => $catItem['description'],
                'seo_title' => $catItem['seo_title'],
                'seo_description' => $catItem['seo_description'],
                'seo_keywords' => strtolower($catItem['name']) . ', suppliers, manufacturers, wholesale',
                'is_active' => true,
                'sort_order' => $idx + 1,
            ]);

            $createdCategories[$cat->slug] = $cat;

            foreach ($catItem['subcategories'] as $subIdx => $subName) {
                $sub = Subcategory::create([
                    'category_id' => $cat->id,
                    'name' => $subName,
                    'slug' => Str::slug($subName),
                    'image' => $catItem['image'],
                    'description' => $subName . ' wholesale supply and manufacturing options.',
                    'is_active' => true,
                    'sort_order' => $subIdx + 1,
                ]);
                $createdSubcategories[$sub->slug] = $sub;
            }
        }

        // 6. Suppliers (Users + Profiles + Documents)
        $suppliersData = [
            [
                'user' => [
                    'name' => 'Arunachalam Murthy',
                    'email' => 'supplier@ozura.com',
                    'mobile' => '+91 94432 10987',
                ],
                'supplier' => [
                    'company_name' => 'Apex Industrial Machineries Pvt Ltd',
                    'slug' => 'apex-industrial-machineries',
                    'business_type' => 'Manufacturer',
                    'year_established' => 2006,
                    'employees_count' => '51-100 People',
                    'gst_number' => '33AAACA1122D1Z9',
                    'pan_number' => 'AAACA1122D',
                    'city' => 'Coimbatore',
                    'state' => 'Tamil Nadu',
                    'country' => 'India',
                    'pincode' => '641006',
                    'address' => 'SF No 142/2, Peelamedu Industrial Estate, Avinashi Road',
                    'logo' => 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=200&auto=format&fit=crop&q=80',
                    'banner' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1200&auto=format&fit=crop&q=80',
                    'description' => 'Apex Industrial Machineries is a premier manufacturer and exporter of heavy-duty CNC lathe machines, industrial hydraulic pumps, and automated conveyor systems with ISO 9001:2015 certification. Supplying over 4,000+ factories worldwide with high precision engineered machinery.',
                    'website' => 'https://www.apexindustrialmachinery.example.com',
                    'is_verified' => true,
                    'verification_level' => 'Premium',
                    'rating_avg' => 4.90,
                    'reviews_count' => 38,
                    'views_count' => 1420,
                    'is_featured' => true,
                    'status' => 'active',
                ],
                'plan' => $premiumPlan,
            ],
            [
                'user' => [
                    'name' => 'Sunil Joshi',
                    'email' => 'supplier2@ozura.com',
                    'mobile' => '+91 98450 76543',
                ],
                'supplier' => [
                    'company_name' => 'NovaTech Solar & Green Energy Ltd',
                    'slug' => 'novatech-solar-energy',
                    'business_type' => 'Manufacturer',
                    'year_established' => 2012,
                    'employees_count' => '101-250 People',
                    'gst_number' => '29AAACN8877K1Z4',
                    'pan_number' => 'AAACN8877K',
                    'city' => 'Bengaluru',
                    'state' => 'Karnataka',
                    'country' => 'India',
                    'pincode' => '560100',
                    'address' => 'Plot 88, Electronic City Phase 1, Hosur Road',
                    'logo' => 'https://images.unsplash.com/photo-1572021335469-31706a17aaef?w=200&auto=format&fit=crop&q=80',
                    'banner' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=1200&auto=format&fit=crop&q=80',
                    'description' => 'NovaTech Solar is a Tier-1 certified manufacturer of high-efficiency Mono PERC Solar Panels, Hybrid Inverters, and Smart Lithium-Ion Energy Storage systems for commercial, industrial, and rooftop utility projects across India and the Middle East.',
                    'website' => 'https://www.novatechsolar.example.com',
                    'is_verified' => true,
                    'verification_level' => 'Premium',
                    'rating_avg' => 4.85,
                    'reviews_count' => 45,
                    'views_count' => 2190,
                    'is_featured' => true,
                    'status' => 'active',
                ],
                'plan' => $premiumPlan,
            ],
            [
                'user' => [
                    'name' => 'Hiren Shah',
                    'email' => 'supplier3@ozura.com',
                    'mobile' => '+91 98980 43210',
                ],
                'supplier' => [
                    'company_name' => 'Bharat Polymer & Packaging Solutions',
                    'slug' => 'bharat-polymer-packaging',
                    'business_type' => 'Manufacturer',
                    'year_established' => 2010,
                    'employees_count' => '25-50 People',
                    'gst_number' => '24AAACB3344J1Z1',
                    'pan_number' => 'AAACB3344J',
                    'city' => 'Ahmedabad',
                    'state' => 'Gujarat',
                    'country' => 'India',
                    'pincode' => '382445',
                    'address' => 'Phase IV, GIDC Vatva Industrial Area',
                    'logo' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=200&auto=format&fit=crop&q=80',
                    'banner' => 'https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=1200&auto=format&fit=crop&q=80',
                    'description' => 'Bharat Polymer is a leader in heavy duty 5-ply corrugated shipping boxes, automated LLDPE stretch wrap films, and tamper-proof printed multilayer pouches, serving Fortune 500 FMCG and logistics companies.',
                    'website' => 'https://www.bharatpolymer.example.com',
                    'is_verified' => true,
                    'verification_level' => 'GST',
                    'rating_avg' => 4.70,
                    'reviews_count' => 24,
                    'views_count' => 980,
                    'is_featured' => false,
                    'status' => 'active',
                ],
                'plan' => $businessPlan,
            ],
            [
                'user' => [
                    'name' => 'Dr. K. S. Reddy',
                    'email' => 'supplier4@ozura.com',
                    'mobile' => '+91 99490 87654',
                ],
                'supplier' => [
                    'company_name' => 'Delta Chemicals & Pharma Ingredients',
                    'slug' => 'delta-chemicals-pharma',
                    'business_type' => 'Manufacturer',
                    'year_established' => 2015,
                    'employees_count' => '51-100 People',
                    'gst_number' => '36AAACD9900L1Z7',
                    'pan_number' => 'AAACD9900L',
                    'city' => 'Hyderabad',
                    'state' => 'Telangana',
                    'country' => 'India',
                    'pincode' => '500072',
                    'address' => 'Plot 15, IDA Kukatpally, Near Balanagar',
                    'logo' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=200&auto=format&fit=crop&q=80',
                    'banner' => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=1200&auto=format&fit=crop&q=80',
                    'description' => 'Delta Chemicals manufactures high-purity industrial solvents, Caustic Soda flakes 99%, active pharmaceutical intermediaries, and activated carbon filters with GLP and GMP compliant laboratories.',
                    'website' => 'https://www.deltachemicals.example.com',
                    'is_verified' => true,
                    'verification_level' => 'KYC',
                    'rating_avg' => 4.90,
                    'reviews_count' => 19,
                    'views_count' => 870,
                    'is_featured' => true,
                    'status' => 'active',
                ],
                'plan' => $businessPlan,
            ],
            [
                'user' => [
                    'name' => 'Mahesh Agarwal',
                    'email' => 'supplier5@ozura.com',
                    'mobile' => '+91 98220 54321',
                ],
                'supplier' => [
                    'company_name' => 'Vanguard Steel & Structural Infrastructure',
                    'slug' => 'vanguard-steel-infra',
                    'business_type' => 'Distributor',
                    'year_established' => 2002,
                    'employees_count' => '101-250 People',
                    'gst_number' => '27AAACV7766M1Z3',
                    'pan_number' => 'AAACV7766M',
                    'city' => 'Pune',
                    'state' => 'Maharashtra',
                    'country' => 'India',
                    'pincode' => '411018',
                    'address' => 'MIDC Bhosari Industrial Area, Telco Road',
                    'logo' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=200&auto=format&fit=crop&q=80',
                    'banner' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&auto=format&fit=crop&q=80',
                    'description' => 'Authorized prime distributors of primary Fe 550D TMT bars, heavy structural beams, MS plates, and Cuplock scaffolding systems for highway bridges, high-rises, and industrial sheds.',
                    'website' => 'https://www.vanguardsteel.example.com',
                    'is_verified' => true,
                    'verification_level' => 'Premium',
                    'rating_avg' => 4.75,
                    'reviews_count' => 31,
                    'views_count' => 1650,
                    'is_featured' => true,
                    'status' => 'active',
                ],
                'plan' => $premiumPlan,
            ],
            [
                'user' => [
                    'name' => 'Paresh Mehta',
                    'email' => 'supplier6@ozura.com',
                    'mobile' => '+91 98241 65432',
                ],
                'supplier' => [
                    'company_name' => 'Royal Surat Weaves & Textile Mills',
                    'slug' => 'royal-surat-weaves',
                    'business_type' => 'Manufacturer',
                    'year_established' => 2008,
                    'employees_count' => '250-500 People',
                    'gst_number' => '24AAACR4455N1Z5',
                    'pan_number' => 'AAACR4455N',
                    'city' => 'Surat',
                    'state' => 'Gujarat',
                    'country' => 'India',
                    'pincode' => '395002',
                    'address' => 'Ring Road, Surat Textile Market Complex',
                    'logo' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=200&auto=format&fit=crop&q=80',
                    'banner' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=1200&auto=format&fit=crop&q=80',
                    'description' => 'Leading textile mill specialized in high-durability uniform fabrics, cotton twill, fire-retardant fabric rolls, and bulk dyed cotton yarns with monthly capacity exceeding 500,000 meters.',
                    'website' => 'https://www.royalsuratweaves.example.com',
                    'is_verified' => true,
                    'verification_level' => 'GST',
                    'rating_avg' => 4.65,
                    'reviews_count' => 17,
                    'views_count' => 790,
                    'is_featured' => false,
                    'status' => 'active',
                ],
                'plan' => $businessPlan,
            ],
        ];

        $createdSuppliers = [];

        foreach ($suppliersData as $sData) {
            $user = User::create([
                'name' => $sData['user']['name'],
                'email' => $sData['user']['email'],
                'mobile' => $sData['user']['mobile'],
                'role' => 'supplier',
                'status' => 'active',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'mobile_verified_at' => now(),
            ]);

            $supplier = Supplier::create(array_merge($sData['supplier'], [
                'user_id' => $user->id,
                'subscription_plan_id' => $sData['plan']->id,
            ]));

            // Add verified document
            SupplierDocument::create([
                'supplier_id' => $supplier->id,
                'doc_type' => 'GST_Certificate',
                'doc_number' => $supplier->gst_number,
                'file_path' => 'documents/gst_cert_' . $supplier->id . '.pdf',
                'status' => 'approved',
                'verified_at' => now(),
            ]);

            SupplierDocument::create([
                'supplier_id' => $supplier->id,
                'doc_type' => 'PAN_Card',
                'doc_number' => $supplier->pan_number,
                'file_path' => 'documents/pan_card_' . $supplier->id . '.pdf',
                'status' => 'approved',
                'verified_at' => now(),
            ]);

            // Add active subscription
            Subscription::create([
                'supplier_id' => $supplier->id,
                'plan_id' => $sData['plan']->id,
                'starts_at' => now()->subMonths(2),
                'ends_at' => now()->addMonths(10),
                'status' => 'active',
                'payment_id' => 'pay_demo_' . Str::random(10),
            ]);

            $createdSuppliers[$supplier->slug] = $supplier;
        }

        // 7. Products Catalog
        $productsData = [
            // Apex Industrial Machineries
            [
                'supplier_slug' => 'apex-industrial-machineries',
                'cat_slug' => 'industrial-machinery',
                'subcat_slug' => 'cnc-lathe-machines',
                'name' => 'Apex UltraPrecision Heavy Duty CNC Lathe Machine 3000 RPM',
                'brand' => 'Apex CNC',
                'sku' => 'APX-CNC-3000X',
                'price' => 750000.00,
                'price_unit' => 'Set',
                'moq' => 1,
                'stock_qty' => 15,
                'main_image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&auto=format&fit=crop&q=80',
                'description' => 'Heavy duty slant-bed CNC Lathe Machine equipped with Fanuc / Siemens controller, 8-station hydraulic turret, automatic chip conveyor, and hardened ground guideways. Perfect for aerospace, automotive, and heavy industrial precision shaft turning.',
                'features' => "• Max Swing over bed: 500 mm\n• Max Turning Length: 1000 mm\n• Spindle Speed Range: 50 - 3500 RPM\n• Chuck Size: 8 Inch 3-Jaw Hydraulic\n• Full Enclosed Splash Guard & Auto Lubrication",
                'specifications' => [
                    ['key' => 'Control System', 'value' => 'Siemens 808D / Fanuc 0i-TF'],
                    ['key' => 'Spindle Motor Power', 'value' => '11 kW / 15 HP'],
                    ['key' => 'Max Machining Diameter', 'value' => '320 mm'],
                    ['key' => 'Weight of Machine', 'value' => '3,800 kg'],
                    ['key' => 'Warranty', 'value' => '2 Years On-Site Warranty'],
                ],
                'packaging_details' => 'Export standard vacuum sealed waterproof packaging in fumigated wooden crate.',
                'delivery_info' => 'Dispatched within 10-14 days via heavy cargo transport across India & Global ports.',
                'payment_terms' => '30% Advance, 70% against BL / Letter of Credit (LC)',
                'is_featured' => true,
                'is_sponsored' => true,
                'views_count' => 1250,
            ],
            [
                'supplier_slug' => 'apex-industrial-machineries',
                'cat_slug' => 'industrial-machinery',
                'subcat_slug' => 'hydraulic-pumps-valves',
                'name' => 'High Pressure Variable Displacement Axial Piston Hydraulic Pump',
                'brand' => 'ApexHydra',
                'sku' => 'APX-HYD-P450',
                'price' => 38500.00,
                'price_unit' => 'Piece',
                'moq' => 2,
                'stock_qty' => 80,
                'main_image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&auto=format&fit=crop&q=80',
                'description' => 'Industrial grade axial piston pump designed for open-circuit hydraulic systems requiring constant pressure and load sensing capabilities. Features high efficiency, low noise emissions, and extended bearing lifespan.',
                'features' => "• Displacement: 45 cc/rev to 140 cc/rev\n• Nominal Pressure: 350 bar (Max 400 bar)\n• SAE Flange Mounting\n• Cast iron housing with anti-corrosion coating",
                'specifications' => [
                    ['key' => 'Displacement', 'value' => '71 cc/rev'],
                    ['key' => 'Max Pressure', 'value' => '350 Bar'],
                    ['key' => 'Rotation', 'value' => 'Clockwise / Bi-directional'],
                    ['key' => 'Fluid Compatibility', 'value' => 'Mineral Hydraulic Oil ISO VG 46/68'],
                ],
                'packaging_details' => 'Individually boxed in heavy protective foam casing.',
                'delivery_info' => 'Ready in stock. Dispatches in 24-48 hours.',
                'payment_terms' => '100% Advance / UPI / Net Banking / Net 30 for verified buyers',
                'is_featured' => true,
                'is_sponsored' => false,
                'views_count' => 840,
            ],
            [
                'supplier_slug' => 'apex-industrial-machineries',
                'cat_slug' => 'industrial-machinery',
                'subcat_slug' => 'air-compressors',
                'name' => 'Apex 50 HP Industrial Rotary Screw Air Compressor with Inverter VFD',
                'brand' => 'ApexAir',
                'sku' => 'APX-CMP-50VFD',
                'price' => 320000.00,
                'price_unit' => 'Set',
                'moq' => 1,
                'stock_qty' => 20,
                'main_image' => 'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=800&auto=format&fit=crop&q=80',
                'description' => 'Energy saving Variable Frequency Drive (VFD) rotary screw compressor. Provides continuous 210 CFM compressed air with ultra-quiet acoustic canopy and touch screen intelligent controller.',
                'features' => "• Motor Power: 37 kW / 50 HP\n• Air Flow: 210 CFM @ 8 bar\n• Integrated Air Dryer & Dual Micro Filters\n• Energy Savings up to 35% with PM Motor",
                'specifications' => [
                    ['key' => 'Free Air Delivery', 'value' => '6.0 m³/min (210 CFM)'],
                    ['key' => 'Working Pressure', 'value' => '8.0 to 10.0 Bar'],
                    ['key' => 'Cooling Method', 'value' => 'Forced Air Cooled'],
                    ['key' => 'Noise Level', 'value' => '68 ± 2 dB(A)'],
                ],
                'packaging_details' => 'Fumigated wooden box with anti-moisture silica packing.',
                'delivery_info' => 'Shipped in 3-5 days across all Indian industrial hubs.',
                'payment_terms' => '50% Advance, 50% on Delivery',
                'is_featured' => false,
                'is_sponsored' => false,
                'views_count' => 620,
            ],

            // NovaTech Solar
            [
                'supplier_slug' => 'novatech-solar-energy',
                'cat_slug' => 'solar-products',
                'subcat_slug' => 'mono-perc-solar-panels',
                'name' => 'NovaTech 550W Bifacial Mono PERC Half-Cut Solar PV Panel',
                'brand' => 'NovaTech Solar',
                'sku' => 'NTS-550W-BIF',
                'price' => 11200.00,
                'price_unit' => 'Piece',
                'moq' => 25,
                'stock_qty' => 5000,
                'main_image' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=800&auto=format&fit=crop&q=80',
                'description' => 'High efficiency 144 Half-Cut Cell Bifacial Monocrystalline PERC solar module. Generates up to 25% extra energy from the rear side. Tested and certified under IEC 61215 and ALMM approved for government and commercial solar projects.',
                'features' => "• Module Efficiency: 21.6%\n• PID Resistant & Anti-Reflective 3.2mm Tempered Glass\n• Robust 35mm Anodized Aluminum Alloy Frame\n• 30 Years Linear Performance Warranty (85% at Year 30)",
                'specifications' => [
                    ['key' => 'Rated Maximum Power (Pmax)', 'value' => '550 W'],
                    ['key' => 'Open Circuit Voltage (Voc)', 'value' => '49.80 V'],
                    ['key' => 'Short Circuit Current (Isc)', 'value' => '13.98 A'],
                    ['key' => 'Module Dimensions', 'value' => '2278 x 1134 x 35 mm'],
                    ['key' => 'Certification', 'value' => 'BIS, ALMM, IEC 61215, IEC 61730'],
                ],
                'packaging_details' => '31 Panels per pallet, 682 panels per 40ft High Cube container.',
                'delivery_info' => 'Immediate bulk dispatch from Bengaluru & Delhi warehouses.',
                'payment_terms' => '100% Irrevocable LC at sight or 20% advance & balance before dispatch',
                'is_featured' => true,
                'is_sponsored' => true,
                'views_count' => 3120,
            ],
            [
                'supplier_slug' => 'novatech-solar-energy',
                'cat_slug' => 'solar-products',
                'subcat_slug' => 'on-grid-solar-inverters',
                'name' => 'NovaTech 50kW Three Phase Commercial On-Grid Solar Inverter',
                'brand' => 'NovaTech Grid',
                'sku' => 'NTS-INV-50K',
                'price' => 145000.00,
                'price_unit' => 'Set',
                'moq' => 1,
                'stock_qty' => 45,
                'main_image' => 'https://images.unsplash.com/photo-1548345680-f5475ea5df84?w=800&auto=format&fit=crop&q=80',
                'description' => 'Commercial grid-tied transformerless string inverter with 4 MPPT trackers, 98.8% max efficiency, built-in WiFi/Ethernet monitoring, AFCI arc fault protection, and IP66 outdoor rated weather resistance.',
                'features' => "• Max DC Input: 1100V\n• 4 Independent MPPTs with 8 String Inputs\n• Integrated DC Switch & Type II AC/DC Surge Protection\n• 10-Year Standard Factory Warranty",
                'specifications' => [
                    ['key' => 'Max AC Output Power', 'value' => '55 kVA'],
                    ['key' => 'Nominal AC Grid Voltage', 'value' => '400V, 3L+N+PE'],
                    ['key' => 'MPPT Voltage Range', 'value' => '200V - 1000V'],
                    ['key' => 'Ingress Protection', 'value' => 'IP66 Waterproof'],
                ],
                'packaging_details' => 'Corrugated carton with shock-absorbent EPE foam.',
                'delivery_info' => 'Dispatches within 48 hours.',
                'payment_terms' => 'Online Bank Transfer / RTGS / LC',
                'is_featured' => true,
                'is_sponsored' => false,
                'views_count' => 1100,
            ],

            // Vanguard Steel & Structural
            [
                'supplier_slug' => 'vanguard-steel-infra',
                'cat_slug' => 'construction-materials',
                'subcat_slug' => 'fe-550d-tmt-rebars',
                'name' => 'Primary Brand Fe 550D High Ductility Corrosion Resistant TMT Rebar Steel',
                'brand' => 'Vanguard TMT',
                'sku' => 'VAN-TMT-550D',
                'price' => 58500.00,
                'price_unit' => 'Metric Ton',
                'moq' => 10,
                'stock_qty' => 2500,
                'main_image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&auto=format&fit=crop&q=80',
                'description' => 'Thermo-Mechanically Treated (TMT) Fe 550D reinforcing steel bars complying with IS 1786:2008 standards. Superior earthquake resistance, higher bendability, and superior bonding with concrete for infrastructure projects.',
                'features' => "• Diameters Available: 8mm, 10mm, 12mm, 16mm, 20mm, 25mm, 32mm\n• Min Yield Strength: 550 N/mm²\n• Min Elongation: 16.0%\n• Includes Mill Test Certificate (MTC) with every trailer dispatch",
                'specifications' => [
                    ['key' => 'Standard Specification', 'value' => 'IS 1786:2008 Fe 550D'],
                    ['key' => 'Carbon Equivalent (Max)', 'value' => '0.42%'],
                    ['key' => 'Length per Bar', 'value' => '12 Meters Standard'],
                    ['key' => 'Tolerance on Weight', 'value' => 'Within BIS limits ±3%'],
                ],
                'packaging_details' => 'Bundled with heavy steel wire ties and color-coded identification tags.',
                'delivery_info' => 'Trailer load direct to construction sites in Maharashtra, Gujarat, Goa & MP.',
                'payment_terms' => 'Advance RTGS before dispatch / Bank Guarantee (BG)',
                'is_featured' => true,
                'is_sponsored' => true,
                'views_count' => 1890,
            ],
            [
                'supplier_slug' => 'vanguard-steel-infra',
                'cat_slug' => 'construction-materials',
                'subcat_slug' => 'tubular-scaffolding-systems',
                'name' => 'Heavy Duty Cuplock Scaffolding System & Steel Prop Jacks',
                'brand' => 'Vanguard Scaffold',
                'sku' => 'VAN-SCF-CUP100',
                'price' => 74000.00,
                'price_unit' => 'Metric Ton',
                'moq' => 3,
                'stock_qty' => 450,
                'main_image' => 'https://images.unsplash.com/photo-1590069261209-f8e9b8642343?w=800&auto=format&fit=crop&q=80',
                'description' => 'Complete modular Cuplock scaffolding system including vertical standards with forged cups at 500mm intervals, horizontal ledgers, base jacks, and galvanized steel walking catwalk planks.',
                'features' => "• Material: High Tensile MS Pipe 48.3mm OD x 3.2mm Wall\n• Surface Finish: Hot Dip Galvanized or Anti-Rust Painted\n• Rapid assembly and dismantling with single hammer blow lock",
                'specifications' => [
                    ['key' => 'Tube Outer Diameter', 'value' => '48.3 mm'],
                    ['key' => 'Steel Grade', 'value' => 'YST 240 / IS 1161'],
                    ['key' => 'Cup Spacing', 'value' => '500 mm Centers'],
                ],
                'packaging_details' => 'Stacked on steel pallets and strapped for forklift handling.',
                'delivery_info' => 'Immediate stock dispatch.',
                'payment_terms' => '30% Advance, 70% against Proforma Invoice',
                'is_featured' => false,
                'is_sponsored' => false,
                'views_count' => 710,
            ],

            // Bharat Polymer & Packaging
            [
                'supplier_slug' => 'bharat-polymer-packaging',
                'cat_slug' => 'packaging-materials',
                'subcat_slug' => '3-ply-5-ply-corrugated-boxes',
                'name' => 'Custom Printed 5-Ply Heavy Duty Kraft Corrugated Shipping Boxes',
                'brand' => 'BharatPack',
                'sku' => 'BHP-BOX-5PLY',
                'price' => 32.50,
                'price_unit' => 'Piece',
                'moq' => 1000,
                'stock_qty' => 50000,
                'main_image' => 'https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=800&auto=format&fit=crop&q=80',
                'description' => 'Industrial strength 5-Ply fluted corrugated shipping cartons manufactured using virgin semi-kraft paper. High edge crush test (ECT) and bursting strength rating suitable for e-commerce, warehousing, and export shipping.',
                'features' => "• Flute Type: AB / BC Combination Double Wall\n• Paper GSM: 150 GSM Outer Virgin Kraft + 120 GSM Fluting\n• Custom Flexographic Multi-Color Logo & Barcode Printing\n• Bursting Factor (BF): 24+ BF",
                'specifications' => [
                    ['key' => 'Box Style', 'value' => 'RSC (Regular Slotted Carton)'],
                    ['key' => 'Material', 'value' => '100% Recyclable Virgin Semi-Kraft'],
                    ['key' => 'Load Capacity', 'value' => 'Up to 35 kg Stack Load'],
                ],
                'packaging_details' => 'Bundled in packs of 25 with shrink wrap and protective edge boards.',
                'delivery_info' => 'Custom production in 4-6 business days.',
                'payment_terms' => '50% Advance with Purchase Order, 50% on Delivery',
                'is_featured' => true,
                'is_sponsored' => false,
                'views_count' => 950,
            ],
            [
                'supplier_slug' => 'bharat-polymer-packaging',
                'cat_slug' => 'packaging-materials',
                'subcat_slug' => 'lldpe-stretch-wrap-films',
                'name' => 'Cast LLDPE Manual & Machine Pallet Stretch Wrap Film Rolls 23 Micron',
                'brand' => 'BharatFilm',
                'sku' => 'BHP-FLM-23M',
                'price' => 148.00,
                'price_unit' => 'Kg',
                'moq' => 100,
                'stock_qty' => 8000,
                'main_image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80',
                'description' => 'High clarity 5-layer co-extruded LLDPE cast stretch film with up to 300% elongation pre-stretch capabilities. Exceptional puncture resistance and one-sided cling properties.',
                'features' => "• Thickness: 23 Micron (Options: 17µ, 29µ available)\n• Roll Width: 500 mm (20 inches)\n• Core Weight: 1.0 kg High Strength Paper Tube\n• Silent unwinding and tear resistance",
                'specifications' => [
                    ['key' => 'Raw Material', 'value' => '100% Prime Virgin Dow / Sabic LLDPE'],
                    ['key' => 'Stretch Capacity', 'value' => 'Up to 300%'],
                    ['key' => 'Color', 'value' => 'Ultra Clear Transparent / Opaque Black'],
                ],
                'packaging_details' => '4 Rolls per carton, 48 cartons per pallet.',
                'delivery_info' => 'Ready stock available for same-day dispatch.',
                'payment_terms' => 'Cash / Cheque / Bank Transfer',
                'is_featured' => false,
                'is_sponsored' => false,
                'views_count' => 540,
            ],

            // Delta Chemicals
            [
                'supplier_slug' => 'delta-chemicals-pharma',
                'cat_slug' => 'chemicals-minerals',
                'subcat_slug' => 'caustic-soda-flakes',
                'name' => 'Industrial Grade Caustic Soda Flakes (Sodium Hydroxide NaOH 99.5%)',
                'brand' => 'DeltaChem',
                'sku' => 'DLT-NAOH-99FL',
                'price' => 42.00,
                'price_unit' => 'Kg',
                'moq' => 500,
                'stock_qty' => 25000,
                'main_image' => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=800&auto=format&fit=crop&q=80',
                'description' => 'High purity membrane cell grade Caustic Soda Flakes (Sodium Hydroxide 99.5% min). Widely utilized in textile processing, paper manufacturing, soap & detergents, water treatment, and alumina refining.',
                'features' => "• Appearance: Pure white deliquescent flakes\n• Purity: 99.5% NaOH Minimum\n• Sodium Carbonate (Na2CO3): 0.4% Max\n• Chlorides (as NaCl): 0.03% Max\n• Heavy Metals: Below 5 ppm",
                'specifications' => [
                    ['key' => 'CAS Number', 'value' => '1310-73-2'],
                    ['key' => 'Molecular Formula', 'value' => 'NaOH'],
                    ['key' => 'Purity (Assay)', 'value' => '99.50% Min'],
                    ['key' => 'Hazard Class', 'value' => 'Class 8 (Corrosive)'],
                ],
                'packaging_details' => '25kg HDPE woven bags with airtight inner LDPE liner.',
                'delivery_info' => 'Full truckload or LCL dispatch with MSDS and COA certificates.',
                'payment_terms' => '100% Advance / LC at Sight',
                'is_featured' => true,
                'is_sponsored' => false,
                'views_count' => 1400,
            ],

            // Royal Surat Weaves
            [
                'supplier_slug' => 'royal-surat-weaves',
                'cat_slug' => 'textile-products',
                'subcat_slug' => 'industrial-boiler-suits-workwear',
                'name' => 'Heavy Duty 100% Cotton Drill Flame Retardant Industrial Uniform Fabric',
                'brand' => 'RoyalShield',
                'sku' => 'RSW-FAB-FR240',
                'price' => 125.00,
                'price_unit' => 'Meter',
                'moq' => 500,
                'stock_qty' => 15000,
                'main_image' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=80',
                'description' => 'Premium 240 GSM 100% Cotton 3/1 Twill fabric with EN ISO 11612 certified flame retardant finish. Engineered for oil & gas refinery coveralls, mining boiler suits, and electrical substation workwear.',
                'features' => "• Width: 58/60 inches\n• Weight: 240 GSM ± 5%\n• Color Fastness to Washing: 4-5 Grade\n• OEKO-TEX Standard 100 Certified\n• Available Colors: Navy Blue, Orange, Royal Blue, Khaki, Hi-Vis Yellow",
                'specifications' => [
                    ['key' => 'Composition', 'value' => '100% Ring Spun Combed Cotton'],
                    ['key' => 'Weave Pattern', 'value' => '3/1 Heavy Twill Drill'],
                    ['key' => 'Tensile Strength', 'value' => 'Warp > 1100 N, Weft > 800 N'],
                    ['key' => 'Shrinkage', 'value' => 'Less than 2.5%'],
                ],
                'packaging_details' => 'Double folded rolls of 100 meters wrapped in protective poly bags.',
                'delivery_info' => 'Dispatches in 3 business days from Surat warehouse.',
                'payment_terms' => '30% Advance, 70% against delivery / LC',
                'is_featured' => true,
                'is_sponsored' => false,
                'views_count' => 880,
            ],
        ];

        $createdProducts = [];

        foreach ($productsData as $pData) {
            $supp = $createdSuppliers[$pData['supplier_slug']] ?? null;
            $cat = $createdCategories[$pData['cat_slug']] ?? null;
            $subcat = $createdSubcategories[$pData['subcat_slug']] ?? null;

            if ($supp && $cat) {
                $product = Product::create([
                    'supplier_id' => $supp->id,
                    'category_id' => $cat->id,
                    'subcategory_id' => $subcat?->id,
                    'name' => $pData['name'],
                    'slug' => Str::slug($pData['name']) . '-' . Str::random(5),
                    'brand' => $pData['brand'],
                    'sku' => $pData['sku'],
                    'description' => $pData['description'],
                    'price' => $pData['price'],
                    'price_unit' => $pData['price_unit'],
                    'moq' => $pData['moq'],
                    'stock_qty' => $pData['stock_qty'],
                    'main_image' => $pData['main_image'],
                    'specifications' => $pData['specifications'],
                    'features' => $pData['features'],
                    'packaging_details' => $pData['packaging_details'],
                    'delivery_info' => $pData['delivery_info'],
                    'payment_terms' => $pData['payment_terms'],
                    'is_active' => true,
                    'is_featured' => $pData['is_featured'],
                    'is_sponsored' => $pData['is_sponsored'],
                    'views_count' => $pData['views_count'],
                ]);

                // Create gallery images
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $pData['main_image'],
                    'is_primary' => true,
                    'sort_order' => 1,
                ]);

                $createdProducts[] = $product;
            }
        }

        // 8. Services
        Service::create([
            'supplier_id' => $createdSuppliers['apex-industrial-machineries']->id,
            'category_id' => $createdCategories['industrial-machinery']->id,
            'name' => 'Custom CNC Precision Tooling & Turnkey Machine Retrofitting',
            'slug' => 'custom-cnc-precision-tooling-retrofitting',
            'description' => 'Complete engineering design, CAD/CAM programming, machine retrofitting with CNC controls, and on-site commissioning services for heavy manufacturing plants.',
            'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80',
            'price_range' => '₹50,000 - ₹5,00,000 / Project',
            'is_active' => true,
        ]);

        Service::create([
            'supplier_id' => $createdSuppliers['novatech-solar-energy']->id,
            'category_id' => $createdCategories['solar-products']->id,
            'name' => 'Turnkey Commercial & Industrial MW Solar EPC Contracting',
            'slug' => 'turnkey-commercial-industrial-solar-epc',
            'description' => 'End-to-end solar EPC contracting including site shadow analysis, net-metering approvals, structural mounting, electrical installation, and 25-year O&M maintenance.',
            'image' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600&auto=format&fit=crop&q=80',
            'price_range' => '₹32,000 - ₹38,000 / kW Installed',
            'is_active' => true,
        ]);

        // 9. Buy Requirements (RFQs)
        $rfq1 = Requirement::create([
            'buyer_id' => $buyer1->id,
            'category_id' => $createdCategories['solar-products']->id,
            'title' => 'Urgent Requirement: 200kW Mono PERC 540W+ Solar PV Modules for Factory Rooftop',
            'description' => 'We require 380 units of Tier-1 certified 540W to 550W Mono PERC Solar Panels with minimum 21% efficiency and ALMM approval for our industrial plant in Navi Mumbai. Delivery required within 20 days.',
            'quantity' => 380,
            'quantity_unit' => 'Pieces',
            'target_price' => 11000.00,
            'preferred_location' => 'Mumbai / Maharashtra / Gujarat',
            'delivery_location' => 'Turbhe MIDC, Navi Mumbai, Maharashtra',
            'pincode' => '400705',
            'required_by' => now()->addDays(20),
            'payment_terms' => '30% Advance, 70% on Site Delivery',
            'additional_requirements' => 'Must include 12-year product warranty and BIS certification certificate.',
            'status' => 'open',
        ]);

        $rfq2 = Requirement::create([
            'buyer_id' => $buyer1->id,
            'category_id' => $createdCategories['construction-materials']->id,
            'title' => 'Bulk Purchase: 50 Metric Tons Primary Fe 550D TMT Rebars (12mm, 16mm, 20mm)',
            'description' => 'Looking for direct quotes from primary steel distributors/mills for 50 Metric Tons of Fe 550D TMT bars for our commercial infrastructure project in Pune. Immediate trailer delivery needed.',
            'quantity' => 50,
            'quantity_unit' => 'Metric Tons',
            'target_price' => 57500.00,
            'preferred_location' => 'Pune / Mumbai / Western India',
            'delivery_location' => 'Hinjewadi Phase 2, Pune, Maharashtra',
            'pincode' => '411057',
            'required_by' => now()->addDays(10),
            'payment_terms' => '100% RTGS against weighbridge slip & MTC',
            'additional_requirements' => 'Test certificates must match heat number stamped on rebars.',
            'status' => 'quoted',
        ]);

        $rfq3 = Requirement::create([
            'buyer_id' => $buyer2->id,
            'category_id' => $createdCategories['packaging-materials']->id,
            'title' => 'Monthly Contract: 20,000 Custom Printed 5-Ply Corrugated Delivery Boxes',
            'description' => 'Seeking reliable packaging manufacturer for ongoing monthly requirement of 20,000 5-ply kraft corrugated boxes (Size: 18x12x10 inches) with 2-color brand logo printing for our retail distribution chain.',
            'quantity' => 20000,
            'quantity_unit' => 'Pieces',
            'target_price' => 30.00,
            'preferred_location' => 'Delhi NCR / Haryana / Rajasthan / Gujarat',
            'delivery_location' => 'Kundli Industrial Area, Sonipat, Haryana',
            'pincode' => '131028',
            'required_by' => now()->addDays(15),
            'payment_terms' => 'Net 30 Days Credit after initial 2 cycles',
            'additional_requirements' => 'Must submit physical sample box for drop test approval before PO.',
            'status' => 'open',
        ]);

        // 10. Quotes Submitted by Suppliers for RFQ 1 & RFQ 2
        Quote::create([
            'requirement_id' => $rfq1->id,
            'supplier_id' => $createdSuppliers['novatech-solar-energy']->id,
            'buyer_id' => $buyer1->id,
            'unit_price' => 10950.00,
            'quantity' => 380,
            'moq' => 100,
            'delivery_time_days' => 7,
            'shipping_charges' => 15000.00,
            'payment_terms' => '20% Advance, 80% against dispatch invoice',
            'validity_date' => now()->addDays(14),
            'notes' => 'We can supply 380 units of NovaTech 550W Bifacial Mono PERC modules immediately from our Bhiwandi warehouse with BIS & ALMM test certificates included.',
            'status' => 'pending',
        ]);

        Quote::create([
            'requirement_id' => $rfq2->id,
            'supplier_id' => $createdSuppliers['vanguard-steel-infra']->id,
            'buyer_id' => $buyer1->id,
            'unit_price' => 58000.00,
            'quantity' => 50,
            'moq' => 10,
            'delivery_time_days' => 3,
            'shipping_charges' => 0.00, // Free delivery for 50 MT
            'payment_terms' => '100% RTGS against Proforma',
            'validity_date' => now()->addDays(7),
            'notes' => 'Special infrastructure rate: ₹58,000/MT inclusive of transportation to Hinjewadi, Pune. Full 12m lengths with original Mill Test Certificates (MTC).',
            'status' => 'accepted',
        ]);

        // 11. Inquiries
        $firstProduct = $createdProducts[0] ?? null;
        if ($firstProduct) {
            Inquiry::create([
                'product_id' => $firstProduct->id,
                'supplier_id' => $firstProduct->supplier_id,
                'buyer_id' => $buyer1->id,
                'buyer_name' => 'Rajesh Kumar',
                'buyer_email' => 'buyer@ozura.com',
                'buyer_phone' => '+91 98201 12345',
                'quantity' => 2,
                'expected_price' => 720000.00,
                'delivery_location' => 'Mumbai, Maharashtra',
                'message' => 'Hello Apex Machinery team, we are expanding our tool room and looking to order 2 units of your 3000 RPM CNC Lathe machine. Can you provide lead time, installation support in Mumbai, and best export commercial terms?',
                'status' => 'accepted',
                'supplier_reply' => 'Dear Rajesh, thank you for your inquiry. We have units ready in stock and our Mumbai engineering team will handle on-site installation and operator training at no extra charge. We have sent you a detailed technical proposal.',
            ]);
        }

        // 12. Messages (Real-time chat thread)
        $supplier1User = $createdSuppliers['apex-industrial-machineries']->user;
        Message::create([
            'sender_id' => $buyer1User->id,
            'receiver_id' => $supplier1User->id,
            'message' => 'Hi Arunachalam, following up on our inquiry for the Apex CNC Lathe 3000X. Is it possible to schedule a video demonstration of the machine spindle under load test?',
            'is_read' => true,
            'read_at' => now()->subHours(5),
            'created_at' => now()->subHours(6),
        ]);

        Message::create([
            'sender_id' => $supplier1User->id,
            'receiver_id' => $buyer1User->id,
            'message' => 'Hello Mr. Rajesh! Absolutely. I can connect you live with our chief testing engineer at our Coimbatore assembly plant today at 3:30 PM. Would that work for you?',
            'is_read' => true,
            'read_at' => now()->subHours(3),
            'created_at' => now()->subHours(4),
        ]);

        Message::create([
            'sender_id' => $buyer1User->id,
            'receiver_id' => $supplier1User->id,
            'message' => '3:30 PM works great! Please share the meeting link. Also, please confirm if the Siemens 808D controller comes with conversational programming enabled.',
            'is_read' => false,
            'created_at' => now()->subMinutes(30),
        ]);

        // 13. Reviews & Ratings
        $apexSupplier = $createdSuppliers['apex-industrial-machineries'];
        Review::create([
            'supplier_id' => $apexSupplier->id,
            'buyer_id' => $buyer1->id,
            'product_id' => $firstProduct?->id,
            'quality_rating' => 5,
            'communication_rating' => 5,
            'delivery_rating' => 5,
            'pricing_rating' => 5,
            'service_rating' => 5,
            'overall_rating' => 5.00,
            'title' => 'Top notch precision machinery & exceptional on-site support!',
            'comment' => 'We procured 3 CNC Lathe units from Apex Industrial for our automotive components plant. The spindle accuracy and rigid bed construction are world-class. Arunachalam and his engineering team provided outstanding commissioning support.',
            'supplier_reply' => 'Thank you Rajesh for your valued partnership and feedback! We look forward to supporting your upcoming plant expansions.',
            'status' => 'approved',
        ]);

        Review::create([
            'supplier_id' => $createdSuppliers['novatech-solar-energy']->id,
            'buyer_id' => $buyer1->id,
            'quality_rating' => 5,
            'communication_rating' => 5,
            'delivery_rating' => 4,
            'pricing_rating' => 5,
            'service_rating' => 5,
            'overall_rating' => 4.80,
            'title' => 'Excellent generation performance from 550W Bifacial modules',
            'comment' => 'Our 150kW rooftop installation has been running for 6 months now and generating approx 8-10% higher than estimated PVsyst models. Highly recommended supplier for commercial solar projects.',
            'status' => 'approved',
        ]);

        // 14. Advertisements & Banners
        Advertisement::create([
            'supplier_id' => $apexSupplier->id,
            'title' => 'Mega Industrial Tech Expo 2026 - Up to 15% Off CNC Machines',
            'placement' => 'hero_slider',
            'image_path' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1600&auto=format&fit=crop&q=80',
            'target_url' => '/suppliers/' . $apexSupplier->slug,
            'starts_at' => now()->subDays(5),
            'ends_at' => now()->addDays(25),
            'is_active' => true,
        ]);

        Advertisement::create([
            'supplier_id' => $createdSuppliers['novatech-solar-energy']->id,
            'title' => 'Switch Your Factory to Solar - Zero Capital Expenditure Models',
            'placement' => 'hero_slider',
            'image_path' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=1600&auto=format&fit=crop&q=80',
            'target_url' => '/suppliers/' . $createdSuppliers['novatech-solar-energy']->slug,
            'starts_at' => now()->subDays(2),
            'ends_at' => now()->addDays(30),
            'is_active' => true,
        ]);

        // 15. Notifications
        Notification::create([
            'user_id' => $supplier1User->id,
            'type' => 'inquiry',
            'title' => 'New Product Inquiry Received',
            'message' => 'Rajesh Kumar from Apex Infra Projects sent an inquiry for "Apex UltraPrecision CNC Lathe Machine".',
            'link' => '/supplier/inquiries',
            'is_read' => false,
        ]);

        Notification::create([
            'user_id' => $buyer1User->id,
            'type' => 'quote',
            'title' => 'New Quotation Received for your RFQ',
            'message' => 'NovaTech Solar has submitted a quotation of ₹10,950/Piece for your 200kW Solar Modules requirement.',
            'link' => '/buyer/quotes',
            'is_read' => false,
        ]);
    }
}
