<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Checkout;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class usersController extends Controller
{
    //Get bookings
    public function getBookings(){
        $allBookings = Booking::where('user_id', Auth::user()->id)->get();

        return view('bookings', compact('allBookings'));
    }

    //Get orders
    public function getOrders(){
        $allOrders = Checkout::where('user_id', Auth::user()->id)->get();

        return view('orders', compact('allOrders'));
    }

    //View review's form
    public function viewReviewsFrm(){
        return view('write_review');
    }

    //Store review
    public function storeReview(Request $request){
        Request()->validate([
            "name" => "required|max:100",
            "review" => "required"
        ]);

        $storeReview = Review::create([
            "review" => $request->review,
            "name" => $request->name,
        ]);

        if($storeReview){
            return redirect()->route('users-reviews-create')->with([
                'success' => 'Review submitted successfully!'
            ]);
        }
    }
}
