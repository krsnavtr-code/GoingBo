@extends('user.components.layout')
@push('css')
    <style>
        section {
            padding: 20px 0;
        }
        section h1 {
            color: #333;
            text-align: center;
        }
        section p {
            color: #666;
            font-size: 16px;
            line-height: 1.6em;
        }

        .contact-image {
            float: left;
            margin-right: 20px;
            margin-bottom: 20px;
        }

        img {
            height: 250px;
        }

        .contact-form {
            width: 60%;
            float: left;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .contact-form button {
            background-color: #e8491d;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #333;
        }
    </style>
@endpush

@section('main')
    <main>
        <div class="container">
            <section>
                <h1 style="color: var(--fv_sec);">Contact Us</h1>
                <div class="contact-image">
                    <h5> Head Office :</h5>
                    <h4> <span style="color: var(--fv_sec);"> Going</span><span style="color: var(--fv_prime);">Bo </span> <span style="color: var(--fv_sec);"> Tours Pvt. Ltd. </span>   </h4>
                    <h5 style="color: var(--fv_sec);"> Plot No. 63, Sector 64 Rd, </br> B Block, Sector 63,</br> Noida, Uttar Pradesh. </br>  Pin- 201301 </h5>
                    <h6 style="color: var(--fv_sec);"> Email Us: <a href="mailto:info@goingbo.com" style="color: var(--fv_prime);"> info@goingbo.com </a> </h6>
                    <h6 style="color: var(--fv_sec);"> Mobile: <a href="tel:9990999561" style="color: var(--fv_prime);">+91 9990999561</a>
                    </h6>
                    
                </div>
                <div class="contact-form">
                    <form>
                        <div>
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div>
                            <label for="phone">Phone Number:</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>

                        <div>
                            <label for="message">Message:</label>
                            <textarea id="message" name="message" rows="4" required></textarea>
                        </div>

                        <button type="submit">Submit</button>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection
