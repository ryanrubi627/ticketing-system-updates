<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-2.2.4.js"
            integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
            crossorigin="anonymous">            
    </script>


</head>
<body>
<div id="app">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
        </nav><br>
</div>



<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Comment Section</h5>
                <div class="card-body">
                    <p class="card-text">
                        <div class="form-group">
                            <h4>Ticket</h4>
                            <table>
                                <tr><td>Name:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ $ticket->name }}</td></tr>
                                <tr><td>Title:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ $ticket->title }}</td></tr>
                                <tr><td>Description:&nbsp&nbsp&nbsp&nbsp{{ $ticket->description }}</td></tr>
                                <tr><td>Importance:&nbsp&nbsp&nbsp&nbsp{{ $ticket->importance }}</td></tr>
                                <tr><td>Date:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ $ticket->date }}</td></tr>
                            </table>
                            <hr>
                                @foreach ($ticket->comments as $comment)
                                    <p>{{ $comment->name }}{!! $comment->comments !!}</p>
                                @endforeach
                            <br>
                            <label for="comment">Comment:</label>
                            <textarea class="form-control" rows="3" id="comment12" name='comment12'></textarea><br>
                            <input type="submit" class="btn btn-success" value="Send" id="send-mssg42343" style="float:right;">
                            <input type="hidden" class="form-control" name="name17" id="name17" value="{{ Auth::user()->name }} : ">
                            <input type="hidden" class="form-control" name="tickets_id" id="tickets_id" value="{{ $ticket->id }}">
                        </div>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>


</body>
</html>


    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>CKEDITOR.replace('comment12');</script>
<script>
$(document).ready(function(){
  $("#send-mssg42343").click(function(){
    CKEDITOR.instances['comment12'].updateElement();

    var tickets_id = $("#tickets_id").val();
    var name = $("#name17").val();
    var comment = $("#comment12").val();


    //alert(tickets_id+" "+name+" "+comment);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
           type:'post',
           url:'/comment_page/insert',
           data:{
              tickets_id:tickets_id,
              name:name, 
              comment:comment
            },
           success:function(data){
             location.reload(true);
           }
    });
  });
});
</script>