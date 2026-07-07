@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">
        Edit Payment
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

    <form action="{{ route('payments.update',$payment->payment_id) }}"
          method="POST">

        @csrf
        @method('PUT')

        @include('payments._form')

    </form>

</div>

@endsection