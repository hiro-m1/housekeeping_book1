<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Method;
use Illuminate\Support\Facades\DB;

class MethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = DB::table('methods');
        $query->join('banks', 'methods.bank_id', '=', 'banks.id');
        $query->select('methods.id', 'method_name', 'closing_date', 'bank_id', 'methods.created_at', 'methods.updated_at', 'bank_name');
        $query->where('methods.user_id', auth()->id());
        $query->orderBy('methods.id', 'asc');
        $methods = $query->paginate(10);

        return view('method.index', compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $query = DB::table('banks');
        $query->select('id', 'bank_name');
        $query->where('user_id', auth()->id());
        $query->orderBy('id', 'asc');
        $banks = $query->get();


        return view('method.create',compact('banks'));

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
        $method = new Method();

        //$_POST['name']
        $method->method_name = $request->input('method_name');
        $method->closing_date = $request->input('closing_date');
        $method->bank_id = $request->input('bank_id');
        $method->user_id = auth()->id();
        
        $method->save();
        
        $request->session()->regenerateToken();
        return redirect('method/index');
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
        $query = DB::table('methods');

        $query->join('banks', 'methods.bank_id', '=', 'banks.id');
        $query->select('methods.id', 'method_name', 'closing_date', 'bank_id', 'bank_name');
        $query->where('methods.user_id', auth()->id());
        $query->where('methods.id', $id);
        $method = $query->first();

        $query_bank = DB::table('banks');
        $query_bank->select('id', 'bank_name');
        $query_bank->where('user_id', auth()->id());
        $query_bank->orderBy('id', 'asc');
        $banks = $query_bank->get();

        // $query->select('id', 'bank_name', 'branch_name', 'balance');
        // $query->where('user_id', auth()->id());

        return view('method.edit', compact('method', 'banks'));
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
        $method =Method::find($id);

        //$_POST['name']
        $method->method_name = $request->input('method_name');
        $method->closing_date = $request->input('closing_date');
        $method->bank_id = $request->input('bank_id');
        
        $method->save();

        $request->session()->regenerateToken();

        return redirect('method/index');
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
        $method = Method::find($id);

        $method->delete();

        return redirect('method/index');
    }
}
