@php
    $cont = App\Http\Controllers\adminControllers\AdminpageController::class;
    $groups = $cont::get_display_pages_in_group();
    $web_helper=Request::get('web_helper')??['page_group'=>null,"current_slug"=>""];
@endphp
<div class="sidebar">
    <a href="{{ url('') }}" class="brand">
        <img src="{{ url('/images/logo.png') }}" alt="">
    </a>
    <ul class="main_nav">
        <li class="group_head">
            <a href="{{ url('/admin') }}" class="group_title">Dashboard</a>
        </li>
        @foreach ($groups as $group)
            <li @class(["group_head",'active'=>$group['id']==$web_helper['page_group']])>
                <a class="group_title rflex jcsb aic">
                    {{ $group['pagegroup_title'] }}
                    <i class="fa-regular fa-angle-down"></i>
                </a>
                <ul>
                    @foreach ($group['adminpages'] as $page)
                        <li @class([
                            'active' => $page['admin_page_url'] == $web_helper['current_slug'],
                        ])>
                            <a href="{{ url('/admin/' . $page['admin_page_url']) }}">
                                {{ $page['admin_page_title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    <ul style="margin-top:auto;">
        <li class="logout"><a href="/admin/logout">Logout</a></li>
    </ul>
</div>
@push('js')
    <script>
        $(".group_head:has(ul)").perform((n, i, no) => {
            let inner = n.$('ul')[0];
            n.set("data-height", inner.offsetHeight + "px");
            n.$(".group_title")[0].addEventListener("click", () => {
                no.perform((x) => {
                    if (n != x) {
                        x.removeClass("active")
                        x.$('ul')[0].addCSS("height", "0px");
                    }
                })
                inner.addCSS("height", n.hasClass("active") ? "0px" : n.get("data-height"));
                n.toggleClass("active");
            })
            if (!n.hasClass("active")) {
                inner.addCSS("height", "0px");
            }
        })
    </script>
@endpush
