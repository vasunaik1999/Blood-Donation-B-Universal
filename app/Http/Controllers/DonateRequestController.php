<?php

namespace App\Http\Controllers;

use App\Models\DonateRequest;
use App\Models\RequestHelp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonateRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'no_of_packs' => 'required|numeric',
            'in_form_of' => 'required',
            'blood_type' => 'required'
        ]);

        $donateRequest = new DonateRequest();
        $donateRequest->no_of_packs = $request->no_of_packs;
        $donateRequest->request_id = $request->request_id;
        $donateRequest->help_by = Auth::user()->id;
        $donateRequest->blood_type = $request->blood_type;
        $donateRequest->in_form_of = $request->in_form_of;

        // Approach Count Increment
        $requestHelp = RequestHelp::find($request->request_id);
        $requestHelp->approach_count += 1;

        $requestHelp->approach_packs_count += $request->no_of_packs;

        
        if($requestHelp->approach_packs_count >= $requestHelp->blood_quantity)
        {
            $requestHelp->status = 1;
        }

        $requestHelp->update();
        $donateRequest->save();

        return redirect()->back()->with('status', 'Request Submitted Successfull!');
    }

    public function markAsCompleted(Request $request)
    {
        $requestHelp = RequestHelp::find($request->donateRequest_id); 
        $requestHelp->status = 2;
        $requestHelp->update();
        
        return redirect('/my-request');
    }

    public function markAsRecieved(Request $request)
    {
        $donateRequest = DonateRequest::find($request->donateRequest_id);
        $donateRequest->status = 2;

        $requestHelp = RequestHelp::find($donateRequest->request_id);
        $requestHelp->completed = $requestHelp->completed + $donateRequest->no_of_packs;
        
        // $object = json_decode($requestHelp->helped_by);
        // if($object == null)
        // {
        //     $count = -1;
        //     $object = array(++$count => $donateRequest->help_by);
        // }else{
        //     $count = count($object);
        //     array_push($object,  $donateRequest->help_by);
        // }
        // $requestHelp->helped_by = json_encode($object);
        
        if($requestHelp->completed >= $requestHelp->blood_quantity)
        {
            $requestHelp->status = 2;
            $requestHelp->update();
            $donateRequest->update();
            return redirect('/my-request');
        }
        
        $requestHelp->update();
        $donateRequest->update();

        return redirect()->back();
    }

    public function markAsDenied(Request $request)
    {
        $donateRequest = DonateRequest::find($request->donateRequest_id);
        $donateRequest->status = 0;

        
        // Approach Count Decrement
        $requestHelp = RequestHelp::find($donateRequest->request_id);
        $requestHelp->approach_count -= 1;

        $requestHelp->approach_packs_count -= $donateRequest->no_of_packs;

        if($requestHelp->approach_packs_count < $requestHelp->blood_quantity)
        {
            $requestHelp->status = 0;
        }
        // dd($requestHelp);

        $requestHelp->update();
        $donateRequest->update();
        return redirect()->back();
    }

    public function show(DonateRequest $donateRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DonateRequest  $donateRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(DonateRequest $donateRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DonateRequest  $donateRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DonateRequest $donateRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DonateRequest  $donateRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonateRequest $donateRequest)
    {
        //
    }
}
