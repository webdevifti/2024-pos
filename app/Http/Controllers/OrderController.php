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
                'invoice_number' => '#'.date('ymdh').'_'.rand(111111,999999),
                'customer_id' => $request->customer_id,
                'total_amount' => $request->total_amount,
                'paid_amount' => $request->paid_amount,
                'due' => $request->due,
                'payment_method' => $request->payment_method,
                'tax_rate' => $request->tax_rate,
                'tax_amount' => $request->tax_amount,
                'discount_rate' => $request->discount_rate,
                'discount_amount' => $request->discount_amount,
            ]);
            $order_detail = [];

            foreach($request->product_id as $index => $item){
                
                $order_detail[] = [
                    'product_name' => $request->product_name[$index],
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
          
           return redirect()->route('pos.invoice', $order->id);
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

    public function posInvoice($order_id){
        // dd($order_id);
        $order = Order::findOrFail($order_id);
        $order_detail = OrderDetail::where('order_id', $order_id)->first();
        $customer_detail = Customer::findOrFail($order->customer_id);
        return view('pos.invoice', compact('order','order_detail', 'customer_detail'));
    }
}
