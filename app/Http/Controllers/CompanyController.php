<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = Company::latest('created_at')->get();
        return view('companies.index', compact('companies'));
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required|unique:customers|max:11'
        ]);

        try{
            Company::create([
                'company_name' => $request->name,
                'company_phone' => $request->phone_number,
                'company_email' => $request->email,
                'company_address' => $request->address,
                'registration_date' => Carbon::today(),
                'notes' => $request->notes,
                'business_type' => $request->type,
                'taxID' => $request->taxID
            ]);
            return back()->with('success','New company has been added.');
        }catch(Exception $e){
            return back()->with('error','Something happened wrong');
        }
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company)
    {
       
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required|max:11'
        ]);

        try{
           
            Company::where('id',$company)->update([
                'company_name' => $request->name,
                'company_phone' => $request->phone_number,
                'company_email' => $request->email,
                'company_address' => $request->address,
                'notes' => $request->notes,
                'business_type' => $request->type,
                'taxID' => $request->taxID,
                'status' => $request->status
            ]);
           
            return back()->with('success','Company information has been updated.');
        }catch(Exception $e){
            return back()->with('error','Something happened wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company = Company::find($company);
        try{
            $company->delete();
            return back()->with('success', 'Company has been deleted');
        }catch(Exception $e){
            return back()->with('error','Something wrong');
        }
    }
}
