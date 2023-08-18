@extends('welcome')

@section('title')
Requests | B-Universal
@endsection

@section('content')
<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <button class="btn btn-secondary">All</button>
                <button class="btn btn-secondary">Blood Requests</button>
                <button class="btn btn-secondary">Volunteer Requests</button>
                <button class="btn btn-secondary">Camps</button>

                <a href="{{route('request.create')}}" class="btn btn-primary float-right">Create Request</a>
            </div>
        </div>
    </div>
</div>
<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            @foreach($requests as $r)
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
                       
                        <div class="row">
                        <div class="col">
                                <?php
                                $date = date('d-m-Y H:i A', strtotime($r->required_before));
                                $agoDate = $r->required_before->diffForHumans();
                                ?>
                                Need Before: {{$date}} ({{$agoDate}})            
                            </div>
                        </div>
                        @if($r->status != 2)
                        <div class="row">
                            <div class="col">
                                Completed: {{$r->completed}}/{{$r->blood_quantity}} Packs
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
                                            <div class="row">
                                                @foreach($donateRequests as $donateReq)
                                                <?php $user = App\Models\User::find($donateReq->help_by); ?>
                                                <div class="col-md-6">
                                                    <span><small><i class="fas fa-user me-2"></i></small>{{$user->name}} ({{$donateReq->no_of_packs}} packs)</span><br>
                                                </div>
                                                @endforeach
                                            </div>
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
                                @auth
                                @if($r->createdBy == Auth::user()->id)
                                <a href="{{url('my-request/'.$r->id.'/view')}}" type="submit" class="btn request-button float-end mt-1 mt-md-0">More Details</a>
                                @else
                                <a href="{{url('requests/'.$r->id.'/view')}}" type="submit" class="btn request-button float-end mt-1 mt-md-0"><i class="fas fa-hand-holding-medical me-1"></i> Help Now</a>
                                @endif
                                @else
                                <a href="{{ route('login') }}" class="btn request-button float-end mt-1 mt-md-0">Log In to View</a>
                                @endauth
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

<div class="card mt-2">
    <div class="card-body">
        <h5>Completed Requests</h5>
        <div class="row">
            @foreach($completedRequests as $r)
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
                        <div class="row">
                            <div class="col">
                                <?php
                                $date = date('d-m-Y H:i A', strtotime($r->required_before));
                                $agoDate = $r->updated_at->diffForHumans();
                                ?>
                                Completed: {{$agoDate}}
                              
                            </div>
                        </div>
                        <!-- @if($r->status != 2)
                        <div class="row">
                            <div class="col">
                                Completed: {{$r->completed}}/{{$r->blood_quantity}} Packs
                            </div>
                        </div>
                        @endif -->
                        <div class="row">
                            <!-- @if($r->status == 2) -->
                            <div class="col">
                                <div class="card" style="background-color: black; color:white;">
                                    <div class="card-body">
                                        <?php
                                        $donateRequests = App\Models\DonateRequest::where('request_id', '=', $r->id)->where('status', '=', 2)->get();
                                        ?>
                                        <span>Donated By: <br>
                                            <div class="row">
                                                @foreach($donateRequests as $donateReq)
                                                <?php $user = App\Models\User::find($donateReq->help_by); ?>
                                                <div class="col-md-6">
                                                    <span><small><i class="fas fa-user me-2"></i>{{$user->name}} ({{$donateReq->no_of_packs}} packs)</small></span><br>
                                                </div>
                                                @endforeach
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- @else
                            <div class="col">
                                <span><small>{{$r->approach_count}} people have approach</small></span>
                            </div>
                            @endif -->
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection