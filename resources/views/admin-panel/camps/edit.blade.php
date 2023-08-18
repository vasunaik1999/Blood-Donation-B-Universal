<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Camp') }}
        </h2>
    </x-slot>

    <div class="py-12 container">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{route('camp.update')}}">
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
                    <input type="hidden" name="camp_id" value="{{$camp->id}}">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="name" class="form-label">Camp Name <span class="req-star">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Camp Name..." value="{{$camp->name}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="location" class="form-label">Location <span class="req-star">*</span></label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Camp location..." value="{{$camp->location}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="address" class="form-label">Camp Address <span class="req-star">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Camp Address..." value="{{$camp->address}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="no_of_days" class="form-label">No. of days <span class="req-star">*</span></label>
                            <input type="number" class="form-control" id="no_of_days" name="no_of_days" placeholder="No. of days..." value="{{$camp->no_of_days}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <?php
                            $starts_at = new DateTime($camp->from_date);
                            ?>
                            <label for="from_date" class="form-label">Starts At <span class="req-star">*</span></label>
                            <input type="datetime-local" class="form-control" id="from_date" name="from_date" placeholder="from date..." value="<?php echo $starts_at->format("Y-m-d") . "T" . $starts_at->format("H:i") ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <?php
                            $ends_at = new DateTime($camp->to_date);
                            ?>
                            <label for="to_date" class="form-label">Ends At <span class="req-star">*</span></label>
                            <input type="datetime-local" class="form-control" id="to_date" name="to_date" placeholder="to date..." value="<?php echo $ends_at->format("Y-m-d") . "T" . $ends_at->format("H:i") ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="description" class="form-label">Description <span class="req-star">*</span></label>
                            <textarea id="description-create-camp" class="form-control" rows="5" name="description" placeholder="Description of Camp...">{{$camp->description}}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn primary-button">Submit</button>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>