<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{

    public function view_category(){
        $data =  Category::all();
        return view("admin.category", compact("data"));
    }


    public function add_category(Request $request){
        $data = new Category;
        $data->category_name = $request->category;
        $data->save();

        return redirect()->back()->with('message', 'Category added successfully.');
    }

    public function delete_category($id){
        $data=Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category deleted successfully.');
    }

    public function view_product(){
        $category =  Category::all();
        return view("admin.product", compact("category"));
    }

    public function add_product(Request $request){
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;
        $image = $request->image;
        $imagename=time(). '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        //$product->image = $request->imagename;
        $product->image = $imagename;

        $product->save();

        return redirect()->back()->with('message', 'Product added successfully.');
    }

    public function show_product(){
        $product = Product::all();
        return view("admin.show_product", compact('product'));
    }

    public function delete_product($id){
        $product=Product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Product deleted successfully.');
    }

    public function update_product($id){
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.update_product', compact('product','category'));
    }

    public function update_product_confirm(Request $request, $id){
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        /////////////////////////
        $image = $request->image;
        if($image)
        {
            $imageName = time(). ".".$image->getClientOriginalExtension();
            $request->image->move('product', $imageName);
            $product->image = $imageName;
        }

        /////////////////////////////
        $product->save();
        return redirect()->back()->with('message', 'Product Updated Successfully.');
    }

    public function order(){
        $order = Order::all();
        return view('admin.order', compact('order'));
    }


    public function delivered($id){
        $order = Order::find($id);
        $order->delivery_status = "delivered";
        $order->payment_status = "paid";
        $order->save();
        return redirect()->back();
    }

    public function print_pdf($id){
        $order=Order::find($id);
        $pdf = PDF::loadView('admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function send_email($id){
        $order = Order::find($id);
        return view('admin.email_info', compact('order'));
    }

    public function send_user_email(Request $request, $id){
        $order = Order::find($id);
        $details=[
          'greeting'  => $request->greeting,
          'firstline'  => $request->firstline,
          'body'  => $request->body,
          'button'  => $request->button,
          'url'  => $request->url,
          'lastline'  => $request->lastline,
        ];

        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back();
    }

    public function searchdata(Request $request){
        $searchText = $request->search;
        
        $order = Order::where('name', 'LIKE', '%'.$searchText.'%')
                        ->orWhere('email', 'LIKE', '%'.$searchText.'%')
                        ->orWhere('product_title', 'LIKE', '%'.$searchText.'%')
                        ->get();
        return view('admin.order', compact('order'));
    }
}
