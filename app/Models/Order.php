<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const PREPAID_BALANCE = 'prepaid_balance';
    const PRODUCT_COMMERCE= 'product_commerce';

    const STATUS_CANCLED = 'canceled';
    const STATUS_FAILED = 'fail';
    const STATUS_SUCCESS = 'success';
    const STATUS_WAITING_PAYMENT = 'waiting_payment';

    public function prepaidBalance()
    {
        return $this->hasOne(PrepaidBalance::class);
    }

    public function productCommerce()
    {
        return $this->hasOne(ProductCommerce::class);
    }

    public function getDescriptionAttribute()
    {
        if (self::PREPAID_BALANCE === $this->order_type) {

            return sprintf('%s for %s', $this->prepaidBalance->value, $this->prepaidBalance->phone_number);
        }

        return sprintf('%s that cost %s', $this->productCommerce->product, $this->productCommerce->price);
    }
}
