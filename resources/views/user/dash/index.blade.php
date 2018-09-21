@extends('layouts.user')
@section('styles')
    <style>
        .page-content-wrap{
            background-color: #FFF !important;
            height: 94%;
        }

        .dept{
            margin-top: 15px;
            text-align: center;
        }

        @media only screen and (max-width: 1366px) {
            .page-content-wrap{
                height: 92%;
            }
        }
    </style>

@endsection
@section('content')
    <div class="col-sm-12 text-center">
        <h2 style="margin-top:100px">Welcome {{Auth::user()->name}}</h2>
        <img src="{{ asset('images/logo/gb_logo.png') }}" alt="IMG">
        <h2 class="dept">Computer Science & Engineering</h2>
        <h3>Gono Bishwabidyalay</h3>
    </div>
@endsection
