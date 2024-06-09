<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Food;
use App\Models\Review;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $breakfastFoods = Food::select()
            ->take(4)
            ->where('category', 'Breakfast')
            ->orderBy('id', 'desc')
            ->get();

        $lunchFoods = Food::select()
            ->take(4)
            ->where('category', 'Lunch')
            ->orderBy('id', 'desc')
            ->get();

        $dinnerFoods = Food::select()
            ->take(4)
            ->where('category', 'Dinner')
            ->orderBy('id', 'desc')
            ->get();

        $reviews = Review::select()
            ->take(4)
            ->orderBy('id', 'desc')
            ->get();

        return view('home', compact('breakfastFoods', 'lunchFoods', 'dinnerFoods', 'reviews'));
    }

    //About
    public function about(){
        return view('about');
    }

    //Services
    public function services(){
        return view('services');
    }

    //Contact
    public function contact(){
        return view('contact');
    }
}
