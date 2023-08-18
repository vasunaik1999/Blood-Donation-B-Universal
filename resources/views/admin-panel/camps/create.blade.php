<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Camp') }}
        </h2>
    </x-slot>

    <div class="py-12 container">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{route('camp.store')}}">
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
                        <div class="col-md-4 mb-3">
                            <label for="name" class="form-label">Camp Name <span class="req-star">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Camp Name...">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="location" class="form-label">Location <span class="req-star">*</span></label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Camp location...">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="address" class="form-label">Camp Address <span class="req-star">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Camp Address...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="phone" class="form-label">Contact<span class="req-star">*</span></label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Contact for Enquiry...">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="secondaryPhone" class="form-label">Secondary Contact <span class="req-star">*</span></label>
                            <input type="number" class="form-control" id="secondaryPhone" name="secondaryPhone" placeholder="Secondary Contact...">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="last_registration_date" class="form-label">Last Registration Date <span class="req-star">*</span></label>
                            <input type="datetime-local" class="form-control" id="last_registration_date" name="last_registration_date" placeholder="Last Registration Date...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="no_of_days" class="form-label">No. of days <span class="req-star">*</span></label>
                            <input type="number" class="form-control" id="no_of_days" name="no_of_days" placeholder="No. of days...">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="from_date" class="form-label">Starts At <span class="req-star">*</span></label>
                            <input type="datetime-local" class="form-control" id="from_date" name="from_date" placeholder="from date...">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="to_date" class="form-label">Ends At <span class="req-star">*</span></label>
                            <input type="datetime-local" class="form-control" id="to_date" name="to_date" placeholder="to date...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="description" class="form-label">Description <span class="req-star">*</span></label>
                            <textarea id="description-create-camp" class="form-control" rows="5" name="description" placeholder="Description of Camp..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn primary-button">Submit</button>
                </form>
            </div>
        </div>
    </div>
  

</x-app-layout>

