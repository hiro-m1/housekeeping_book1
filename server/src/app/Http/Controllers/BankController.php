<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\StoreSubject;
use App\Models\Bank;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = DB::table('banks');
        $query->select('id', 'bank_name', 'branch_name', 'balance', 'created_at', 'updated_at');
        $query->where('user_id', auth()->id());
        $query->orderBy('id', 'asc');
        $banks = $query->paginate(10);

        return view('bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bank.create',);
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
        $bank = new Bank();

        //$_POST['name']
        $bank->bank_name = $request->input('bank_name');
        $bank->branch_name = $request->input('branch_name');
        $bank->balance = $request->input('balance');
        $bank->user_id = auth()->id();
        
        $bank->save();
        
        $request->session()->regenerateToken();
        return redirect('bank/index');
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
        $query = DB::table('banks');
        $query->select('id', 'bank_name', 'branch_name', 'balance');
        $query->where('user_id', auth()->id());
        $query->where('id', $id);
        $bank = $query->first();

        return view('bank.edit', compact('bank'));
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
        $bank =Bank::find($id);

        //$_POST['name']
        $bank->bank_name = $request->input('bank_name');
        $bank->branch_name = $request->input('branch_name');
        $bank->balance = $request->input('balance');
        
        $bank->save();

        $request->session()->regenerateToken();

        return redirect('bank/index');
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
        $bank = Bank::find($id);

        $bank->delete();

        return redirect('bank/index');
    }
}
