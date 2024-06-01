<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My App</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">

    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 23%;
            overflow-y: auto;
            /* border-right: 1px solid #ccc; */
        }
        .main-content-left {
            margin-left: 25%;
            width: 37.5%;
        }
        .main-content-right {
            position: fixed;
            top: 0;
            bottom: 0;
            right: 0;
            width: 37.5%;
            overflow-y: auto;
        }
        .sticky-container {
            position: sticky;
            top: 100px;
        }
        .vcenter {
            display: inline-block;
            vertical-align: middle;
            float: none;
        }
    </style>
</head>

<body class="bg-dark text-white">
    <div class="container-fluid">
    <div class="row">
       <div class="col-3 full-height border-end" style="overflow-y: scroll; height:100vh;">
            <!-- Left Sidebar -->
            @include('partials.sidebar')
        </div>
        <div class="col-9 full-height">
            <div class="row sticky-top bg-dark">
                @yield('navbar')
            </div>
            <div class="row justify-content-center">
                @yield('content')
            </div>
        </div>
    </div>
    </div>
    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<script src="{{ asset('js/follow-unfollow.js') }}"></script>
</html>
