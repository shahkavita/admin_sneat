<?php

namespace App\Http\Controllers;
use App\Models\employee;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $s1=employee::all();
        return view('employeelist',['data'=>$s1]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        //$employee = employee::create($request->all());
       
        $employee=employee::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'department'=>$request->department,
            'skills'=>implode(',',$request->skills),
        ]);
        return response()->json($employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $s1=employee::find($id);
        return response()->json($s1);
        //return view('showemployee',compact('s1'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $s1=employee::find($id);
        return response()->json($s1);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $s1=employee::where('id',$id)
            ->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'gender'=>$request->gender,
                'department'=>$request->department,
                'skills'=>implode(',',explode(',', $request->skills)),
            ]);
            return response()->json(['message' => 'Employee Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $s1=employee::find($id);
        $s1->delete();
        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
