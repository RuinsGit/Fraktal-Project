<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'name',
        'email',
        'phone',
        'address',
        'total_price',
        'delivery_type',
        'payment_type',
        'status',
        'info'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            0 => 'Sifariş verildi',
            1 => 'Hazırlanır',
            2 => 'Karqoya verildi',
            3 => 'Təhvil verildi',
            4 => 'Ləğv edildi',
            default => 'Naməlum'
        };
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            0 => 'warning',
            1 => 'primary',
            2 => 'info',
            3 => 'success',
            4 => 'danger',
            default => 'secondary'
        };
    }
}
