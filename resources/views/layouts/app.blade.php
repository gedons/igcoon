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
    <script src="{{ asset('js/front_script.js') }}"></script>
    
    {{-- sweet alert --}}
    <script src="{{ asset('js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2/sweetalert2.all.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- sweetalert -->
  <link rel="stylesheet" href="{{ asset('css/sweetalert2/sweetalert2.min.css') }}">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="pl-3"><img style="width: 65px;" src="{{url('images/2.png')}}"></div>
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
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                                @if (Auth::user()->profiles->image)
                                <div class="image pt-1"> 
                                <a href="{{ route('profile.show', Auth::id()) }}">
                                    <img src="/storage/{{Auth::user()->profiles->image}}" width="30px" alt="img" class="rounded-circle" />
                                </a>
                                </div>
                                @else
                                <a href="{{ route('profile.show', Auth::id()) }}">
                                <div class="image pt-1">
                                    <img src="{{ asset('images/img.png')}}" alt="img" width="30px" class="rounded-circle"/>
                                </div>
                                </a>
                                @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>
                                   {{--  <span>{{count(Auth::user()->unreadNotifications) }}</span> --}}
                               
                                
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @forelse(Auth::user()->unreadNotifications as $notification)
                                    <a href="#" class="dropdown-item">
                                       Post <b>{{$notification->data['caption']}}</b> Created Successfully 
                                    <p class="text-xs text-secondary mb-0">
                                        {{$notification->created_at->diffForHumans()}}
                                    </p>
                                    </a>
                                    @empty
                                     <p class="dropdown-item">No Notifications Found</p>
                                @endforelse
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
            @yield('content')
        </main>
    </div>
</body>
</html>
