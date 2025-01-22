<!DOCTYPE html>
<html lang="en">

<head>
    <!-- browser support meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Developer Attribute -->
    <meta author="Ajay Kumar" />
    <meta designer="Ajay Kumar" />
    <meta developer="Ajay Kumar" />
    <!-- Manifest -->
    @if (is_file(public_path('manifest.json')))
        <link rel="manifest" href="{{ url('manifest.json') }}" />
    @endif
    <!-- html page Theme Color -->
    <meta name="theme-color" content="#002346" />
    <!-- html page icons -->
    <link rel="icon" href="{{ url('images/web assets/logo_mini.jpeg') }}" type="image/png" />
    <link rel="apple-touch-icon" href="{{ url('images/web assets/logo_mini.jpeg') }}" />
    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="{{ url('css/style.php') }}">
    <link rel="stylesheet" href="{{ url('icon/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/admin/login.css') }}">
    <link rel="stylesheet" href="{{ url('/css/theme.css') }}">
</head>

<body>
    <main class="rflex flex-center">
        <form action="{{ Request::url() }}" method="post" class="cflex">
            @csrf
            <img src="{{ url('/images/logo.png') }}" alt="" class="brand_logo">
            <h1 id="admin_verification">Admin Verification</h1>
            <div class="field">
                <input type="text" placeholder="User - Name" name="username" required>
                @error('username')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="field">
                <input type="password" placeholder="Pass - Code" name="passcode">
                @error('passcode')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            @if (Session::has('error'))
                <p class="error">{{ Session::get('error') }}</p>
            @endif
            <button type="submit" id="btn">Validate</button>
        </form>
    </main>
    <script src="{{ url('js/master.js') }}"></script>
    <script>
        const av = $("#admin_verification");
        let content = av.innerText;
        av.innerText = '';
        for (let i = 0; i < content.length; i++) {
            av.append(`<span style="--i:${i}">${content[i]}</span>`);
        }
        $("#btn").ripple();
    </script>
</body>

</html>
