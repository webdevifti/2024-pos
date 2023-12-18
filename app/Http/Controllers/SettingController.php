<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('setting.index');
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            if ($request->hasFile('logo')) {
                $request->validate([
                    'logo' => 'mimes:jpg,png,jpeg',
                ]);
                $extension = $request->logo->getClientOriginalExtension();
                $image = uniqid() . '.' . $extension;
                $request->logo->move('uploads/logo/', $image);
            }else{
               $image = get_option('site_logo');
            }

            // create the options if not exists
            create_option('site_name');
            create_option('site_logo');
            create_option('site_description');
            create_option('currency_name');
            create_option('currency_icon');
            create_option('phone');
            create_option('email');
            create_option('address');

            // update the key_values if key exists
            update_option('site_name', $request->name);
            update_option('site_logo', $image);
            update_option('site_description', $request->description);
            update_option('currency_name', $request->currency_name);
            update_option('currency_icon', $request->currency_icon);
            update_option('phone', $request->phone);
            update_option('email', $request->email);
            update_option('address', $request->address);
            
            return back()->with('success','Information has been updated');
        }catch(Exception $e){
            return back()->with('error','Oops! Could not updated');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
