@extends('user.components.layout')
@push('css')
    <link rel="stylesheet" href="css/index.css">
    <style>
        section.destinations {
            padding-inline: 50px;
        }

        section .section_head {
            padding: 20px;
        }

        section .section_head .view_all {
            color: var(--fv_sec);
            font-weight: 600;
            font-size: 1.4rem;
            border-bottom: 1.6px solid;
        }

        section .section_head .view_all i {
            margin-left: 7px;
        }

        .destination {
            position: relative;
            overflow: hidden;
            height: 200px;
            border-radius: 10px;
            box-shadow: 0 0 5px 0 #00000033;
        }

        .destination img {
            width: 100%;
            height: 100%;
            transition: all 0.3s;
        }

        .destination:hover img {
            scale: 1.1;
        }

        .destination .details {
            padding: 10px;
            inset-inline: 0;
            bottom: 0;
            position: absolute;
        }

        .destination .details .detail {
            background: #ffffff88;
            padding: 10px 20px;
            border-radius: 6px;
            backdrop-filter: blur(1px);
        }

        .destination .details .detail .country {
            padding: 3px 15px;
            width: max-content;
            border-radius: 100px;
            background: #ffffff;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 1px;
            color: var(--fv_prime);
        }

        .destination .details .detail .desti {
            margin-block: 3px 2px;
            color:  blue;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .destination .details .detail .packages {
            font-size: 1.2rem;
        }

        .destination .details .detail .packages span {
            font-weight: bold;
            font-size: 1.4rem;
            margin-right: 5px;
        }

        @media screen and (max-width: 500px) {
            section.destinations {
                padding-inline: 0px;
            }

            .desti-wrap:not(:nth-of-type(3n)) {
                width: 50%;
            }

        }

       
        .col-border-none{
            --tw-border-opacity: 1;
            border-color: rgb(var(--neutral-100)/var(--tw-border-opacity));
            border-width: 1px;
            border-radius: 10px;

        }

        .flight-link {
            color: #000; 
            text-decoration: none;
            transition: color 0.3s ease; 
        }

        .flight-link:hover {
            color: #ff5e00; /* Change text color on hover */
        }

        #registerCabBtn{
            position: absolute;
            right: 20px;            
            padding: 8px 30px;           
            border: none;
            font-size: 1.4rem;
            font-weight: 600;
            border-radius: 4px;
            background-color: var(--fv_prime);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            border-radius: 10px;
            display: flex;
            flex-direction: row;
        }
        .modal-content .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
        }
        .modal-content .modal-body {
            flex: 1;
            padding: 2rem;
        }
        .modal-content .modal-footer {
            border-top: none;
        }
        .car-image {
            max-width: 100%;
        }
        .modal-content .custom-modal {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-content .custom-modal-content {
            flex: 1;
        }
        .modal-content .custom-modal-image {
            flex: 0 0 45%;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .modal-content .close {
            cursor: pointer;
            font-size: 2.5rem;
            color: var(--fv_sec);
        }
        .modal-content .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        .modal-content  .form-group input {
            width: 90%;
            padding: 0.5rem 0.5rem 0.5rem 2.5rem;
            box-sizing: border-box;
            border: none;
            border-bottom: 1px solid #ccc;
            transition: border-color 0.3s;
        }
        .modal-content .form-group input:focus {
            border-color: var(--fv_sec);
            outline: none;
        }
        .modal-content .form-group .icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: var(--fv_sec);
            font-size: 1.2rem;
        }
        .modal-content .form-group .toggle-password {
            position: absolute;
            top: 50%;
            right: 0.5rem;
            transform: translateY(-50%);
            color: var(--fv_sec);
            cursor: pointer;
        }
        .modal-content .btn {
            padding: 0.75rem 1.5rem;
            color: #fff;
            background-color: var(--fv_sec);
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
        }
        .modal-content .terms-link {
            color: var(--fv_sec);
            cursor: pointer;
            text-decoration: underline;
            margin-top: 1rem;
        }
        .modal-content .terms-checkbox {
            display: flex;
            align-items: center;
            margin: 1rem;
        }
        .modal-content .terms-checkbox input {
            margin-right: 0.5rem;
        }
        .modal-content .terms-checkbox i {
            color: var(--fv_sec);
            margin-right: 0.5rem;
        }

    </style>
@endpush
@section('main')

<main>
    @include('user.components.forms.form')
    
    <section class="destinations">
        <div class="section_head rflex jcsb aic">
            <h4 class="section_title">Popular Hotels Destinations </h4>  
            
            <ul>
                
            </ul>    

            <button id="registerCabBtn">Register Your Hotels </button>
        </div>  
        
        

         <!-- The Modal -->
         <div id="registerCabModal" class="modal">
            <div class="modal-content">
                <div class="custom-modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Hotel Buisness Registration </h5>
                        
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admin/business-login/register') }}" method="POST">
                            @csrf
                            <input type="hidden" name="business_type" value="hotel">
                            <div class="form-group">
                                <input type="text" id="companyName" name="companyName" placeholder="Enter Company Name" maxlength="50" required>
                                <i class="fas fa-building icon"></i>
                            </div>
                            <div class="form-group">
                                <input type="text" id="contactNo" name="contactNo" placeholder="Enter Contact No" pattern="\d{10}" title="Please enter exactly 10 digits" required>
                                <i class="fas fa-phone icon"></i>
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" placeholder="Enter E-mail" maxlength="50" required>
                                <i class="fas fa-envelope icon"></i>
                            </div>
                            <div class="form-group">
                                <input type="text" id="city" name="city" placeholder="Enter City" maxlength="16" required>
                                <i class="fas fa-city icon"></i>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" name="password" placeholder="Enter Password" minlength="8" maxlength="16" required>
                                <i class="fas fa-lock icon"></i>
                                <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                            </div>
                            <div class="terms-checkbox">
                                <i class="fas fa-check-circle"></i>
                                <label for="terms"> I agree above <a class="terms-link" href="#"> Terms And Conditions </a> </label> 
                            </div>
                            <button type="submit" class="btn"> Register Now </button>
                        </form>
                    </div>
                </div>
                <div class="custom-modal-image">
                    <img src="{{ asset('images/web assets/hotel_modal.png') }}" alt="Yellow Car" class="car-image" style="border-radius: 6px; ">
                </div>
                <span class="close" id="closeModal">&times;</span>
            </div>
        </div>
        
    </section>
</main>
@endsection

@push('js')

<script>
    // Get modal element
    var modal = document.getElementById('registerCabModal');
    // Get open modal button
    var modalBtn = document.getElementById('registerCabBtn');
    // Get close button
    var closeBtn = document.getElementById('closeModal');
    // Get toggle password button
    var togglePassword = document.getElementById('togglePassword');
    // Get password input
    var passwordInput = document.getElementById('password');

    // Listen for open click
    modalBtn.addEventListener('click', openModal);
    // Listen for close click
    closeBtn.addEventListener('click', closeModal);
    // Listen for outside click
    window.addEventListener('click', outsideClick);
    // Listen for toggle password click
    togglePassword.addEventListener('click', togglePasswordVisibility);

    // Function to open modal
    function openModal() {
        modal.style.display = 'block';
    }

    // Function to close modal
    function closeModal() {
        modal.style.display = 'none';
    }

    // Function to close modal if outside click
    function outsideClick(e) {
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    }

    // Function to toggle password visibility
    function togglePasswordVisibility() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePassword.classList.remove('fa-eye');
            togglePassword.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
        }
    }
</script>
@endpush
