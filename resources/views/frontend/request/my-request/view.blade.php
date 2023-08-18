@extends('welcome')

@section('title')
My Request| B-Universal
@endsection

@section('content')
<div class="card mt-5">
    <div class="card-body">
        <h5>Help Recieved</h5>
        @if($donateRequests->isEmpty())
        <p>Sorry! There are no Helps!</p>
        @else
        <div class="row">
            @foreach($donateRequests as $donateReq)
            <div class="col-md-6 mt-3 mt-md-0">
                <div class="card" style="height: 100%;">
                    <div class="card-body" style="background-color: #f6f6f6;">
                        <?php ?>
                        <span class="fw-bold"><small>Help Recieved From:</small></span> <span class="text-capitalize">{{$donateReq->name}}</span><br>
                        <span class="fw-bold"><small>Phone No.:</small></span> {{$donateReq->phone}} @if($donateReq->secondaryPhone != null)/ {{$donateReq->secondaryPhone}}@endif

                        @if($donateReq->secondaryPhone != null)
                        <div class="btn-group">
                            <button type="button" class="btn call-now-button btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Call
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="tel:{{$donateReq->phone}}">Call {{$donateReq->phone}}</a></li>
                                <li><a class="dropdown-item" href="tel:{{$donateReq->secondaryPhone}}">Call {{$donateReq->secondaryPhone}}</a></li>
                            </ul>
                        </div>
                        @else
                        <a class="btn call-now-button btn-sm" href="tel:{{$donateReq->phone}}"><i class="fas fa-phone-alt"></i> Call</a>
                        @endif
                        @if($donateReq->isWhatsapp == 1 || $donateReq->isWhatsapp == 3)
                        <a class="btn whatsapp-now-button btn-sm" href="{{url('https://api.whatsapp.com/send?phone=91'.$donateReq->phone.'&text=Hello,%20you%20have%20send%20me%20donate%20request%20on%20B-Universal%20Thank%20You%20.')}}"><i class="fab fa-whatsapp"></i> Whatsapp</a>
                        @elseif($donateReq->isWhatsapp == 2)
                        <a class="btn whatsapp-now-button btn-sm" href="{{url('https://api.whatsapp.com/send?phone=91'.$donateReq->secondaryPhone.'&text=Hello,%20I%20have%20recieved%20your%20donate%20request%20on%20B-Universal%20Thank%20You%20.')}}"><i class="fab fa-whatsapp"></i> Whatsapp</a>
                        @endif
                        <br>
                        <span class="fw-bold"><small>Blood Type:</small></span> {{$donateReq->blood_type}} <br>
                        <span class="fw-bold"><small>No. of Packs:</small></span> {{$donateReq->no_of_packs}} <br>
                        <span class="fw-bold"><small>In form of:</small></span> {{$donateReq->in_form_of}} <br>
                        <br>
                        
                        @if($donateReq->status == 2)
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-success" role="alert">
                                    You have marked this request as Recieved!
                                </div>
                            </div>
                        </div>
                        @elseif($donateReq->status == 1)
                        <span><small>Mark as Recieved only when you get the card or blood.</small></span> <br>
                        <div class="row">
                            <div class="float-left" style="width:max-content; padding-right:0;">
                                <form method="post" action="{{route('donateRequest.mark-as-recieved')}}">
                                    @csrf
                                    <input type="hidden" name="donateRequest_id" value="{{$donateReq->id}}">
                                    <button type="submit" class="btn btn-sm btn-outline-success d-inline">Mark as Recieved</button>
                                </form>
                            </div>
                            <div class="float-left" style="width:max-content; padding-left:5px;">
                                <form method="post" action="{{route('donateRequest.mark-as-denied')}}">
                                    @csrf
                                    <input type="hidden" name="donateRequest_id" value="{{$donateReq->id}}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-inline">Deny</button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<div class="card mt-4" style="background-color: #ffcccb;">
    <div class="card-body">
        <div class="row">
            <div class="col" style="color:#003334;">
                <h5>Mark as Completed</h5>
                <p>If you got help from outside then if you don't want any blood then please mark this request as completed.</p>
                <form method="post" action="{{route('donateRequest.mark-as-completed')}}">
                    @csrf
                    <input type="hidden" name="donateRequest_id" value="{{$req->id}}">
                    <!-- <input type="text" name="reason" id=""> -->
                    <button href="" class="btn btn-danger">Mark Request as Completed</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="mb-3">Edit Request</h5>
        <form method="post" action="{{route('request.update')}}">
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
                <input type="hidden" name="request_id" id="" value="{{$req->id}}">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input required type="text" class="form-control" id="name" name="name" placeholder="Your Name..." value="{{$req->name}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input required type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number..." aria-describedby="whatsappHelp" value="{{$req->phone}}">
                    <div id="whatsappHelp" class="form-text">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="isWhatsapp" id="isWhatsapp" @if($req->isWhatsapp == 1)checked @endif>
                            <label class="form-check-label" for="isWhatsapp">Is this your Whatsapp Number?</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="patient_name" class="form-label">Patient Name</label>
                    <input required type="text" class="form-control" id="patient_name" name="patient_name" placeholder="Patient Name..." value="{{$req->patient_name}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="required_for" class="form-label">Required For</label>
                    <input type="text" class="form-control" id="required_for" name="required_for" placeholder="Blood Required For..." value="{{$req->required_for}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="required_blood_group" class="form-label">Blood Group Required</label>
                    <select name="required_blood_group" class="form-control" id="required_blood_group">
                        <option value="{{$req->required_blood_group}}">{{$req->required_blood_group}}</option>
                        <option value="A +ve">A +ve</option>
                        <option value="A +ve">A -ve</option>
                        <option value="A +ve">AB -ve</option>
                        <option value="A +ve">O -ve</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="blood_quantity" class="form-label">Blood Quantity (In Packs)</label>
                    <input required type="number" class="form-control" id="blood_quantity" name="blood_quantity" placeholder="Blood Quantity in Packs..." value="{{$req->blood_quantity}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="hospital" class="form-label">Hospital (where required)</label>
                    <input required type="text" class="form-control" id="hospital" name="hospital" placeholder="Hospital Name..." value="{{$req->hospital}}">
                </div>
                <?php
                $required_before = new DateTime($req->required_before);
                ?>
                <div class="col-md-6 mb-3">
                    <label for="required_before" class="form-label">Required Before</label>
                    <input required type="datetime-local" class="form-control" id="required_before" name="required_before" placeholder="Required Before..." value="<?php echo $required_before->format("Y-m-d") . "T" . $required_before->format("H:i") ?>">
                </div>
            </div>

            <button type="submit" class="btn primary-button">Update</button>
        </form>
    </div>
</div>
@endsection