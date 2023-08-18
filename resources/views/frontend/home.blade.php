@extends('welcome')

@section('title')
Home | B-Universal
@endsection

@section('content')
    <section id="home-hero-section">
        <div class="row">
            <div class="col-lg-6" style="height: 100%;"><!-- style="height: 100%; display:flex; justify-content:center; flex-direction: column;" -->
                <h1 class="main-text">B-Universal</h1>
                <p class="tagline-text">Keep The World Beating</p>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{route('request.create')}}" class="btn home-primary-button mx-auto">Request Blood</a>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="btn home-secondary-button mx-auto mt-2 mt-md-0">Donate Blood</a>
                    </div>
                </div>
                <p class="mt-4 grey-color text-center">If you want to help anyone by giving blood, by organizing Blood Donation Camps, Volunteering for blood donation camps then join our platform and reach to maximum people.</p>
            </div>
            <div class="col-lg-6 text-center" style="height:100%;">
                <img class="hero-section-svg" src="{{asset('/images/hero-section-1.svg')}}" alt="" width="80%">
            </div>
        </div>
    </section>
@endsection