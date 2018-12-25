<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\PaymentRequest;
use DB;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $order = Order::where('order_number', $request->order_number)->first();

        DB::beginTransaction();

        try {

            if ($order->order_type === Order::PRODUCT_COMMERCE) {
                $order->productCommerce->shipping_code = strtoupper(str_random(8));
                $order->productCommerce->save();
            }

            $order->status = Order::STATUS_SUCCESS;
            $order->pay_at = new \DateTime();
            $order->save();

            DB::commit();

            return redirect()->to(route('index.order'));

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
