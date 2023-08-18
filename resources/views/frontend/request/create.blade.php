@extends('welcome')

@section('title')
Create Request | B-Universal
@endsection

@section('content')
<div class="card mt-5">
    <div class="card-body">
        <form method="post" action="{{route('request.store')}}">
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
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name <span class="req-star">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name..." value="{{Auth::user()->name}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone Number <span class="req-star">*</span></label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number..." aria-describedby="whatsappHelp" value="{{Auth::user()->phone}}">
                    <div id="whatsappHelp" class="form-text">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="isWhatsapp" id="isWhatsapp" @if(Auth::user()->isWhatsapp == 1 || Auth::user()->isWhatsapp == 3) checked @endif>
                            <label class="form-check-label" for="isWhatsapp">Is this your Whatsapp Number?</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="patient_name" class="form-label">Patient Name <span class="req-star">*</span></label>
                    <input type="text" class="form-control" id="patient_name" name="patient_name" placeholder="Patient Name...">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="required_for" class="form-label">Required For</label>
                    <input type="text" class="form-control" id="required_for" name="required_for" placeholder="Blood Required For...">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="required_blood_group" class="form-label">Blood Group Required <span class="req-star">*</span></label>
                    <select name="required_blood_group" class="form-control" id="required_blood_group">
                        @if(Auth::user()->bloodGroup != null)<option value="{{Auth::user()->bloodGroup}}">{{Auth::user()->bloodGroup}}</option>
                        @else
                        <option value="">-- Select Blood Group --</option>
                        @endif
                        <option value="A +ve">A +ve</option>
                        <option value="A +ve">A -ve</option>
                        <option value="A +ve">AB -ve</option>
                        <option value="A +ve">O -ve</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="blood_quantity" class="form-label">Blood Quantity (In Packs) <span class="req-star">*</span></label>
                    <input type="number" class="form-control" id="blood_quantity" name="blood_quantity" placeholder="Blood Quantity in Packs...">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="hospital" class="form-label">Hospital (where required) <span class="req-star">*</span></label>
                    <input type="text" class="form-control" id="hospital" name="hospital" placeholder="Hospital Name...">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="required_before" class="form-label">Required Before <span class="req-star">*</span></label>
                    <input type="datetime-local" class="form-control" id="required_before" name="required_before" placeholder="Required Before...">
                </div>
            </div>

            <button type="submit" class="btn primary-button">Submit</button>
        </form>
    </div>
</div>
@endsection