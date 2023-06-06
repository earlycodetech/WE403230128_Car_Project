@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <h2>Contact Message</h2>
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
            <form action="{{ route('send.message') }}" method="POST">
                @csrf

                <textarea name="message" class="form-control" style="height: 200px;"></textarea>
                <button class="btn btn-success my-3">Send</button>
            </form>
        </div>
    </section>
@endsection