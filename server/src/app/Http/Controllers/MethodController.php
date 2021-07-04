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
