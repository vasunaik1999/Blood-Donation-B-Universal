<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blood Donation Camps') }}
        </h2>
    </x-slot>

    <div class="py-12 container">
        <div class="card">
            <div class="card-body">
                <a href="{{route('camp.create')}}" class="btn btn-primary">Create Camp</a>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($camps as $key => $camp)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$camp->name}}</td>
                                <td>
                                    From: {{$camp->from_date}} <br>
                                    To: {{$camp->to_date}}
                                </td>
                                <td>
                                    {{$camp->location}} <br>
                                    {{$camp->address}}
                                </td>
                                <td>
                                    <a href="{{url('camp/'.$camp->id.'/edit')}}" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>