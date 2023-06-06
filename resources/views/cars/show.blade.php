@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="card">
                {{-- Error Starts --}}
                   <ul class="list-unstyled">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <li class="text-danger text-center">{{ $error }}</li>
                            @endforeach
                        @endif

                        @if ($message = Session::get('success'))
                            <li class="text-success text-center">{{ $message }}</li>
                        @endif
                    </ul>
                {{-- Error Ends --}}
                <div class="row card-body">
                    <div class="col-md-6 mb-2">
                        <p>Car Name: {{ $car->title }}</p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <p>Car Color:  <span class="p-1 px-5" style="background-color: {{ $car->color }};"></span></p>
                    </div>
                        

                    <form action="{{ route('cars.add_model', ['car'=> $car->id]) }}" method="post" class="d-flex align-items-center gap-2">
                        @csrf
                        <input type="text" name="model" placeholder="Model Name" class="form-control">
                        <input type="datetime-local" name="date" class="form-control" >
                        <button class="btn btn-success">Add</button>
                    </form>
                    <div class="col-12 py-4">
                       <ul class="list-group">
                            <li class="list-group-item active fw-bold">Car Models</li>
                           @forelse ($car->models as $model)
                            <li class="list-group-item">
                                {{ $model->model }} {{ date('D jS F Y h:i a', strtotime($model->date_m)) }}
                            </li>
                           @empty
                           <li class="list-group-item">No Models Added Yet</li>
                           @endforelse
                       </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection