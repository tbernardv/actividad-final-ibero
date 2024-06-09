<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    // View login
    public function viewLogin(){
        return view('admins.login');
    }

    //Check login
    public function checkLogin(Request $request) {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect() -> route('admins-dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    // Index
    public function index(){

        $foodCount = Food::select()->count();
        $adminCount = Admin::select()->count();
        $bookingCount = Booking::select()->count();
        $checkoutCount = Checkout::select()->count();

        return view('admins.index', compact('foodCount', 'adminCount', 'bookingCount', 'checkoutCount'));
    }

    // All Admins
    public function allAdmins(){
        $admins = Admin::select()->orderBy('id', 'desc')->get();

        return view('admins.all_admins', compact('admins'));
    }

    //Create admins
    public function createAdmins(){
        return view('admins.create_admins');
    }

    // Store admins
    public function storeAdmins(Request $request){

        Request()->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required"
        ]);

        $admin = Admin::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        if($admin){
            return redirect()->route('admins-all')->with([
                "success" => "Admin created successfully!"
            ]);
        }
    }

    // All Orders
    public function allOrders(){
        $orders = Checkout::select()
            ->orderBy('id', 'DESC')
            ->get();
        
        return view('admins.all_orders', compact('orders'));
    }

    // Edit orders
    public function editOrders($id){
        $order = Checkout::find($id);

        return view('admins.edit_orders', compact('order'));
    }

    // Update orders
    public function updateOrders(Request $request, $id){
        $order = Checkout::find($id);
        $order->update($request->all());

        if($order){
            return redirect()->route('orders-all')->with([
                "success" => "Order updated successfully!"
            ]);
        }
    }

    // Delete orders
    public function deleteOrders($id){
        $order = Checkout::find($id)
            ->delete();

        if($order){
            return redirect()->route('orders-all')->with([
                "delete" => "Order deleted successfully!"
            ]);
        }
    }

    // All bookings
    public function allBookings(){
        $bookings = Booking::select()->orderBy('id', 'DESC')->get();

        return view('admins.all_bookings', compact('bookings'));
    }

    // Edit bookings
    public function editBookings($id){
        $booking = Booking::find($id);

        return view('admins.edit_bookings', compact('booking'));
    }

    // Update bookings
    public function updateBookings(Request $request, $id){
        $booking = Booking::find($id);
        $booking->update($request->all());

        if($booking){
            return redirect()->route('bookings-all')->with([
                "update" => "Booking updated successfully!"
            ]);
        }
    }

    // Delete bookings
    public function deleteBookings($id){
        $booking = Booking::find($id);
        $booking->delete();

        if($booking){
            return redirect()->route('bookings-all')->with([
                "delete" => "Booking delete successfully!"
            ]);
        }
    }

    // All foods
    public function allFoods(){
        $foods = Food::select()->orderBy('id', 'DESC')->get();

        return view('admins.all_foods', compact('foods'));
    }

    // Delete foods
    public function deleteFoods($id){
        $food = Food::find($id);

        if(File::exists(public_path('assets/img/' . $food->image))){
            File::delete(public_path('assets/img/' . $food->image));
        }else{
            //dd('File does not exists.');
        }

        $food->delete();

        return redirect()->route('foods-all')->with([
            "delete" => "Food deleted successfully!"
        ]);
    }

    // Create foods
    public function createFoodsFrm(){
        return view('admins.create_foods_frm');
    }

    public function storeFoods(Request $request){
        Request()->validate([
            'name' => "required",
            "price" => "required",
            "category" => "required",
            "description" => "required",
            "image" => "required"
        ]);

        $destinationPath = 'assets/img/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $food = Food::create([
            "name" => $request->name,
            "price" => $request->price,
            "category" => $request->category,
            "description" => $request->description,
            "image" => $myimage,
        ]);

        if($food){
            return redirect()->route('foods-all')->with([
                "success" => "Food item created successfully!"
            ]);
        }
    }
}
