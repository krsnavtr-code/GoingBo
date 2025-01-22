<!DOCTYPE html>
<html lang="en">

<head>
    <!-- browser support meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Developer Attribute -->
    <meta author="Parth Pathak" />
    <meta designer="Parth Pathak" />
    <meta developer="Parth Pathak" />
    <!-- Manifest -->
    @if (is_file(public_path('manifest.json')))
        <link rel="manifest" href="{{ url('manifest.json') }}" />
    @endif
    <!-- html page Theme Color -->
    <title>{{ isset($admin['emp_username']) ? ucfirst($admin['emp_username']) : '' }} Account</title>
    <meta name="theme-color" content="#002346" />
    <!-- html page icons -->
    <link rel="icon" href="{{ url('images/web assets/logo.png') }}" type="image/png" />
    <link rel="apple-touch-icon" href="{{ url('images/web assets/logo.png') }}" />
    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="{{ url('css/style.php') }}">
    <link rel="stylesheet" href="{{ url('icon/css/all.min.css') }}">
    <!-- Other Stylesheets -->
    <link rel="stylesheet" href="{{ url('css/admin_css/style.php') }}">
    @stack('css')
</head>

<body>
    <div class="sidebar_layout">
        @include('admin.components.sidebar')
        <div class="main_content">
            @include('admin.components.header')
            @yield('main')
            @include('admin.components.footer')
        </div>
        @include('components.popups')
        @stack('others')
    </div>
    <!-- Main Scripts -->
    <script src="{{ url('js/master.js') }}"></script>
    <script src="{{ url('js/form_utils.js') }}"></script>
    <!-- Other Scripts -->
    @stack('js')
</body>

</html>
