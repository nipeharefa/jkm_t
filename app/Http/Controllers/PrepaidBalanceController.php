<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrepaidBalancerequest;
use App\Models\Order;
use App\Models\PrepaidBalance;
use DB;
use Illuminate\Http\Request;

class PrepaidBalanceController extends Controller
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
        return view('prepaid.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrepaidBalancerequest $request)
    {

        DB::beginTransaction();

        try {
            $prepaidBalance = new PrepaidBalance();
            $prepaidBalance->value = $request->value;
            $prepaidBalance->phone_number = $request->phone_number;

            $order = new Order();
            $order->order_type = Order::PREPAID_BALANCE;
            $order->order_number = rand(1000000000, 9999999999);
            $order->total = $request->value + ($request->value * 0.05);
            $order->status = Order::STATUS_WAITING_PAYMENT;
            $order->save();
            $order->prepaidBalance()->save($prepaidBalance);

            DB::commit();

            return view('prepaid.store', [
                'phone_number' => $request->phone_number,
                'total' => $order->total,
                'value' => $request->value,
                'orderNumber' => $order->order_number,
            ]);

        } catch(\Exception $e) {
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
