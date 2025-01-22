@extends('user.components.layout')
@push('css')
<style>
    /* Container */
    .container {
        width: 80%;
        margin: 0 auto;
        padding: 4rem 0;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        padding: 2rem 1rem;
    }

    /* Card styles */
    .card {
        padding: 1rem;
        border-radius: 6px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 1rem;
        text-align: center;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    .form-group,
    .between {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .currency-rate {
        font-size: 30px;
        color: #007bff;
    }

    .card input {
        font-size: 16px;
        border: none;
        outline: none;
        border-bottom: 2px solid gray;
        display: flex;
        text-align: center;
    }

    .book {
        margin: auto;
        width: max-content;
        padding: 0.6rem 2rem;
        border-radius: 6px;
        border: none;
        background: green;
        color: #fff;
        opacity: 0.8;
        font-size: medium;
    }

    .book:hover {
        opacity: 1;
    }

    /* Live Indicator */
    .live-indicator {
        font-size: 18px;
        display: flex;
        gap: 1rem;
        background: red;
        color: #fff;
        width: max-content;
        padding: 4px 2rem;
        border-radius: 6px;
        margin: auto;
        font-weight: bold;
    }


    /* Responsive Adjustments */
    .modal {
        display: none;
        z-index: 100;
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal.show {
        display: block;
    }

    .modal-dialog {
        background: #fff;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 2rem;
        color: gray;
        font-weight: 400;
        border-radius: 10px;
    }

    .modal-dialog select,
    .modal-dialog input {
        width: 250px;
        padding: 1rem;
        text-align: left;
        border-radius: 6px;
        background: gainsboro;
        border: none;
        outline: none;
        margin-bottom: 5px;
    }

    .close {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: larger;
    }

    .modal-footer {
        padding: 2rem;
        text-align: center;
    }

    @media only screen and (max-width:1024px) {
        .grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media only screen and (max-width:768px) {
        .container {
            width: 100%;
        }

        .grid {
            grid-template-columns: 1fr;
        }

        .modal-dialog select,
        .modal-dialog input {
            width: max-content;
        }

    }
</style>
@endpush

@section('main')
<main>
    <section class="container">
        <h5 class="live-indicator">
            <img src="{{ asset('images/flags/live.gif') }}" alt="Live" class="live-icon" width="20" height="20"> LIVE   

        </h5>
        <div class="grid">
            @foreach($currencies as $currency)
            <article class="card forex-card">
                <div class="between">
                    <h4>{{ $currency }}</h4>
                    <img src="{{ asset('images/flags/' . $currency . '.png') }}" alt="{{ $currency }} flag" class="img-fluid" width="60">
                </div>
                <h2 class="currency-rate" data-rate="{{ number_format(1/$rates[$currency], 4) }}">
                    ₹ {{ number_format(1/$rates[$currency], 4) }}
                </h2>
                                            
                <input type="number" id="amount-{{ $currency }}" data-currency="{{ $currency }}" data-rate="{{ number_format(1/$rates[$currency], 4) }}" class="amount-input" min="10" max="2000" placeholder="Enter Amount in {{ $currency }}">
                
                <button type="button" class="book" data-toggle="modal" data-target="#forexModal" data-currency="{{ $currency }}" data-rate="{{ $rates[$currency] }}">
                    Book Now
                </button>
            </article>
            @endforeach
        </div>
    </section>



    <div class="modal" id="forexModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="forex/book" method="POST">
                    @csrf
                    <div class="modal-header between">
                        <h5 class="modal-title" id="forexModalLabel">Book Forex</h5>
                        <button type="button" class="close" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="currency_code" id="currency_code">
                        <div class="form-group">
                            <label for="customer_name">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile_no">Mobile No.</label>
                            <input type="text" name="mobile_no" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email ID</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount in <span id="selectedCurrency"></span></label>
                            <input type="number" name="amount" min="10" max="2000" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select name="payment_method" class="form-control" required>
                                <option value="Currency Notes">Currency Notes</option>
                                <option value="Travel Card">Travel Card</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="book">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>
@endsection

@push('js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all the "Book Now" buttons
        const buttons = document.querySelectorAll('button[data-target="#forexModal"]');
        // Select all amount input fields
        const amountInputs = document.querySelectorAll('.amount-input');


        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the currency and rate from data attributes
                const currency = button.getAttribute('data-currency');
                const rate = button.getAttribute('data-rate');

                // Set the modal fields with currency and rate
                document.getElementById('currency_code').value = currency;
                document.getElementById('selectedCurrency').textContent = currency;

                // Show the modal
                const modal = document.getElementById('forexModal');
                modal.style.display = 'block';
                modal.classList.add('show');
            });
        });

        // Close the modal when clicking on the 'X' button or outside the modal
        document.querySelector('.close').addEventListener('click', function() {
            const modal = document.getElementById('forexModal');
            modal.style.display = 'none';
            modal.classList.remove('show');
        });

        window.onclick = function(event) {
            const modal = document.getElementById('forexModal');
            if (event.target == modal) {
                modal.style.display = 'none';
                modal.classList.remove('show');
            }
        };

        // Loop over each input field
        amountInputs.forEach(input => {
            input.addEventListener('input', function() {
                // Get the input value (amount entered by the user)
                const amount = parseFloat(this.value);

                // Get the exchange rate from the data attribute
                const rate = parseFloat(this.getAttribute('data-rate'));

                // Get the associated currency-rate <p> element
                const currencyRateElement = this.closest('.forex-card').querySelector('.currency-rate');

                if (!isNaN(amount) && amount > 0) {
                    // Calculate the new value based on the user's input
                    const convertedValue = (amount * rate).toFixed(4);

                    // Update the currency-rate <p> tag with the new value
                    currencyRateElement.textContent = `₹ ${convertedValue}`;
                } else {
                    // If no valid input, reset to the original rate
                    const defaultRate = this.getAttribute('data-rate');
                    currencyRateElement.textContent = `₹ ${defaultRate}`;
                }
            });
        });
    });
</script>


@endpush