<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_customer = Customer::latest('created_at')->get();
        return view('customer.index', compact('all_customer'));
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
            'name' => 'required',
            'phone_number' => 'required|unique:customers|max:11'
        ]);

        try{
            Customer::create([
                'fullname' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address' => $request->address,
                'join_date' => Carbon::today(),
                'notes' => $request->notes,
                'gender' => $request->gender,
                'status' => $request->status
            ]);
            return back()->with('success','New customer has been added.');
        }catch(Exception $e){
            return back()->with('error','Something happened wrong');
        }
       
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customer)
    {
        //
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required|max:11'
        ]);

        try{
            Customer::where('id',$customer)->update([
                'fullname' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address' => $request->address,
                'notes' => $request->notes,
                'gender' => $request->gender,
                'status' => $request->status
            ]);
            return back()->with('success','Customer information has been updated.');
        }catch(Exception $e){
            return back()->with('error','Something happened wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($customer)
    {
        //

        $customer = Customer::find($customer);
        try{
            $customer->delete();
            return back()->with('success', 'Customer has been deleted');
        }catch(Exception $e){
            return back()->with('error','Something wrong');
        }
    }
}
