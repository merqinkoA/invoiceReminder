<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Reminder</title>
    @include('layouts.stylesheet')

</head>

<body>
    <div id="app">
        @include('layouts.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="assets/images/faces/4.jpg" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                <h6 class="text-muted mb-0">{{ Auth::user()->email }}</h6>
                            </div>
                        </div>
                        <div class="logout">
                            <h3 class="font-bold">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf


                                           <a href="route('logout')"
                                           onclick="event.preventDefault();
                                                       this.closest('form').submit();" class='sidebar-link'>
                                            <i class="bi bi-box-arrow-right"></i>
                                            <span >Log Out,  {{ Auth::user()->name }}</span>
                                        </a>

                                </form></h3>

                        </div>
                    </div>
                </div>
            </div>

                    @yield('content')







</div>

        </div>

        </div>
        </div>
        @include('layouts.footer')
        @include('layouts.edit_modal')
        @include('layouts.javascripts')

        {{-- <script  type="text/javascript">


            @if(Session::has('success'))
                    toastr.success("{{ Session::get('success') }}");
            @endif


            @if(Session::has('info'))
                    toastr.info("{{ Session::get('info') }}");
            @endif


            @if(Session::has('warning'))
                    toastr.warning("{{ Session::get('warning') }}");
            @endif


            @if(Session::has('error'))
                    toastr.error("{{ Session::get('error') }}");
            @endif


          </script> --}}
</body>

</html>
