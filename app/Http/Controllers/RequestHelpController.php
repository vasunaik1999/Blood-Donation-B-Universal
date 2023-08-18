<?php

namespace App\Http\Controllers;

use App\Models\DonateRequest;
use App\Models\RequestHelp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RequestHelpController extends Controller
{
    public function index()
    {
        $requests = RequestHelp::where('status','!=',2)->orderBy('id', 'DESC')->get();        
        $completedRequests = RequestHelp::where('status','=',2)->orderBy('id', 'DESC')->get();
        // dd($completedRequests);
        return view('frontend.request.index', compact('requests','completedRequests'));
    }

    public function create()
    {
        return view('frontend.request.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'phone' => 'required|digits:10|numeric',
            'patient_name' => 'required',
            'blood_quantity' => 'required',
            'required_blood_group' => 'required',
            'hospital' => 'required',
            'required_before' => 'required'
        ]);

        $requestHelp = new RequestHelp();
        $requestHelp->createdBy = Auth::user()->id;
        $requestHelp->name = $request->name;
        $requestHelp->phone = $request->phone;
        $requestHelp->patient_name = $request->patient_name;
        $requestHelp->required_for = $request->required_for;
        $requestHelp->required_blood_group = $request->required_blood_group;
        $requestHelp->blood_quantity = $request->blood_quantity;
        $requestHelp->hospital = $request->hospital;
        $requestHelp->required_before = $request->required_before;

        if ($request->isWhatsapp == "on") {
            $requestHelp->isWhatsapp = 1;
        }

        $requestHelp->save();
        return redirect()->back()->with('status', 'Request Created Successfull!');
    }

    public function view(RequestHelp $requestHelp)
    {
        $req = $requestHelp;
        $donateRequests = DB::table('donate_requests')
            ->join('users', 'donate_requests.help_by', '=', 'users.id')
            ->select('donate_requests.*', 'users.phone', 'users.name', 'users.secondaryPhone', 'users.isWhatsapp')
            ->where('donate_requests.request_id', '=', $requestHelp->id)
            // ->where('donate_requests.status','!=',0)
            ->get();

        //dd($donateRequests);

        $myDonateRequest = DonateRequest::where('help_by', '=', Auth::user()->id)
            ->where('request_id', '=', $requestHelp->id)->latest()->first();

        if ($requestHelp->createdBy != Auth::user()->id) {
            return view('frontend.request.view', compact('req', 'myDonateRequest', 'donateRequests'));
        } else {
            return redirect()->back();
        }
    }

    // My Request
    public function myRequest()
    {
        $reqs = RequestHelp::where('createdBy', '=', Auth::user()->id)->orderBy('id', 'DESC')->get();
        // dd($reqs);
        return view('frontend.request.my-request.index', compact('reqs'));
    }

    public function myRequest_view(RequestHelp $requestHelp)
    {
        // $donateRequests = DonateRequest::where('request_id','=',$requestHelp->id)->get();
        // dd($donateRequests);
        $donateRequests = DB::table('donate_requests')
            ->join('users', 'donate_requests.help_by', '=', 'users.id')
            ->select('donate_requests.*', 'users.phone', 'users.name', 'users.secondaryPhone', 'users.isWhatsapp')
            ->where('donate_requests.request_id', '=', $requestHelp->id)
            ->where('donate_requests.status', '!=', 0)
            ->get();

        // dd($donateRequests);
        $req = $requestHelp;
        if ($requestHelp->createdBy == Auth::user()->id && $requestHelp->status != '2') {
            return view('frontend.request.my-request.view', compact('req', 'donateRequests'));
        } else {
            return redirect()->back();
        }
    }

    public function edit(RequestHelp $requestHelp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestHelp  $requestHelp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestHelp $requestHelp)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|digits:10|numeric',
            'patient_name' => 'required',
            'blood_quantity' => 'required',
            'required_blood_group' => 'required',
            'hospital' => 'required',
            'required_before' => 'required'
        ]);

        $requestHelp = RequestHelp::find($request->request_id);
        $requestHelp->name = $request->name;
        $requestHelp->phone = $request->phone;
        $requestHelp->patient_name = $request->patient_name;
        $requestHelp->required_for = $request->required_for;
        $requestHelp->required_blood_group = $request->required_blood_group;
        $requestHelp->blood_quantity = $request->blood_quantity;
        $requestHelp->hospital = $request->hospital;
        $requestHelp->required_before = $request->required_before;

        if ($request->isWhatsapp == "on") {
            $requestHelp->isWhatsapp = 1;
        } else {
            $requestHelp->isWhatsapp = 0;
        }

        $requestHelp->update();
        return redirect()->back()->with('status', 'Request Updated Successfull!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestHelp  $requestHelp
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestHelp $requestHelp)
    {
        //
    }
}
