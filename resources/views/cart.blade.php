@extends('layouts.app')

@section('content')
    <!-- Imported start -->
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
        <div class="container text-center my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Cart</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('food-display-cart') }}">Cart</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        @if(Session::has('delete'))
            <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('delete') }}</p>
        @endif
    </div>

    <div class="container">
                
        <div class="col-md-12">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($cartItems->count() >= 1)
                        @foreach ($cartItems as $item)
                        <tr>
                            <th><img src="{{ asset('assets/img/'.$item->image.'') }}" style="max-height: 60px;"></th>
                            <td>{{ $item->name }}</td>
                            <td>$ {{ $item->price }}</td>
                            <td><a href="{{ route('food-delete-cart', $item->food_id) }}" onclick="return confirm('Are you sure you want to delete this item from cart?');" class="btn btn-danger text-white">delete</td>
                        </tr>
                        @endforeach
                    @else
                        <h6 class="alert alert-warning">You have no items in cart yet!</h6>
                    @endif
                    
                </tbody>
              </table>
              <div class="position-relative mx-auto" style="max-width: 400px; padding-left: 679px;">
                <p style="margin-left: -7px;" class="w-19 py-3 ps-4 pe-5" type="text"> Total: ${{ $totalPrice }}</p>
                @if ($totalPrice > 0)
                    <form method="POST" action="{{ route('prepare-checkout') }}">
                        @csrf
                        <input type="hidden" name="price" value="{{ $totalPrice }}">
                        <button type="submit" name="submit" class="btn btn-primary py-2 top-0 end-0 mt-2 me-2">Checkout</button>
                    </form>
                @else
                    <p class="alert alert-warning" style="width:241px;">You cannot checkout when you have no items in cart.</p>
                @endif
            </div>
        </div>
    </div>
    <!-- Imported end -->
@endsection