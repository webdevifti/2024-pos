<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'product_id' => 'required',
            'total_amount' => 'required',
            'paid_amount' => 'required',
            'customer_id' => 'required',
        ]);
        try{

            $order = Order::create([
                'customer_id' => $request->customer_id,
                'total_amount' => $request->total_amount,
                'paid_amount' => $request->paid_amount,
                'due' => $request->due,
                'payment_method' => $request->payment_method,
            ]);
            $order_detail = [];
            foreach($request->product_id as $index => $item){
                $order_detail[] = [
                    'product_id' => $request->product_id[$index],
                    'quantity' => $request->quantity[$index],
                    'price' => $request->price[$index],
                    'discount' => $request->discount[$index],
                    'sub_total' => $request->sub_total[$index],
                ];
            }
            OrderDetail::create([
                'order_id' => $order->id,
                'order_detail' => json_encode($order_detail)
            ]);
            return back()->with('success','Completed');
        }catch(Exception $e){
            return back()->with('error','Something happened wrong');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function pos(){
        $get_active_product = Product::where('status', 1)->get();
        $get_active_customer = Customer::where('status',1)->get();
        return view('pos.index',compact('get_active_product','get_active_customer'));
    }
}
