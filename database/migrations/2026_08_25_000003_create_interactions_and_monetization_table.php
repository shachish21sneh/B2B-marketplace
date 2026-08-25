<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('buyers')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('title');
            $table->longText('description');
            $table->integer('quantity')->default(1);
            $table->string('quantity_unit')->default('Pieces'); // Pieces, Metric Tons, Kg, Liters, Boxes
            $table->decimal('target_price', 12, 2)->nullable();
            $table->string('preferred_location')->nullable();
            $table->string('delivery_location')->nullable();
            $table->string('pincode')->nullable();
            $table->date('required_by')->nullable();
            $table->string('payment_terms')->nullable();
            $table->text('additional_requirements')->nullable();
            $table->json('attachments')->nullable();
            $table->enum('status', ['open', 'quoted', 'fulfilled', 'closed', 'cancelled'])->default('open')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('buyer_id')->nullable()->constrained('buyers')->nullOnDelete();
            $table->string('buyer_name');
            $table->string('buyer_email');
            $table->string('buyer_phone');
            $table->integer('quantity')->default(1);
            $table->decimal('expected_price', 12, 2)->nullable();
            $table->string('delivery_location')->nullable();
            $table->longText('message');
            $table->enum('status', ['new', 'read', 'accepted', 'rejected', 'quoted'])->default('new')->index();
            $table->text('supplier_reply')->nullable();
            $table->timestamps();
        });

        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requirement_id')->constrained('requirements')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('buyer_id')->constrained('buyers')->onDelete('cascade');
            $table->decimal('unit_price', 12, 2);
            $table->integer('quantity');
            $table->integer('moq')->default(1);
            $table->integer('delivery_time_days')->default(7);
            $table->decimal('shipping_charges', 10, 2)->default(0.00);
            $table->string('payment_terms')->default('100% Advance / LC');
            $table->date('validity_date')->nullable();
            $table->longText('notes')->nullable();
            $table->string('attachment')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected', 'negotiating', 'expired'])->default('pending')->index();
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('inquiry_id')->nullable()->constrained('inquiries')->nullOnDelete();
            $table->foreignId('quote_id')->nullable()->constrained('quotes')->nullOnDelete();
            $table->longText('message');
            $table->string('attachment')->nullable();
            $table->boolean('is_read')->default(false)->index();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('buyer_id')->constrained('buyers')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->unsignedTinyInteger('quality_rating')->default(5);
            $table->unsignedTinyInteger('communication_rating')->default(5);
            $table->unsignedTinyInteger('delivery_rating')->default(5);
            $table->unsignedTinyInteger('pricing_rating')->default(5);
            $table->unsignedTinyInteger('service_rating')->default(5);
            $table->decimal('overall_rating', 3, 2)->default(5.00)->index();
            $table->string('title')->nullable();
            $table->longText('comment')->nullable();
            $table->text('supplier_reply')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved')->index();
            $table->timestamps();
        });

        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'product_id', 'supplier_id']);
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('subscription_plans')->onDelete('cascade');
            $table->timestamp('starts_at');
            $table->timestamp('ends_at')->nullable();
            $table->enum('status', ['active', 'expired', 'cancelled', 'pending'])->default('active');
            $table->string('payment_id')->nullable();
            $table->timestamps();
        });

        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('subscription_plans')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('payment_gateway')->default('Razorpay');
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['success', 'failed', 'pending', 'refunded'])->default('success');
            $table->json('gateway_response')->nullable();
            $table->timestamps();
        });

        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->string('title');
            $table->enum('placement', ['hero_slider', 'category_top', 'search_sponsored', 'sidebar_banner', 'homepage_featured'])->default('hero_slider');
            $table->string('image_path');
            $table->string('target_url')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedInteger('clicks_count')->default(0);
            $table->unsignedInteger('impressions_count')->default(0);
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('type'); // inquiry, quote, message, match, verification, system
            $table->string('title');
            $table->text('message');
            $table->string('link')->nullable();
            $table->boolean('is_read')->default(false)->index();
            $table->timestamps();
        });

        Schema::create('search_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('query')->index();
            $table->integer('results_count')->default(0);
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        Schema::create('recently_viewed', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('session_id', 100)->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recently_viewed');
        Schema::dropIfExists('search_history');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('advertisements');
        Schema::dropIfExists('subscription_payments');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('quotes');
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('requirements');
    }
};
