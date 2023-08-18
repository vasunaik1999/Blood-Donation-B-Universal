@extends('welcome')

@section('title')
Requests | B-Universal
@endsection

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <p style="font-size: 40px;">My Profile</p>
        <form method="post" action="{{route('profile.update')}}">
            @csrf
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Name <span class="req-star">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name..." value="{{Auth::user()->name}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="phone" class="form-label">Phone Number <span class="req-star">*</span></label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number..." value="{{Auth::user()->phone}}" aria-describedby="whatsappHelp" disabled>
                    <div id="whatsappHelp" class="form-text">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="isWhatsapp1" id="isWhatsapp1" @if(Auth::user()->isWhatsapp == 1 || Auth::user()->isWhatsapp == 3) checked @endif>
                            <label class="form-check-label" for="isWhatsapp1">Is this your Whatsapp Number?</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="secondaryPhone" class="form-label">Secondary Phone Number</label>
                    <input type="number" class="form-control" id="secondaryPhone" name="secondaryPhone" placeholder="Secondary Phone Number..." value="{{Auth::user()->secondaryPhone}}" aria-describedby="whatsappHelp2">
                    <div id="whatsappHelp2" class="form-text">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="isWhatsapp2" id="isWhatsapp2"  @if(Auth::user()->isWhatsapp == 2 || Auth::user()->isWhatsapp == 3) checked @endif>
                            <label class="form-check-label" for="isWhatsapp2" >Is this your Whatsapp Number?</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email..." value="{{Auth::user()->email}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="bloodGroup" class="form-label">Blood Group <span class="req-star">*</span></label>
                    <select name="bloodGroup" class="form-control" id="bloodGroup">
                        @if(Auth::user()->bloodGroup != null)<option value="{{Auth::user()->bloodGroup}}">{{Auth::user()->bloodGroup}}</option>@endif
                        <option value="">-- Select Blood Group --</option>
                        <option value="A +ve">A +ve</option>
                        <option value="A +ve">A -ve</option>
                        <option value="A +ve">AB -ve</option>
                        <option value="A +ve">O -ve</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="canDonate" class="form-label">Donate Blood <span class="req-star">*</span></label>
                    <select name="canDonate" class="form-control" id="canDonate">
                        <option value="1" @if(Auth::user()->canDonate == 1)selected @endif>I can Donate</option>
                        <option value="0" @if(Auth::user()->canDonate == 0)selected @endif>I Can't Donate</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="addressLine" class="form-label">Address <span class="req-star">*</span></label>
                    <input type="text" class="form-control" id="addressLine" name="addressLine" placeholder="Your Address..." value="{{Auth::user()->addressLine}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="city" class="form-label">City <span class="req-star">*</span></label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Your city..." value="{{Auth::user()->city}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="taluka" class="form-label">Taluka <span class="req-star">*</span></label>
                    <input type="text" class="form-control" id="taluka" name="taluka" placeholder="Enter Taluka..." value="{{Auth::user()->taluka}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="state" class="form-label">State <span class="req-star">*</span></label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="Your state..." value="{{Auth::user()->state}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="pincode" class="form-label">Pincode <span class="req-star">*</span></label>
                    <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode..." value="{{Auth::user()->pincode}}">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="sendEmail" class="form-label">Send Email (when there is need for help) <span class="req-star">*</span></label>
                    <select name="sendEmail" class="form-control" id="sendEmail">
                        <option value="1" @if(Auth::user()->sendEmail == 1)selected @endif>Yes</option>
                        <option value="0" @if(Auth::user()->sendEmail == 0)selected @endif>No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="sendSms" class="form-label">Send Sms (when there is need for help) <span class="req-star">*</span></label>
                    <select name="sendSms" class="form-control" id="sendSms">
                        <option value="1" @if(Auth::user()->sendSms == 1)selected @endif>Yes</option>
                        <option value="0" @if(Auth::user()->sendSms == 0)selected @endif>No</option>
                    </select>
                </div>
            </div>
            <button class="btn primary-button" type="submit">Update Profile</button>
        </form>
    </div>
</div>
@endsection