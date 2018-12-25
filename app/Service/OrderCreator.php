<?php

namespace App\Service;

use App\Models\Order;

class OrderCreator
{
    public function createOrder(string $type, int $total)
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;

        switch ($type) {
            case Order::PREPAID_BALANCE:
                $order->total = $total + ($total * 0.05);
                $order->order_type = Order::PREPAID_BALANCE;
                break;
            case Order::PRODUCT_COMMERCE:
                $order->total = $total + 10000;
                $order->order_type = Order::PRODUCT_COMMERCE;
                break;
            default:
                throw new \Exception("Order Type not Found");
                break;
        }

        $order->order_number = rand(1000000000, 9999999999);
        $order->status = Order::STATUS_WAITING_PAYMENT;
        $order->save();

        return $order;
    }
}
