<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->enum('billing_cycle', ['monthly', 'yearly', 'lifetime'])->default('yearly');
            $table->integer('product_limit')->default(5);
            $table->integer('inquiry_limit')->default(10);
            $table->boolean('has_verified_badge')->default(false);
            $table->boolean('has_priority_listing')->default(false);
            $table->boolean('has_rfq_access')->default(false);
            $table->boolean('has_analytics')->default(false);
            $table->json('features')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('buyers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->string('business_type')->nullable(); // Retailer, Wholesaler, Manufacturer, End User, etc.
            $table->string('gst_number')->nullable();
            $table->string('city')->nullable()->index();
            $table->string('state')->nullable()->index();
            $table->string('country')->default('India');
            $table->string('pincode')->nullable()->index();
            $table->text('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('subscription_plan_id')->nullable()->constrained('subscription_plans')->nullOnDelete();
            $table->string('company_name');
            $table->string('slug')->unique();
            $table->enum('business_type', ['Manufacturer', 'Wholesaler', 'Distributor', 'Trader', 'Service Provider', 'Exporter'])->default('Manufacturer');
            $table->year('year_established')->nullable();
            $table->string('employees_count')->nullable(); // e.g. "11-50 People"
            $table->string('gst_number')->nullable()->index();
            $table->string('pan_number')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->index();
            $table->string('state')->index();
            $table->string('country')->default('India');
            $table->string('pincode')->nullable()->index();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->longText('description')->nullable();
            $table->string('website')->nullable();
            $table->boolean('is_verified')->default(false)->index();
            $table->enum('verification_level', ['None', 'Mobile', 'Email', 'Business', 'GST', 'KYC', 'Premium'])->default('None');
            $table->decimal('rating_avg', 3, 2)->default(0.00);
            $table->unsignedInteger('reviews_count')->default(0);
            $table->unsignedInteger('views_count')->default(0);
            $table->boolean('is_featured')->default(false)->index();
            $table->enum('status', ['pending', 'active', 'suspended', 'rejected'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('supplier_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->enum('doc_type', ['GST_Certificate', 'PAN_Card', 'Business_License', 'ISO_Certificate', 'MSME_Udyam', 'Other']);
            $table->string('doc_number')->nullable();
            $table->string('file_path');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplier_documents');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('buyers');
        Schema::dropIfExists('subscription_plans');
    }
};
