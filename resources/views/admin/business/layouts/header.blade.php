@if (isset($businessLogin))
<header class="header">
    <h2>Hello, {{ $businessLogin->company_name }}</h2>
</header>
@endif
