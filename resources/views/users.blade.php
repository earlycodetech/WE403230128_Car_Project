@extends("layouts.app")
@section('content')
    <section>
        <div class="container my-5">
            <div class="card shadow w-50 mx-auto">
                <p class="h1 card-header">List of Users</p>

                <div class="card-body">
                    <ol>
                        @forelse ($allUsers as $user)
                            <li class="text-capitalize"> {{ $user }} </li>
                        @empty
                            <p class="text-center text-danger">No User Found</p>
                        @endforelse
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection