<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(5);
        $due_contract_30 = Customer::where('limit_day', '-30')->get()->all();
        $due_contract_60 = Customer::where('limit_day', '-60')->get()->all();
        $due_contract_15 = Customer::where('limit_day', '-15')->get()->all();
        return view('customers.index',compact('customers', 'due_contract_30', 'due_contract_60', 'due_contract_15'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        // ]);
        $now = strtotime($request->start_date); // or your date as well
        $your_date = strtotime($request->end_date); 
        $datediff = $now - $your_date;

            
        $request['limit_day'] = round($datediff / (60 * 60 * 24));
        Customer::create($request->all());
        return redirect()->route('customers.index')
                        ->with('success','Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        // ]);
        $now = strtotime($request->start_date); // or your date as well
        $your_date = strtotime($request->end_date); 
        $datediff = $now - $your_date;
        $request['limit_day'] = round($datediff / (60 * 60 * 24));
        $customer->update($request->all());
    
        return redirect()->route('customers.index')
                        ->with('success','customer updated successfully');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
    
        return redirect()->route('customers.index')
                        ->with('success','User deleted successfully');    }
}
