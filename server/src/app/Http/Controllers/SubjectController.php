<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubject;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use App\Services\CheckFormData;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = DB::table('subjects');
        $query->select('id', 'subject_name', 'created_at', 'updated_at');
        $query->where('user_id', auth()->id());
        $query->orderBy('id', 'asc');
        $subjects = $query->paginate(10);

        return view('subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('subject.create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubject $request)
    {
        //
        $subject = new Subject;

        //$_POST['name']
        $subject->subject_name = $request->input('subject_name');
        $subject->user_id = auth()->id();
        
        $subject->save();
        
        $request->session()->regenerateToken();
        return redirect('subject/index');
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

        $query = DB::table('subjects');
        $query->select('id', 'subject_name', 'created_at', 'updated_at');
        $query->where('user_id', auth()->id());
        $query->where('id', $id);
        $subject = $query->first();

        return view('subject.edit', compact('subject'));
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
        $subject =Subject::find($id);

        //$_POST['name']
        $subject->subject_name = $request->input('subject_name');
        
        $subject->save();

        $request->session()->regenerateToken();

        return redirect('subject/index');
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
        $subject = Subject::find($id);

        $subject->delete();

        return redirect('subject/index');
    }
}
