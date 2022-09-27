<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      {{-- <base href="/public"> --}}

      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
      <!-- font awesome style -->
      <link href="{{ asset('home/css/font-awesome.min.css" rel="stylesheet') }}" />
      <!-- Custom styles for this template -->
      <link href="{{ asset('home/css/style.css" rel="stylesheet') }}" />
      <!-- responsive style -->
      <link href="{{ asset('home/css/responsive.css" rel="stylesheet') }}" />

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
        
         

      

      <!-- product section -->
      @include("home.product_view")
      <!-- end product section -->

      <!-- Comment and reply system starts here-->

      <div style="text-align: center; padding-bottom: 40px;">
         <h1 style="font-size: 30px; text-align: center; padding-top: 20px; padding-bottom: 20px;">Comments</h1>

         <form action="{{ url('add_comment') }}" method="POST">
            @csrf
            <textarea name="comment" style="height: 150px; width: 600px;" placeholder="Comment something here" cols="20" rows="10"></textarea>
            <br>
            <input type="submit" value="Comment" class="btn btn-primary">
         </form>
      </div>

      <div style="padding-left: 20px;">
         <h1 style="font-size: 20px; padding-bottom: 20px;">All Comments</h1>

         @foreach($comment as $comment)

            <div>
               <b>{{ $comment->name }}</b>
               <p>{{ $comment->comment }}</p>
               <a href="javascript::void(0);" onclick="reply(this);" class="btn btn-primary" data-Commentid="{{ $comment->id }}">
                  Reply
               </a>
            <div>

            <!-- inner loop starts -->
            @foreach($replies as $reply)
               @if($reply->comment_id==$comment->id)
                  <div style="padding-left: 30px; padding-bottom: 10px; padding-top: 10px;">
                     <b>{{ $reply->name }}</b>
                     <p>{{ $reply->reply }}</p>
                     <a  style="color: blue;" href="javascript::void(0);" onclick="reply(this);" class="btn btn-primary" data-Commentid="{{ $comment->id }}">
                        Reply
                     </a>
                  </div>
               @endif
            @endforeach
            <!-- inner loop ends -->            

         @endforeach

         <div style="display: none;" class="replyDiv">
            <form action="{{ url('add_reply') }}" method="POST">
               @csrf
               <input type="text" id="commentId" name="commentId" hidden>
               <textarea style="height: 100px; width: 500px; " placeholder="Write something here" name="reply"></textarea>
               <br>
               <input type="submit" value="Reply" class="btn btn-primary">
               <button type="submit" class="btn btn-warning">Reply</button>
               <a href="javascript::void(0);" onclick="reply_close(this);" class="btn btn-outline-danger">Close</a>
            </form>
         </div>
      </div>






      <!-- Comment and reply system ends  here-->

      
      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>

      <script>
         function reply(caller){
            document.getElementById('commentId').value = $(caller).attr('data-Commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
         }

         function reply_close(caller){
            
            $('.replyDiv').hide();
         }
      </script>

      <script>
         document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
         });

         window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
         };
      </script>      

   </body>
</html>
