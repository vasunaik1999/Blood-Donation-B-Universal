@extends('welcome')

@section('title')
My Request| B-Universal
@endsection

@section('content')
<div class="card mt-5">
    <div class="card-body">
        <p style="font-size: 40px;">My Requests</p>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach($reqs as $r)
                    <div class="col-md-6">
                        <div style="height: 94%;" class="card mt-3 request-card @if($r->status == 0) red-card @elseif($r->status == 1) yellow-card @elseif($r->status == 2) green-card @endif">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span>Need: <span class="badge-area"> {{$r->required_blood_group}} </span><span class="ms-2 badge-area"> {{$r->blood_quantity}} Packs </span></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <span>Hospital: {{$r->hospital}}</span>
                                    </div>
                                </div>
                                <!-- <div class="row">
                            <div class="col-3">
                                <span>Completed</span>
                            </div>
                            <div class="col-7">
                                <?php
                                $percent = $r->completed / $r->blood_quantity * 100;
                                ?>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-2">
                                1/4
                            </div>
                        </div> -->
                                <div class="row">
                                    <div class="col">
                                        Need Before: {{$r->required_before}}
                                    </div>
                                </div>
                                @if($r->status != 2)
                                <div class="row">
                                    <div class="col">
                                        Completed: {{$r->completed}}/{{$r->blood_quantity}}
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    @if($r->status == 2)
                                    <div class="col">
                                        <div class="card" style="background-color: black; color:white;">
                                            <div class="card-body">
                                                <?php
                                                $donateRequests = App\Models\DonateRequest::where('request_id', '=', $r->id)->where('status', '=', 2)->get();
                                                ?>
                                                <span>Donated By: <br>
                                                    @foreach($donateRequests as $donateReq)
                                                    <?php $user = App\Models\User::find($donateReq->help_by); ?>
                                                    <span><small><i class="fas fa-user me-2"></i></small>{{$user->name}} ({{$donateReq->no_of_packs}} packs)</span><br>
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col">
                                        <span><small>{{$r->approach_count}} people have approach</small></span>
                                    </div>
                                    @endif

                                    @if($r->status != 2)
                                    <div class="col-md-6">
                                        <a href="{{url('my-request/'.$r->id.'/view')}}" type="submit" class="btn request-button float-end mt-1 mt-md-0">More Details</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection