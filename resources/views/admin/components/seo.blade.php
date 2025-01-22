<section>
    <h4 class="section_title">SEO Work</h4>
    <div class="field_group">
        <div class="field">
            <label for="page_slug">Page Slug</label>
            @isset($page['slug'])
                <input type="text" readonly id="page_slug"required
                    value="@php if($page['slug']=='') echo "Home Page";
                    else if($page['slug']=="*") echo "Universal";
                    else echo $page['slug']; @endphp">
            @else
                <input type="text" name="page_slug" id="page_slug" required>
            @endisset
        </div>
        <div class="field">
            <label for="page_title" class="rflex jcsb">Page Title
                <i class="text success"><span>0</span>char</i>
            </label>
            <input type="text" name="page_title" id="page_title" required value="{{ $page['page_title'] ?? '' }}">
        </div>
    </div>
    <div class="field_group">
        <div class="field">
            <label for="page_desc" class="jcsb rflex">Page Description
                <i class="text info"><span></span></i></label>
            <input type="text" name="page_desc" id="page_desc" value="{{ $page['page_desc'] ?? '' }}">
        </div>
        <div class="field">
            <label for="page_keywords" class="jcsb rflex">
                <span>Page Keywords <i class="text info">(','seprated)</i></span>
                <i class="text prime"><span class="count_info"></span> Keywords</i>
            </label>
            <input type="text" name="page_keywords" id="page_keywords" value="{{ $page['page_keywords'] ?? '' }}">
        </div>
    </div>
    <div class="field">
        <label for="other_meta">Other Meta Tags
            <i class="text warn">Don't fill unnecessary</i>
        </label>
        <textarea name="other_meta" id="other_meta">{{ $page['other_meta_tags'] ?? '' }}</textarea>
    </div>
</section>
@push('js')
    <script>
        $("#page_title").addEventListener("input", function() {
            let char = this.value.length;
            let span = $("label[for='page_title'] span")[0];
            span.innerText = char;
            span.parentElement.removeClass(["warn", "error"]);
            if (char > 60) span.parentElement.addClass("error");
            else if (char > 40) span.parentElement.addClass("warn")
        })
        $("#page_keywords").addEventListener("input", function() {
            let words = this.value.split(",").filter((x) => x).length;
            let span = $("label[for='page_keywords'] .count_info")[0];
            span.innerText = words;
        })
        $("#page_desc").addEventListener("input", function() {
            let char = this.value.length;
            let words = this.value.split(" ").filter((x) => x).length;
            let span = $("label[for='page_desc'] span")[0];
            span.innerText = `${char} Char, ${words} Word`;
        })
    </script>
@endpush
