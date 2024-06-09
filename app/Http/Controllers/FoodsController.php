<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Cart;

use App\Models\Food;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FoodsController extends Controller
{
    //Food details
    public function foodDetails($id){
        $foodItem = Food::find($id);

        //Verifying if user added item
        if(Auth::user()){
            $cartVerifying = Cart::where('food_id', $id)
            ->where('user_id', Auth::user()->id)->count();

            return view('food_details', compact('foodItem', 'cartVerifying'));
        } else {
            return view('food_details', compact('foodItem'));
        }
        
    }

    //Cart
    public function cart(Request $request, $id){
        $cart = Cart::create([
            'user_id' => $request->user_id,
            'food_id' => $request->food_id,
            'name' => $request->name,
            'image' => $request->image,
            'price' => $request->price
        ]);

        if($cart){
            return redirect()->route('food-details', $id)->with([
                'success' => 'Item added to cart successfully!',
            ]);
        }
    }

    //Displaying cart items
    public function displayCartItems(){
        if(Auth::user()){
            $cartItems = Cart::where('user_id', Auth::user()->id)
                ->get();

            $totalPrice = Cart::where('user_id', Auth::user()
                ->id)->sum('price');
            
            return view('cart', compact('cartItems', 'totalPrice'));
        } else{
            abort('404');
        }
    }

    //Deleting cart items
    public function deleteCartItems($id){
        $deletedItem = Cart::where('user_id', Auth::user()->id)
            ->where('food_id', $id)
            ->delete();
        
        if($deletedItem){
            return redirect()->route('food-display-cart')->with([
                'delete' => 'Item deleted from cart sucessfully!'
            ]);
        }
    }

    //Prepare checkout
    public function prepareCheckout(Request $request){
        $value = $request->price;

        Session::put('total_price', $value);
        $totalPrice = Session::get('total_price');

        if($totalPrice > 0){
            return redirect()->route('food-checkout');
        }
    }

    //Checkout
    public function checkout(){
        if(Session::get('total_price') == 0){
            abort('403');
        } else {
            return view('checkout');
        }
    }

    //Store checkout
    public function storeCheckout(Request $request){

        Request()->validate([
            "name" => "required",
            "email" => "required",
            "town" => "required",
            "country" => "required",
            "zipcode" => "required",
            "phone_number" => "required",
            "address" => "required",
            "price" => "required",
        ]);

        $checkout = Checkout::create([
            'name' => $request->name,
            'email' => $request->email,
            'town' => $request->town,
            'country' => $request->country,
            'zipcode' => $request->zipcode,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'user_id' => Auth::user()->id,
            'price' => $request->price,
        ]);

        if($checkout){
            if(Session::get('total_price') == 0){
                abort('403');
            } else {
                return redirect()->route('foods-pay');
            }
        }
    }

    //Pay with Paypal
    public function paypalPay(){
        if(Session::get('total_price') == 0){
            abort('403');
        } else {
            return view('pay');
        }
    }

    //Success payment operation
    public function success(){
        if(isset(Auth::user()->id)){
            $deleteUserCart = Cart::where('user_id', Auth::user()->id)
            ->delete();

            if($deleteUserCart){
                if(Session::get('total_price') == 0){
                    abort('403');
                } else {
                    Session::forget('total_price');
                    return view('success')->with([
                        'success' => 'Your payment have been processed successfully!'
                    ]);
                }
            } else{
                abort('403');
            }
        } else{
            abort('403');
        }
        
    }

    //Booking tables
    public function bookingTables(Request $request) {

        Request()->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:150',
            'date' => 'required',
            'num_people' => 'required',
            'special_request' => 'required',
        ]);

        $currentDate = date('m/d/Y h:i:sa');

        if($request->date == $currentDate || $request->date < $currentDate){
            return redirect()->route('home')->with([
                'error' => 'You cannot book with the current date or a date passed.'
            ]);
        } else{
            $bookingTable = Booking::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'date' => $request->date,
                'num_people' => $request->num_people,
                'special_request' => $request->special_request
            ]);
    
            if($bookingTable){
                return redirect()->route('home')->with([
                    'booked' => 'Your table have been successfully booked.'
                ]);
            }
        }
    }

    //Menu
    public function menu() {
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

        return view('menu', compact('breakfastFoods', 'lunchFoods', 'dinnerFoods'));
    }

}
