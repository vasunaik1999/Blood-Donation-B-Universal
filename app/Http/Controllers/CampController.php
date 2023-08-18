<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $camps = Camp::where('organized_by','=',Auth::user()->id)->get();
        return view('admin-panel.camps.index', compact('camps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-panel.camps.create');
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
            'location' => 'required',
            'address' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'no_of_days' => 'required',
            'description' => 'required'
        ]);

        $camp = new Camp();
        $camp->name = $request->name;
        $camp->organized_by = Auth::user()->id;
        $camp->location = $request->location;
        $camp->address = $request->address;
        $camp->from_date = $request->from_date;
        $camp->to_date = $request->to_date;
        $camp->description = $request->description;
        $camp->no_of_days = $request->no_of_days;

        $camp->save();
        return redirect()->back()->with('status','Camp Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function show(Camp $camp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function edit(Camp $camp)
    {
        return view('admin-panel.camps.edit', compact('camp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Camp $camp)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'address' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'no_of_days' => 'required',
            'description' => 'required'
        ]);

        $camp = Camp::find($request->camp_id);
        $camp->name = $request->name;
        $camp->location = $request->location;
        $camp->address = $request->address;
        $camp->from_date = $request->from_date;
        $camp->to_date = $request->to_date;
        $camp->description = $request->description;
        $camp->no_of_days = $request->no_of_days;

        $camp->update();
        return redirect()->back()->with('status','Details Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Camp $camp)
    {
        //
    }
}
