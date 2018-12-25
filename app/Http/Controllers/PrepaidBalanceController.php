<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrepaidBalancerequest;
use App\Models\Order;
use App\Models\PrepaidBalance;
use App\Service\OrderCreator;
use DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class PrepaidBalanceController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var App\Service\OrderCreator
     */
    private $orderCreator;

    public function __construct(OrderCreator $orderCreator)
    {
        $this->orderCreator = $orderCreator;
    }
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

            $order = $this->orderCreator->createOrder(Order::PREPAID_BALANCE, $request->value);
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
