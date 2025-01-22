@extends('admin.components.layout')
<style>
    .item {
        padding: 20px 20px 10px;
        border-radius: 6px;
        background: white;
        box-shadow: 0 0 10px 0 #00000033;
        border-bottom: 6px solid #002456;
        z-index: 4;
    }

    .item .actions {
        margin-top: 5px;
        padding-top: 5px;
        border-top: 1px dashed;
        overflow: hidden;
    }

    .item .hExpand {
        transition: all 0.4s;
    }

    .item:not(:hover) .hExpand {
        height: 0 !important;
    }

    .item:not(:hover) {
        z-index: 0;
    }

    .details p.index {
        border-radius: 100px;
        padding: 1px 10px;
        background: var(--warn);
        font-size: 1rem;
        font-weight: 600;
        width: max-content;
        margin-bottom: 4px;
    }

    .details p.index span {
        font-weight: 700
    }

    .page_count {
        font-size: 1.2rem;
    }
</style>
@section('main')
    <main>
        <div>
            <div class="page_title">View All Groups</div>
            <div class="page_sub_title">Manage Page Groups</div>
        </div>
        <div class="items row" style="padding-inline: 0">
            @foreach ($groups as $i => $group)
                <div class="col-6 col-l-4">
                    <div class="item wrapper">
                        <div class="details">
                            <p class="index">Index <span>{{ $group['pagegroup_index'] }}</span></p>
                            <h6 class="group_title">{{ $group['pagegroup_title'] }}</h6>
                            <p class="page_count">{{ count($group['adminpages']) }} Pages in group</p>
                        </div>
                        <div class="actions hExpand">
                            <i class="fa-solid fa-eye icon"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
@push('js')
    <script>
        $(".hExpand").perform((n) => {
            n.removeClass("hExpand");
            n.addCSS("height", n.offsetHeight);
            n.addClass("hExpand");
        })
        $(".item").perform((n) => clone_to_position(n));
    </script>
@endpush
