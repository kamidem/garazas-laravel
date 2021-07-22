<?php

namespace App\Http\Controllers;
use App\Models\Mechanic;
use Validator;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $dir = 'asc';
        $sort = 'maker';
        $defaultMechanic = 0;
        $mechanics = Mechanic::all();
        $s = '';
        // Rūšiavimas
        if ($request->sort_by && $request->dir) {
            if ('maker' == $request->sort_by && 'asc' == $request->dir) {
                $trucks = Truck::orderBy('maker')->get();
            }
            elseif ('maker' == $request->sort_by && 'desc' == $request->dir) {
                $trucks = Truck::orderBy('maker', 'desc')->get();
                $dir = 'desc';
            }
            elseif ('make_year' == $request->sort_by && 'asc' == $request->dir) {
                $trucks = Truck::orderBy('make_year')->get();
                $sort = 'make_year';
            }
            elseif ('make_year' == $request->sort_by && 'desc' == $request->dir) {
                $trucks = Truck::orderBy('make_year', 'desc')->get();
                $dir = 'desc';
                $sort = 'make_year';
            }
            else {
                $trucks = Truck::all();
            }
        }

        // Filtravimas
        elseif ($request->mechanic_id) {
            $trucks = Truck::where('mechanic_id', (int)$request->mechanic_id)->get();
            $defaultMechanic = (int)$request->mechanic_id;
        }

        // Paieška
        elseif ($request->s) {
            $trucks = Truck::where('maker', 'like', '%'.$request->s.'%')->get();
            $s = $request->s;
        }
        elseif ($request->do_search) {
            $trucks = Truck::where('maker', 'like', '')->get();

        }
        else {
            $trucks = Truck::all();
        }

        

        return view('truck.index', [
            'trucks' => $trucks,
            'dir' => $dir,
            'sort' => $sort,
            'mechanics' => $mechanics,
            'defaultMechanic' => $defaultMechanic,
            's' => $s
        ]);


        // $trucks = Truck::all();
        // return view('truck.index', ['trucks' => $trucks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mechanics = Mechanic::all();
        return view('truck.create', ['mechanics' => $mechanics]);
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
                'truck_maker' => ['required', 'min:3', 'max:50'],
                'truck_plate' => ['required', 'min:3', 'max:10'],
                'truck_make_year' => ['required', 'integer', 'min:1900', 'max:2022'],
                'truck_mechanic_notices' => ['required'],
                'mechanic_id' => ['required', 'integer', 'min:1'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $truck = new Truck;
        $truck->maker = $request->truck_maker;
        $truck->plate = $request->truck_plate;
        $truck->make_year = $request->truck_make_year;
        $truck->mechanic_notices = $request->truck_mechanic_notices;
        $truck->mechanic_id = $request->mechanic_id;
        $truck->save();
        return redirect()->route('truck.index')->with('success_message', 'Successfully saved.');
    }

    // maker: varchar(255)
// plate: varchar(20)
// make_year: tinyint(4) unsigned
// mechanic_notices: text
// mechanic_id : int(11)

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        

        $mechanics = Mechanic::all();
       return view('truck.edit', ['truck' => $truck, 'mechanics' => $mechanics]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truck $truck)
    {
        $validator = Validator::make($request->all(),
            [
                'truck_maker' => ['required', 'min:3', 'max:50'],
                'truck_plate' => ['required', 'min:3', 'max:10'],
                'truck_make_year' => ['required', 'integer', 'min:1900', 'max:2022'],
                'truck_mechanic_notices' => ['required'],
                'mechanic_id' => ['required', 'integer', 'min:1'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $truck->maker = $request->truck_maker;
        $truck->plate = $request->truck_plate;
        $truck->make_year = $request->truck_make_year;
        $truck->mechanic_notices = $request->truck_mechanic_notices;
        $truck->mechanic_id = $request->mechanic_id;
       $truck->save();
       return redirect()->route('truck.index')->with('info_message', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truck $truck)
    {
        $truck->delete();
       return redirect()->route('truck.index')->with('success_message', 'Successfully deleted.');
    }
}
