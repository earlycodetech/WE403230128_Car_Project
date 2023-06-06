@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="card mx-auto shadow" style="max-width: 600px;">
                <h5 class="card-header">Edit {{ $car->title }} </h5>
                <h5 class="card-header">EN: {{ $car->get_engine['engine_no'] }}</h5>


                <div class="card-body">

                    <form action="{{ route('cars.image.upload', ['car' => $car->id ]) }}" method="post" enctype="multipart/form-data" class="my-4">
                        @csrf
                        @method('PATCH')

                        <label for="image">
                            <img src="{{ asset('uploads/'. ($car->image === null ? 'default.jpg' : $car->image) ) }}" alt="cars" class="w-100" style="height: 200px;">
                        </label>

                        <div class="input-group">
                            <input type="file" name="file" class="form-control" id="image">
                            <button class="btn btn-primary">Upload</button>
                        </div>
                    </form>



                    <form action="{{ route('cars.update', ['car'=> $car->id]) }}" method="post">
                        @csrf 
                        @method('PATCH')

                        <input type="text" name="title" value="{{ $car->title }}" class="form-control mb-3" placeholder="Title">

                        <input type="color"  name="color" value="{{ $car->color }}" class="form-control mb-3" placeholder="Color">
                        
                        <input type="date"  name="date" value="{{ $car->m_date }}" class="form-control mb-3" placeholder="Date">

                        <input type="number" name="price" value="{{ $car['price'] }}" class="form-control mb-3" placeholder="Price">

                        <select name="transmission" id="" class="form-select">
                            <option>Automatic</option>
                            <option>Manual</option>
                            <option>Electric</option>
                            <option selected disabled>__Select Transmission</option>
                        </select>


                        <button class="btn btn-primary my-4"> Edit Car </button>
                    </form>

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

                    
                </div>
            </div>
        </div>
    </section>
@endsection