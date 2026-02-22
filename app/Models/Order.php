<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $fillable = ['order_number', 'customer_id', 'status', 'total_amount'];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}