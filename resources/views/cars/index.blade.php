@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="table-responsive">
          

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="row">Id</th>
                            <th scope="row">Name</th>
                            <th scope="row">M. Date</th>
                            <th scope="row">Transmission</th>
                            <th scope="row">Color</th>
                            <th scope="row">Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($cars as $car)
                            <tr>
                                <td>{{ $car->id }}</td>
                                <td>{{ $car->title }}</td>
                                <td>{{ $car->m_date }}</td>
                                <td>{{ $car->transmission }}</td>
                                <td>{{ $car->color }}</td>
                                <td>{{ $car->price }}</td>
                                <td>
                                    <a href="{{ route('cars.show', ['car'=> $car->id]) }}" class="btn btn-warning btn-sm">View Car</a>
                                </td>

                                @auth
                                <td class="d-flex gap-2">
                                    <a href="{{ route('cars.edit', ['car'=> $car->id]) }}" class="btn btn-primary btn-sm">
                                        Edit Car
                                    </a>

                                    <form onsubmit="return confirm('Are you sure?')" 
                                          action="{{ route('cars.destroy', ['car'=> $car->id]) }}" 
                                          method="post">
                                            @csrf 
                                            @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                    
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No cars has been created</td>
                            </tr>
                        @endforelse
                    </tbody>


                </table>

                {!! $cars->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </section>
@endsection