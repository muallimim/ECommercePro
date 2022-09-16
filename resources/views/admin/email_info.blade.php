<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include("admin.css")

    <style>
        label{
            display: inline-block;
            width: 300px;
        }
        input[type='text']{
            color: black;
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

                <form method="POST" action="{{ url('send_user_email', $order->id) }}">
                    @csrf
                    <h1 style="text-align: center; font-size:25px;"> Send Email to {{ $order->email }}</h1>
                    <div style="padding-left: 25%; padding-top: 15px;">
                        <label style="font-size: 24px;">Email Greeting: </label>
                        <input type="text" name="greeting">
                    </div>
                    <div style="padding-left: 25%; padding-top: 15px;">
                        <label style="font-size: 24px;">Email FirstLine: </label>
                        <input type="text" name="first_line">
                    </div>
                    <div style="padding-left: 25%; padding-top: 15px;">
                        <label style="font-size: 24px;">Email Body: </label>
                        <input type="text" name="email_body">
                    </div>
                    <div style="padding-left: 25%; padding-top: 15px;">
                        <label style="font-size: 24px;">Email Button Name: </label>
                        <input type="text" name="button">
                    </div>
                    <div style="padding-left: 25%; padding-top: 15px;">
                        <label style="font-size: 24px;">Email URL: </label>
                        <input type="text" name="url">
                    </div>
                    <div style="padding-left: 25%; padding-top: 15px;">
                        <label style="font-size: 24px;">Email Last Line: </label>
                        <input type="text" name="lastline">
                    </div>
                    <div style="padding-left: 25%; padding-top: 15px;">
                        <input type="submit" value="Send Email" class="btn btn-primary">
                    </div>
                </form>
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