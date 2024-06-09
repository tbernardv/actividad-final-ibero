@extends('layouts.app')

@section('content')

<!-- Imported start -->
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Checkout</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('food-checkout') }}">Checkout</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
                
    <div class="col-md-12 bg-dark">
        <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
            <h1 class="text-white mb-4">Checkout</h1>
            <form method="POST" action="{{ route('food-checkout-store') }}" class="col-md-12">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
                                @error('name')
                                    <span class="text-danger" role="alert"> {{-- invalid-feedback --}}
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            <label for="name">Your Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email">
                                @error('email')
                                    <span class="text-danger" role="alert"> {{-- invalid-feedback --}}
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            <label for="email">Your Email</label>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="town" id="town" placeholder="Town">
                                @error('town')
                                    <span class="text-danger" role="alert"> {{-- invalid-feedback --}}
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            <label for="town">Town</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="country" id="country" placeholder="Country">
                                @error('country')
                                    <span class="text-danger" role="alert"> {{-- invalid-feedback --}}
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            <label for="country">Country</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Zipcode">
                                @error('zipcode')
                                    <span class="text-danger" role="alert"> {{-- invalid-feedback --}}
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            <label for="zipcode">Zipcode</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone number">
                                @error('phone_number')
                                    <span class="text-danger" role="alert"> {{-- invalid-feedback --}}
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            <label for="phone_number">Phone number</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Address" name="address" id="address" style="height: 100px"></textarea>
                                @error('address')
                                    <span class="text-danger" role="alert"> {{-- invalid-feedback --}}
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            <label for="address">Address</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="hidden" name="price" id="price" value="{{ Session::get('total_price') }}">
                            {{--<label for="price">Price</label>--}}
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" name="submit" type="submit">Order and Pay Now</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
<!-- Imported end -->

@endsection