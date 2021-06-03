@php
    $theme = \App\Models\DashboardSetting::find(1);
@endphp
<!DOCTYPE html>
<html lang="en">
<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Alamin Blog</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset("assets/css/app.min.css") }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/css/components.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/bundles/summernote/summernote-bs4.css") }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset("assets/css/custom.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/bundles/bootstrap-social/bootstrap-social.css") }}">
  <link rel='shortcut icon' type='image/x-icon' href='{{ asset("assets/img/favicon.ico") }}' />
</head>

<body class="{{ $theme->layout_mode }} {{ $theme->sidebar_color }} {{ $theme->color_theme }}">
  <div id="admin">
    <vue-progress-bar></vue-progress-bar>
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <admin-header sticky="{{ $theme->sticky_header }}" v-bind:csrfdata="'{{ csrf_token() }}'"></admin-header>

      <admin-sidenav></admin-sidenav>

      <!-- Main Content -->
      <div class="main-content">
          @yield('content')
      </div>
      <app-settingbar :theme="{{ json_encode($theme) }}"></app-settingbar>
      <admin-footer></admin-footer>

    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset("assets/js/app.min.js") }}"></script>
  <script src="{{ asset("assets/bundles/summernote/summernote-bs4.js") }}"></script>
  <script src="{{ asset("assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js") }}"></script>
  <script src="{{ asset("js/app.js") }}"></script>
  <!-- JS Libraies -->
  <!-- Template JS File -->
  <script src="{{ asset("assets/js/scripts.js") }}"></script>
  
  
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>