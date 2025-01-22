@push('css')
    <style>
        .response {
            border: 2px solid rgba(var(--clr));
            background: rgba(var(--clr), 0.5);
            padding: 4px 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: 400;
        }

        .response i {
            margin-right: 10px;
        }

        .response.success {
            --clr: var(--success_rgb);
        }

        .response.error {
            --clr: var(--error_rgb);
        }
    </style>
@endpush
@if (Session::has('result'))
    @if (Session::get('result')['success'])
        <div class="response success">
            <p class="rflex aic">
                <i class="fa-solid fa-check icon"></i>
                {{ Session::get('result')['msg'] ?? 'Action Success' }}
            </p>
        </div>
    @else
        <div class="response error">
            <p class="rflex aic">
                <i class="fa-solid fa-bug icon"></i>
                {{ Session::get('result')['msg'] ?? 'There is some Error' }}
            </p>
        </div>
    @endif
@endif
