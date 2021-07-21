<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;
use Validator;

class MechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mechanics = Mechanic::all();
       return view('mechanic.index', ['mechanics' => $mechanics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mechanic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'mechanic_name' => ['required', 'min:3', 'max:64'],
                'mechanic_surname' => ['required', 'min:3', 'max:64'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }


        $mechanic = new Mechanic;
        $mechanic->name = $request->mechanic_name;
        $mechanic->surname = $request->mechanic_surname;
        $mechanic->save();
        return redirect()->route('mechanic.index')->with('success_message', 'Successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function show(Mechanic $mechanic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function edit(Mechanic $mechanic)
    {
        
        
        return view('mechanic.edit', ['mechanic' => $mechanic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mechanic $mechanic)
    {

        $validator = Validator::make($request->all(),
            [
                'mechanic_name' => ['required', 'min:3', 'max:64'],
                'mechanic_surname' => ['required', 'min:3', 'max:64'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        
        $mechanic->name = $request->mechanic_name;
        $mechanic->surname = $request->mechanic_surname;
        $mechanic->save();
        return redirect()->route('mechanic.index')->with('success_message', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mechanic $mechanic)
    {
       if($mechanic->mechanicTrucks->count()){
           return redirect()->back()->with('info_message', 'Cannot be deleted because the mechanic has assigned cars.');
       }
       $mechanic->delete();
       return redirect()->route('mechanic.index')->with('success_message', 'Successfully deleted.');
    }
}
