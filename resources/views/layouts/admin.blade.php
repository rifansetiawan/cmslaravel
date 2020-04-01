<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


  <title>Simple Sidebar - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('bootstrap/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


  <!-- Custom styles for this template -->
  <link href="{{ asset('bootstrap/css/simple-sidebar.css') }}" rel="stylesheet">
  <link href="{{asset('css/gambar.css')}}" rel="stylesheet">

  @yield('stylecss')
  {{-- dari edwin --}}
  {{-- <link href="{{asset('css/app.css')}}" rel="stylesheet"> --}}
  <script src="{{asset('js/libs.js')}}"></script>
  {{-- <link href="{{asset('css/libs.css')}}" rel="stylesheet"> --}}
    {{-- dari edwin --}}


</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Start Bootstrap </div>
      <div class="list-group list-group-flush">
        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action bg-light">All Users</a>
        <a href="{{ route('admin.users.create') }}" class="list-group-item list-group-item-action bg-light">Create User</a>
        <a href="{{ route('admin.posts.index')  }}" class="list-group-item list-group-item-action bg-light">All Posts</a>
        <a href="{{ route('admin.posts.create')  }}" class="list-group-item list-group-item-action bg-light">Create Posts</a>
        <a href="{{ route('admin.comments.index') }}" class="list-group-item list-group-item-action bg-light">All Comments</a>
        {{-- <a href="{{ route('admin.comments.replies.index') }}" class="list-group-item list-group-item-action bg-light">All Replies</a> --}}
        <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action bg-light">Categories</a>
        <a href="{{ route('admin.media.index') }}" class="list-group-item list-group-item-action bg-light">Media</a>
        <a href="{{ route('admin.media.create') }}" class="list-group-item list-group-item-action bg-light">Upload Media</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
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
                                    <i class='fas fa-user' style='font-size:21px'>  </i>
                                    &nbsp;
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
            </div>
        </nav>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">@yield('judul-card')</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div>
                                    @yield('konten-admin')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>


    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('bootstrap/vendor/jquery/jquery.min.js') }}"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="{{ asset('bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  @yield('javascript')
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>

