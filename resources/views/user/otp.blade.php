@extends('user.components.layout')
@push('css')
    <style>
        form {
            padding: 50px 10px;
            width: min(100%, 400px);
        }

        form .form_title {
            color: var(--fv_sec);
        }

        form .form_subtitle {}

        form .field {
            border: 2px solid var(--gray_300);
            position: relative;
            border-radius: 6px;
            margin-top: 20px;
        }

        form .field input {
            border: none;
            background: transparent;
            width: 100%;
        }

        form .field :where(input, label) {
            font-size: 1.4rem;
            padding: 8px 20px;
        }

        form .field input~label {
            position: absolute;
            top: 0%;
            left: 0%;
            transition: all 0.3s;
        }

        form .field input:focus~label,
        form .field input:not(:placeholder-shown)~label {
            top: 0%;
            transform: translateY(-50%);
            left: 5%;
            font-size: 1rem;
            padding: 4px 10px;
            border-radius: 10px;
            font-weight: 600;
            background: white;
        }

        form .checkbox {
            margin-top: 10px;
            font-size: 1.2rem;
        }

        form button {
            background: var(--fv_sec);
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            padding: 8px 25px;
            margin-top: 10px;
            align-self: flex-end;
        }

        form button:hover {
            background: #00699d;
        }

        form .seprator {
            position: relative;
            border: 1px dashed var(--gray_300);
            margin-top: 20px;
        }

        form .seprator span {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            font-size: 1.2rem;
            padding: 0 10px;
        }
    </style>
@endpush
@section('main')
    <main class="cflex aic jcc">
        <form action="{{ Request::url() }}" method="post" class="cflex">
            <div>
                @csrf
                <h3 class="form_title">OTP Verification</h3>
                {{-- <h6 class="form_subtitle">{{ session()->get('login_msg') }}</h6> --}}
            </div>
            <div class="field">
                <input type="text" name="" placeholder=" ">
                <label for="">OTP</label>
            </div>
            <button type="submit">Proceed</button>
        </form>
    </main>
@endsection
