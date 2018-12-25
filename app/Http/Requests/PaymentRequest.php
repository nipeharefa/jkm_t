<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_number' => [
                'required',
                'integer',
                Rule::exists('orders')->where(function ($query) {
                    $query
                        ->where('user_id', auth()->user()->id)
                        ->where('status', Order::STATUS_WAITING_PAYMENT);
                }),
            ]
        ];
    }
}
