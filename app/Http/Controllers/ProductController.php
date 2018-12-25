<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductOrderRequest;
use App\Models\Order;
use App\Models\ProductCommerce;
use App\Service\OrderCreator;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductOrderRequest $request)
    {

        DB::beginTransaction();

        try {
            $productCommerce = new ProductCommerce();
            $productCommerce->price = $request->price;
            $productCommerce->product = $request->product;
            $productCommerce->shipping_address = $request->shipping_address;

            $order = $this->orderCreator->createOrder(Order::PRODUCT_COMMERCE, $request->price);

            $order->productCommerce()->save($productCommerce);

            DB::commit();

            return view('product.store', [
                'total' => $order->total,
                'orderNumber' => $order->order_number,
                'productName' => $productCommerce->product,
                'shippingAddress' => $productCommerce->shipping_address,
                'price' => $productCommerce->price,
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
