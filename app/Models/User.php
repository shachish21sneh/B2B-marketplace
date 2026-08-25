<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'role',
        'avatar',
        'status',
        'password',
        'email_verified_at',
        'mobile_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mobile_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSupplier(): bool
    {
        return $this->role === 'supplier';
    }

    public function isBuyer(): bool
    {
        return $this->role === 'buyer';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    public function buyer()
    {
        return $this->hasOne(Buyer::class);
    }

    public function getOrCreateBuyer(): Buyer
    {
        if ($this->buyer) {
            return $this->buyer;
        }

        return Buyer::firstOrCreate(
            ['user_id' => $this->id],
            [
                'company_name' => ($this->name ?: 'My Company') . ' Buying Ltd',
                'business_type' => 'Buyer / Trader',
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'country' => 'India',
                'pincode' => '400001',
            ]
        );
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }

    public function getOrCreateSupplier(): Supplier
    {
        if ($this->supplier) {
            return $this->supplier;
        }

        $plan = SubscriptionPlan::where('slug', 'enterprise-elite')->first() 
            ?? SubscriptionPlan::where('slug', 'free-starter')->first() 
            ?? SubscriptionPlan::first();

        return Supplier::firstOrCreate(
            ['user_id' => $this->id],
            [
                'company_name' => ($this->name ?: 'Supplier') . ' Enterprises',
                'slug' => \Illuminate\Support\Str::slug($this->name ?: 'supplier') . '-' . \Illuminate\Support\Str::random(5),
                'business_type' => 'Manufacturer',
                'city' => 'Delhi',
                'state' => 'Delhi',
                'country' => 'India',
                'status' => 'active',
                'is_verified' => true,
                'verification_level' => 'Premium',
                'subscription_plan_id' => $plan?->id,
            ]
        );
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)->latest();
    }

    public function unreadNotificationsCount()
    {
        return $this->notifications()->where('is_read', false)->count();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
