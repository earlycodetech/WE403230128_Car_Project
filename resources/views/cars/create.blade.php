@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="card mx-auto shadow" style="max-width: 600px;">
                <h5 class="card-header">Create a new Car</h5>

                <div class="card-body">
                    <form action="{{ route('cars.store') }}" method="post">
                        @csrf
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control mb-3" placeholder="Title">

                        <input type="text" onfocus=" this.type = 'color' " name="color" value="{{ old('color') }}" class="form-control mb-3" placeholder="Color">
                        
                        <input type="text" onfocus=" this.type = 'date' " name="date" value="{{ old('date') }}" class="form-control mb-3" placeholder="Date">

                        <input type="number" name="price" value="{{ old('price') }}" class="form-control mb-3" placeholder="Price">

                        <select name="transmission" id="" class="form-select">
                            <option>Automatic</option>
                            <option>Manual</option>
                            <option>Electric</option>
                            <option selected disabled>__Select Transmission</option>
                        </select>


                        <button class="btn btn-primary my-4"> Add Car </button>
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