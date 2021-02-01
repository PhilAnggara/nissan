@extends('layouts.bglogin')

@section('title')
    Selamat Datang
@endsection

@section('content')
<header class="text-center"><br><br>
    <h1 class="col-12 text-center font-weight-bold mb-5 text-light title">
        Selamat Datang {{ Auth::user()->name }}
    </h1>
    <a class="btn btn-primary px-4 mt-4" href="{{ route('dashboard') }}">
        Lanjutkan ke Dashboard
    </a>
</header>
@endsection

@push('prepend-style')

    <style type="text/css">
        header {
            padding: 180px 0 257px;
            background-image: url("frontend/images/header.jpg");
            background-size: cover;
        }
        .title {
            font-size: 60px;
        }
    </style>
    
@endpush