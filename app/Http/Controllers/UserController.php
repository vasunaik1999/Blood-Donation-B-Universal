<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit_profile()
    {
        return view('frontend.profile.edit');
    }

    public function update_profile(Request $request)
    {
        //  dd($request);
        $request->validate([
            'name' => 'required',
            'bloodGroup' => 'required',
            'canDonate' => 'required',
            'addressLine' => 'required',
            'pincode' => 'required',
            'city' => 'required',
            'taluka' => 'required',
            'state' => 'required',
            'sendEmail' => 'required',
            'sendSms' => 'required'
        ]);

        $user = User::find($request->user_id);

        $user->name = $request->name;
        $user->secondaryPhone = $request->secondaryPhone;
        $user->email = $request->email;
        $user->bloodGroup = $request->bloodGroup;
        $user->canDonate = $request->canDonate;
        $user->addressLine = $request->addressLine;
        $user->city = $request->city;
        $user->taluka = $request->taluka;
        $user->state = $request->state;
        $user->pincode = $request->pincode;
        $user->sendEmail = $request->sendEmail;
        $user->sendSms = $request->sendSms;

        $whatsappValue = 0;
        if ($request->isWhatsapp1 == 'on' && $request->isWhatsapp2 == 'on') {
            $whatsappValue = 3;
        } else if ($request->isWhatsapp1 == 'on') {
            $whatsappValue = 1;
        } else if ($request->isWhatsapp2 == 'on') {
            $whatsappValue = 2;
        }

        $user->isWhatsapp = $whatsappValue;

        // dd($user);
        $user->update();

        return redirect()->back()->with('status','Profile Updated Successfully!');
    }
}
