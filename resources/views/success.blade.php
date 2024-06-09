@extends('layouts.app')

@section('content')
<!-- Imported start -->
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Success</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('foods-success') }}">Success</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    {{--@if (Session::has('success'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>    
    @endif--}}
    <p class="alert alert-class alert-success">{{ $success }}</p>
</div>
<!-- Imported end -->
@endsection