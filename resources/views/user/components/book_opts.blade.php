<style>
    .book_opts {
        background: var(--fv_sec);
        margin: 20px 20px 0;
        padding: 20px 40px;
        gap: 40px;
        border-radius: 10px;
    }

    .book_opts a {
        display: inline-block;
        color: white;
        font-weight: 600;
    }

    .book_opts a:hover {
        color: var(--fv_prime);
    }

    .book_opts i {
        margin-bottom: 10px;
        font-size: 3rem;
    }
</style>
<div class="book_opts rflex">
    <a class="form_type active" href="{{ url('') }}">
        <i class="icon fa-solid fa-plane-engines"></i>
        <p>Flight</p>
    </a>
    <a class="form_type" href="{{ url('') }}">
        <i class="icon fa-solid fa-hotel"></i>
        <p>Hotel</p>
    </a>
</div>
