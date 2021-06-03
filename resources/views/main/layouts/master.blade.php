@php
    $profile = \App\Models\MyProfile::find(1);
@endphp
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Home</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Pacifico&display=swap" rel="stylesheet">

    <!--
        CSS
        ============================================= -->
    <link rel="stylesheet" href="{{ asset("css/linearicons.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("css/magnific-popup.css") }}">
    <link rel="stylesheet" href="{{ asset("css/nice-select.css") }}">
    <link rel="stylesheet" href="{{ asset("css/animate.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/owl.carousel.css") }}">
    <link rel="stylesheet" href="{{ asset("css/main.css") }}">
</head>

<body>

    <div id="app">
        <vue-progress-bar></vue-progress-bar>
        <app-header name="{{ $profile->first_name." ".$profile->last_name }}"></app-header>    
            {{-- Main Content --}}
                @yield('content')
            {{-- Main Content --}}
        <app-footer :profile="{{ json_encode($profile) }}"></app-footer>
    </div>





    <script src="{{ asset("js/vendor/jquery-2.2.4.min.js") }}"></script>
    <script src="{{ asset("js/popper.min.js") }}"></script>
    <script src="{{ asset("js/vendor/bootstrap.min.js") }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="{{ asset("js/easing.min.js") }}"></script>
    <script src="{{ asset("js/hoverIntent.js") }}"></script>
    {{-- <script src="{{ asset("js/superfish.min.js") }}"></script> --}}
    <script src="{{ asset("js/jquery.ajaxchimp.min.js") }}"></script>
    <script src="{{ asset("js/jquery.magnific-popup.min.js") }}"></script>
    <script src="{{ asset("js/jquery.tabs.min.js") }}"></script>
    <script src="{{ asset("js/jquery.nice-select.min.js") }}"></script>
    <script src="{{ asset("js/isotope.pkgd.min.js") }}"></script>
    <script src="{{ asset("js/waypoints.min.js") }}"></script>
    <script src="{{ asset("js/jquery.counterup.min.js") }}"></script>
    <script src="{{ asset("js/simple-skillbar.js") }}"></script>
    <script src="{{ asset("js/owl.carousel.min.js") }}"></script>
    <script src="{{ asset("js/mail-script.js") }}"></script>
    <script src="{{ asset("js/main.js") }}"></script>
    <script src="{{ asset("js/app.js") }}"></script>
</body>

</html>