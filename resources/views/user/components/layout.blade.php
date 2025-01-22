@inject('META', App\Models\Webpage::class)
@php
    $slug = substr(request()->getPathInfo(), 1);
    if (strlen($slug) > 0 && $slug[-1] == '/') {
        $slug = substr($slug, 0, -1);
    }
    $universal = $META::where('slug', '*')->first();
    $data = $META::where('slug', $slug)->first();
    // dd($data);
@endphp

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
    <meta designer="Mohd. Akbar , Parth Pathak" />
    <meta developer="Parth Pathak" />
    @if (is_file(public_path('manifest.json')))
        <!-- Manifest -->
        <link rel="manifest" href="{{ url('manifest.json') }}" />
    @endif

    <!-- search engine support meta tags Starts Here -->

    <!-- Title Tag for website -->
    <title>{{ $data['page_title'] ?? '' ?: $universal['page_title'] ?? '' ?: 'Traveller Detail' }}</title>

    <!-- Meta Keywords -->
    <meta name="keywords"
        content="{{ $data['page_keywords'] ?? '' ?: $universal['page_keywords'] ?? '' ?: 'Page Keywords' }}" />

    <!-- Meta Description -->
    <meta name="description"
        content="{{ $data['page_desc'] ?? '' ?: $universal['page_desc'] ?? '' ?: 'Page Description' }}" />

    <!-- Other Meta tags that are usesd on all pages -->
    {!! ($universal['other_meta_tags'] ?? '') . ($data['other_meta_tags'] ?? '') !!}

    @if ($data['canonical_url'] ?? '')
        <!-- Canonical Tag -->
        <link rel="canonical" href="{{ $data['canonical_url'] }}" />
    @endif

    <!-- If page has specific Meta Tags -->
    @stack('meta')

    <!-- search engine support meta tags Ends Here-->

    <!-- html page Theme Color -->
    <meta name="theme-color" content="#002346" />
    <!-- html page icons -->
    <link rel="icon" href="{{ url('images/web assets/logo.png') }}" type="image/png" />
    <link rel="apple-touch-icon" href="{{ url('images/web assets/logo.png') }}" />
    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="{{ url('icon/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.php') }}">
    <!-- Other Stylesheets -->
    @stack('css')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>




</head>

<body>
    <x-loader msg="Getting Everything Ready...."></x-loader>
    @include('user.components.header')
    @yield('main')
    @include('user.components.footer')
    @include('components.popups')
    @stack('others')
    <!-- Main Scripts -->
    <script src="{{ url('js/master.js') }}"></script>
    
    <script>
        class Popup {
            constructor(node, can_dom_hide) {
                this.node = node;
                this.parent = node.parentElement;
                this.popup = node.closest(".popup");
                this.close_btns = this.popup.$(".close_popup");
                this.can_dom_hide = can_dom_hide;
                this.close_btns.perform((x) => {
                    x.addEventListener("click", () => this.hide_popup());
                });
            }
            show_popup() {
                this.hide_siblings();
                this.node.addClass("active");
                this.popup.addClass("active");
                this.dom_hide = (e) => this.dom_hide_popup(e);
                if (this.can_dom_hide)
                    setTimeout(() => {
                        document.addEventListener("click", this.dom_hide);
                    }, 1);
            }
            hide_popup() {
                this.hide_siblings();
                this.popup.removeClass("active");
            }
            hide_siblings() {
                this.parent.children.perform((x) => x.removeClass("active"));
            }
            dom_hide_popup(event) {
                if (!this.popup.contains(event.target)) {
                    this.hide_popup();
                    if (this.can_dom_hide)
                        document.removeEventListener("click", this.dom_hide);
                }
            }
        }
    </script>
    <!-- Other Scripts -->
    @stack('js')
</body>

</html>
