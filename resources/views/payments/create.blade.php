@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">
        Record Payment
    </h2>

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('payments.store') }}" method="POST">

        @csrf

        @include('payments._form')

    </form>

</div>

@endsection