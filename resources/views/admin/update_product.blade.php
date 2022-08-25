<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include("admin.css")
    <style>
        .div_center{
            text-align: center;
            padding-top: 40px;
        }
        .h1_font{
            font-size: 40px;
            padding-bottom: 40px;
        }
        .text_color{
            color: black;
            padding-bottom: 20px;
        }
        label{
            display: inline-block;
            width: 200px;
            text-align: left;
        }


        .div_design{
            padding-bottom: 15px;
        }
    </style>
</head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include("admin.sidebar")
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include("admin.header")
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                    {{ session()->get('message') }}
                    <button type=button class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    </div>
                @endif
                <div class="div_center">
                    <h1 class="h1_font">Update Product</h1>

                    <form action="{{ url("/update_product_confirm", $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="div_design">
                            <label>Product Title:</label>
                            <input class="text_color" type="text" name="title" placeholder="Write a Title" value="{{ $product->title }}" required>
                        </div>
                        <div class="div_design">
                            <label>Product Description:</label>
                            <input class="text_color" type="text" name="description" placeholder="Write a Description" value="{{ $product->description }}" required>
                        </div>
                        <div class="div_design">
                            <label>Product Price:</label>
                            <input class="text_color" type="number" name="price" placeholder="Write a Price" value="{{ $product->price }}" required>
                        </div>
                        <div class="div_design">
                            <label>Discount Price:</label>
                            <input class="text_color" type="number" name="discount_price" placeholder="Write a Discount Price" value="{{ $product->discount_price }}" required>
                        </div>
                        <div class="div_design">
                            <label>Product Quantity:</label>
                            <input class="text_color" type="number" name="quantity" min="0" placeholder="Write a Quantity" value="{{ $product->quantity }}" required>
                        </div>

                        <div class="div_design">
                            <label>Product Category:</label>
                            <select class="text_color" name="category" required>
                                <option  value="{{ $product->category }}" selected> {{ $product->category }}</option>
                                @foreach($category as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="div_design">
                            <label>Current Product Image:</label>
                            <img src="/product/{{ $product->image }}" heigth=100 style="margin: auto;">
                            <label>Change Product Image:</label>
                            <input type="file" name="image">


                        </div>
                        <div class="div_design">
                            <input type="submit" value="Update Product" class="btn btn-primary">
                        </div>                        

                    </form>

                </div>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include("admin.script")
</body>
</html>