<!DOCTYPE html>
<html lang="en">
  <head>
    @include("admin.css")
    <style>
        .center{
            margin: auto;
            border: 2px solid white;
            text-align: center;
            margin-top: 40px;
        }

        .font_size{
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }
        .img_size{
            height: 150px;
        }
        .th_color{
            background-color: skyblue;
        }

        tr>th{
            padding: 20px;
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
              
                <h2 class="font_size">All Products</h2>

                <table class="center">
                    <tr class="th_color">
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>Product Image</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>

                    @foreach($product as $product)

                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount_price }}</td>


                        <td>
                            <img class="img_size" src="/product/{{ $product->image }}" alt="">
                        </td>
                        <td>
                            <a class="btn btn-danger" 
                            onclick="return confirm('Are you sure to delete this?')"
                            href="{{ url('delete_product', $product->id) }}">Delete</a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{ url('update_product', $product->id) }}">Edit</a>
                        </td>
                    </tr>

                    @endforeach

                </table>
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