<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoingBo Business Admin Portal</title>
    <link rel="stylesheet" href="{{ asset('css/admin_css/business_css/style.css') }}"> <!-- Link to your custom CSS -->
    @stack('css')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.business.layouts.sidebar')

        <div class="main-content">
            <!-- Header -->
            @include('admin.business.layouts.header')

            <!-- Main Content -->
            <div class="content">
                @yield('content')
            </div>
        </div>

        <!-- Footer -->
        @include('admin.business.layouts.footer')
    </div>
    @stack('js')
</body>
</html>
