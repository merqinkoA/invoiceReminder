<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Reminder</title>
    @include('layouts.stylesheet')
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/stm_logo_new.png" type="image/png">
    <style type="text/css">
        /* body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        } */
    .loader {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .sidebar-wrapper    {
  width: 300px; /* Adjust the width as needed */
}
    .loader-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-image: url("assets/images/logo/stm_logo.png");
      background-size: cover;
      animation: bounce 1s infinite alternate;
    }

    @keyframes bounce {
      0% {
        transform: translateY(0);
      }
      100% {
        transform: translateY(-20px);
      }
    }
    /* Basic styling for the tag input container */
.tag-input {
    border: 1px solid #ccc;
    padding: 5px;
    display: inline-block;
}

/* Styling for tags */
.tag {
    background-color: #007BFF;
    color: white;
    padding: 5px 10px;
    margin-right: 5px;
    border-radius: 5px;
    display: inline-block;
    cursor: pointer;
}

        </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.sidebar')
    <div class="loader">
        <div class="logo">
            <a href="index.html">
                <div class="loader-icon"></div>
            </a>
        </div>

    </div>

    <!-- Loading bar structure -->

    </div>
        <div id="main">

            <div class="loader">
                <div class="logo">
                    <a href="index.html">
                        <img src="{{ asset('assets') }}/images/logo/stm_logo_new.png" alt="Logo" srcset="">
                    </a>
                </div>
                <div class="loader-icon"></div>
            </div>

            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            {{-- <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset('assets') }}/images/faces/4.jpg" alt="Face 1">
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
            </div> --}}

              <!-- Content Wrapper. Contains page content -->
  <div class="main-content">
    <div class="content-wrapper">

      <!-- Main content -->
      @yield('content')
      <!-- /.content -->
    </div>
  </div>







</div>

        </div>

        </div>
        </div>


        @include('layouts.footer')
        @include('layouts.edit_modal')
        @include('layouts.javascripts')
        @stack('custom-scripts')
</body>

</html>
