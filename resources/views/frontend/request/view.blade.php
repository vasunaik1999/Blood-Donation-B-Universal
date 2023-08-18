@extends('welcome')

@section('title')
Requests | B-Universal
@endsection

@section('content')
<div class="card mt-5">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p>Name: {{$req->name}}</p>
                        <p>Phone: {{$req->phone}} <a class="btn call-now-button btn-sm me-2" href="tel:{{$req->phone}}"><i class="fas fa-phone-alt"></i> Call</a><a class="btn whatsapp-now-button btn-sm" href="{{url('https://api.whatsapp.com/send?phone=91'.$req->phone.'&text=Hello')}}"><i class="fab fa-whatsapp"></i> Whatsapp</a></p>
                        <p>Patient Name: {{$req->patient_name}}</p>
                        <p>Required For: {{$req->required_for}}</p>
                        <hr>
                        <p>Blood Group Required: {{$req->required_blood_group}}</p>
                        <p>Amount of Blood Needed: {{$req->blood_quantity}} Packs</p>
                        <p>Hospital: {{$req->hospital}}</p>
                        <p>Required Before: {{$req->required_before}}</p>
                        <hr>

                        <p>Approached By: {{$req->approach_count}} people</p> 
                        @foreach($donateRequests as $donateReq)
                            @if($donateReq->status != 0)
                                <p @if($donateReq->status == 2) style="color:#20c997;" @else style="color:#ffcc00" @endif><i class="fas fa-user me-2"></i> {{$donateReq->name}} ({{$donateReq->no_of_packs}} packs)</p>
                            @endif
                        @endforeach
                        <hr>

                        <p>Completed: {{$req->completed}}/{{$req->blood_quantity}}</p>
                        <p>Completed By:</p>
                        @foreach($donateRequests as $donateReq)
                        @if($donateReq->status == 2)
                        <p style="color:#20c997;"><i class="fas fa-user me-2"></i> {{$donateReq->name}} ({{$donateReq->no_of_packs}} packs)</p>
                        @endif
                        @endforeach
                       
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php
                $status_flag = -1;
                if ($myDonateRequest != null) {
                    if ($myDonateRequest->status == 1) {
                        $status_flag = 1;
                    } elseif ($myDonateRequest->status == 2) {
                        $status_flag = 2;
                    } elseif ($myDonateRequest->status == 0) {
                        $status_flag = 0;
                    }
                }
                ?>

                @if($status_flag == 1)
                <div class="card mt-4 mt-md-0">
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            Thank You! You have already submitted request. Please Stay in Contact with reciever!
                        </div>
                    </div>
                </div>
                @elseif($status_flag == 2)
                <div class="card mt-4 mt-md-0">
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            Thank You Very much for helping.
                        </div>
                    </div>
                </div>
                @else
                <div class="card mt-4 mt-md-0">
                    <div class="card-body">
                        @if($status_flag == 0)
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-danger" role="alert">
                                    Your Request was Declined! You can submit new request again.
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col">
                                <h4>Help Now</h4>
                                <form method="post" action="{{route('donateRequest.store')}}">
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
                                        <input type="hidden" name="request_id" value="{{$req->id}}">
                                        <p>Select the number of packs you can donate in the form of Blood or Blood donation Cards. XX Packs are needed.</p>
                                        <div class="col-md-6">
                                            <label for="no_of_packs" class="form-label">No. of Packs</label>
                                            <select name="no_of_packs" id="no_of_packs" class="form-control">
                                            <?php
                                                $n = $req->blood_quantity - $req->completed;
                                            ?>
                                            @for($i=1; $i<= $n; $i++)
                                            <option value="{{$i}}">{{$i}} Pack</option>
                                            @endfor    
                                        </select>
                                            <!-- <input type="number" class="form-control" id="no_of_packs" name="no_of_packs" placeholder="No. of Packs..."> -->
                                        </div>
                                        <div class="col-md-6">
                                            <label for="in_form_of" class="form-label">Donate in form of</label>
                                            <select class="form-control" id="in_form_of" name="in_form_of" placeholder="No. of Packs...">
                                                <option value="">-- Select --</option>
                                                <option value="Card">Card</option>
                                                <option value="Blood">Blood</option>
                                                <option value="Card + Blood">Card + Blood</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="blood_type" class="form-label">Blood Group</label>
                                            <input type="text" class="form-control" id="blood_type" name="blood_type" placeholder="Blood Group...">
                                        </div>
                                    </div>

                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" value="" id="i_agree_help" checked>
                                        <label class="form-check-label" for="i_agree_help">
                                            I Agree to TnC.
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-danger">Help Now!</button>
                                </form>

                                <p class="mt-2">
                                    <small><b>Note: Accept this request, if and only if you will be able to donate blood to this person. If you accept and does not deliver then you might get ban from this platform.</b></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4>Thank You!</h4>

                                <p>Enter OTP to mark as completed, which will be provided by the person at the time of donation.</p>
                                <input type="number" class="form-control" name="otp" id="otp" placeholder="Enter OTP...">
                                <a href="" class="btn btn-success my-2">Submit</a>
                                <p>
                                    <small><b>Note: Accept this request, if and only if you will be able to donate blood to this person.</b></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection