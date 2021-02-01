@extends('layouts.bglogin')

@section('title')
  Nissan Martadinata Manado
@endsection

@section('content')

  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{ url('frontend/images/logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
        PT. Wahana Wirawan Manado
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <a class="nav-item btn btn-primary px-4 tombol" href="{{ url('') }}">Daftar</a>
        </div>
      </div>
    </div>
  </nav>
  {{-- Akhir Navbar --}}

  {{-- Jumbotron --}}
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Aplikasi Pengolahan Aset Kantor Nissan Martadinata Manado</h1>
      @guest
        <a href="{{ url('login') }}" class="btn btn-lg btn-primary px-5 tombol">Masuk</a>
      @endguest
      @auth
        <a href="{{ url('admin') }}" class="btn btn-lg btn-primary px-5 tombol">Dashboard</a>
      @endauth
    </div>
  </div>
  {{-- Akhir Jumbotron --}}

@endsection

@push('addon-style')

  <style type="text/css">
    /* Navbar */
    .navbar {
      position: relative;
      z-index: 1;
    }
    .navbar-brand {
      font-size: 16px;
    }

    /* Jumbotron */
    .jumbotron {
      background-image: url("frontend/images/header2.jpg");
      background-size: cover;
      text-align: center;
      height: 640px;
      position: relative;
    }
    .jumbotron .container {
      z-index: 1;
      position: relative;
    }
    .jumbotron::after {
      content: '';
      display: block;
      width: 100%;
      height: 30%;
      background-image: linear-gradient(to top, rgba(0,0,0,1), rgba(0,0,0,0));
      position: absolute;
      bottom: 0;
    }
    .jumbotron .display-4 {
      color: white;
      margin-top: 150px;
      font-weight: 500;
      font-size: 30px;
      text-shadow: 2px 2px 6px #000;
      margin-bottom: 30px;
    }

    /* Utility */
    .tombol {
      border-radius: 40px;
    }

    /* Desktop Version */
    @media (min-width: 992px) {

      .navbar-brand {
        font-size: 20px;
        color: white !important;
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.7);
      }

      .jumbotron {
        margin-top: -75px;
        height: 700px;
      }
      .jumbotron .display-4 {
        font-size: 62px;
      }
    }
  </style>
    
@endpush