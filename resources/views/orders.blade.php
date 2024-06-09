@extends('layouts.app')

@section('content')
    <!-- Imported start -->
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
        <div class="container text-center my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">My orders</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users-orders') }}">My orders</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Town</th>
                        <th scope="col">Phone number</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Review</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allOrders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->town }}</td>
                            <td>{{ $order->phone_number }}</td>
                            <td>$ {{ $order->price }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                @if ($order->status == "Delivered")
                                    <a class="btn btn-success" href="#">REVIEW</a>
                                @else
                                    Not available yet
                                @endif
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Imported end -->
@endsection