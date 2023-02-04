@extends('layouts.admin')
@section('content')
    <div class="container mt-4  prova">
        <div class="container mt-4">
            <h3 class="text-center text-danger fw-bold">Projects List</h3>
            <div class="row justify-content-center">
                <div class="col-11">


                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <ul class="text-white">
                        @foreach ($leads as $lead)
                            <li>{{ $lead->message }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
