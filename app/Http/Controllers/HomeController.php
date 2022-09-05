<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User;
use App\Models\Product;
use App\Models\Cart;



class HomeController extends Controller
{
    public function redirect(){
        $usertype =Auth::user()->usertype;
        if($usertype == "1"){
            return view('admin.home');
        }
        else{
            $product = Product::paginate(3);
            return view('home.userpage', compact('product'));            
            
        }
    }

    public function index(){
        $product = Product::paginate(3);
        return view('home.userpage', compact('product'));
    }

    public function product_details($id){
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id){
        if(Auth::id()){
            $user = Auth::user();
            $product = Product::find($id);

            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->product_title = $product->title;

            if($product->discount_price)
                $cart->price = $product->discount_price * $request->quantity;
            else
                $cart->price = $product->price * $request->quantity;

            $cart->quantity = $request->quantity;
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->user_id = $user->id;

            $cart->save();

            return redirect()->back();
            

        }
        else{
            return redirect('login');
        }
    }


    public function show_cart(){

        if(Auth::id()){
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            return view('home.showcart', compact('cart'));
    
        }
        else{
            return redirect('login');
        }
    }

    public function remove_cart($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }


}
