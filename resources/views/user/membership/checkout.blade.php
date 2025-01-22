@extends('user.components.layout')
@push('css')
    <link rel="stylesheet" href="{{ url('css/user_css/bookcab.css') }}">
    <style>
        button {
            padding: 9px;
            font-weight: 600;
            font-size: 1.5rem;
            background: var(--fv_prime);
            border-radius: 6px;
            border: none;
            width: 280px;
            margin: 20px 0;

        }

        .fields {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }

        .fields .field {
            display: flex;
            flex-direction: column;
        }

        .fields .field label {
            font-size: 1.3rem;
            margin-bottom: 3px;
        }

        .fields .field:has(input, select) {
            flex-grow: 1;
        }

        .fields .field :is(input, select) {
            padding: 5px 10px;
        }
    </style>
@endpush
@section('main')
    <main>

        <div class="sps_pgwrapper">
            {{-- <div class="sps_pgleft">   for left side-bar     </div> --}}
            <div class="sps_pgleft">
                <div class="infinite_ld_container">
                    <div class="ld_card">
                        <div class="cab_card">
                            <div class="cab_card_head">
                                <div class="cab_dth">
                                    <div class="cab_dth">
                                        <h4>Pay {{ $total }} to confirm your membership </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="cab_list_item">
                            <div class="cab_list_items">
                                <div class="cab_item_left">
                                    <div class="cab_makeflex">
                                        <span class="cab_title"> {{ $request->name }} </span>
                                    </div>

                                </div>
                                <div>
                                    <span class="cab_title"> Mobile No. :{{ $request->mobile_no }} </span><br>
                                </div>
                                <div>
                                    <span class="cab_title"> Email: {{ $request->email }}</span><br>
                                </div>
                                <div>
                                    <span class="cab_title"> Age Group: {{ $request->agegroup }} </span><br>
                                </div>

                            </div>
                        </div>

                        {{-- <div>
                            <form id="memberForm" method="post" action="{{ route('member.add') }}">

          
                                <div >
                                    <div class="fields" style="margin-top: 30px;">
                                        <div class="field">
                                            <label for="yourName">Your Name:</label>
                                            <input type="text" name="yourName" id="yourName" required>
                                        </div>
                                        <div class="field">
                                            <label for="yourAge">Your Age:</label>
                                            <input type="number" min="18" name="yourAge" id="yourAge" required>
                                        </div>
                                        <div class="field">
                                            <label for="yourAadharNo" >Your Aadhar No:</label>
                                            <input type="text" name="yourAadharNo" id="yourAadharNo" required>
                                        </div>
                                    </div>

                                    <div class="fields" style="margin-top: 30px;">
                                        <div class="field">
                                            <label for="yourImage">Your Image</label>
                                            <input type="file" name="yourImage"  id="yourImage" required>
                                        </div>
                                        <div class="field">
                                            <label for="yourPhoneNo">Your Phone No:</label>
                                            <input type="text" name="yourPhoneNo" id="yourPhoneNo" required>
                                        </div>
                                        <div class="field">
                                            <label for="yourEmail">Your Email:</label>
                                            <input type="email" name="yourEmail" id="yourEmail">
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- Wife inputs (initially hidden) -->
                                <div id="wifeInputs" style="display: none;">
                                    <div class="fields" style="margin-top: 30px;">
                                        <div class="field">
                                            <label for="partnerName">Partner Name:</label>
                                            <input type="text" name="partnerName" id="partnerName" required>
                                        </div>
                                        <div class="field">
                                            <label for="partnerAge">Partner Age:</label>
                                            <input type="number" min="18" name="partnerAge" id="partnerAge" required>
                                        </div>
                                        <div class="field">
                                            <label for="partnerAadharNo" >Partner Aadhar No:</label>
                                            <input type="text" name="partnerAadharNo" id="partnerAadharNo" required>
                                        </div>
                                    </div>

                                    <div class="fields" style="margin-top: 30px;">
                                        <div class="field">
                                            <label for="partnerImage">Partner Image</label>
                                            <input type="file" name="partnerImage"  id="partnerImage" required>
                                        </div>
                                        <div class="field">
                                            <label for="partnerPhoneNo">Partner Phone No:</label>
                                            <input type="text" name="partnerPhoneNo" id="partnerPhoneNo" required>
                                        </div>
                                        <div class="field"> 
                                            <label for="partnerEmail">Partner Email:</label>
                                            <input type="email" name="partnerEmail" id="partnerEmail">
                                        </div>
                                        <label for="partnerGender"> Partner Gender:</label>
                                        <select name="partnerGender" id="partnerGender">
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                            <option value="other">Other</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <!-- Children inputs (initially hidden) -->
                                <div id="childrenInputs1" style="display: none;">
                                    <div class="fields" style="margin-top: 30px;">
                                        <div class="field">
                                            <label for="child1Name">Child 1 Name:</label>
                                            <input type="text" name="child1Name" id="child1Name">
                                        </div>
                                        <div class="field">
                                            <label for="child1Age">Child 1 Age:</label>
                                            <input type="number" min="1"  max="12" name="child1Age" id="child1Age">
                                        </div>
                                        <div class="field">
                                            <label for="child1Gender">Child 1 Gender:</label>
                                            <select name="child1Gender" id="child1Gender">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="childrenInputs2" style="display: none;">
                                    <div class="fields" style="margin-top: 30px;">
                                        <div class="field">
                                            <label for="child2Name">Child 2 Name:</label>
                                            <input type="text" name="child2Name" id="child2Name">
                                        </div>
                                        <div class="field">
                                            <label for="child2Age">Child 2 Age:</label>
                                            <input type="number" min="1" max="12" name="child2Age" id="child2Age">
                                        </div>
                                        <div class="field">
                                            <label for="child2Gender">Child 2 Gender:</label>
                                            <select name="child2Gender" id="child2Gender">
                                                <option value="female">Female</option>
                                                <option value="male">Male</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                    
                                <button type="button" id="addWifeBtn">Add Partner Details </button>
                                <button type="button" id="addChildBtn" style="display: none;">Add Member Child</button>
                                <button type="button" id="addChild2Btn" style="display: none;"> Add Member
                                   2nd Child</button>
                                <button type="submit" id="submitBtn" style="display: none;">Submit</button>
                            </form>
                        </div> --}}

                    </div>
                </div>
            </div>
            <div class="sps_pgright">
                <div class="panel">
                    <h5>Fare Summary</h5>
                    <div class="rflex jcsb" style="font-size: 0.9em;margin-top:10px;">
                        <p>{{ $type }} Card </p>
                        <p>{{ $fare }} </p>
                    </div>

                    <div class="rflex jcsb" style="font-size: 0.9em;margin-top:10px;">
                        <p> Gst ({{ $gst }}%)</p>
                        <p> {{ round($fare * $gst/100)}} </p>
                    </div>
                    <div class="rflex jcsb" style="margin-top: 7px;padding-top:3px;border-top:1px dashed var(--gray_500)">
                        <h6>Total</h6>
                        <h6>{{ $total }}</h6>
                    </div>
                </div>

               

                <button type="submit" id="razorPay">Checkout</button>

                <div class="panel query_panel">
                    <h5>Raise A Query</h5>
                    <p>Having anything in mind, feel free to write us. We are here for you. We will connect you back as soon
                        as possible</p>
                    <button>Raise A Query</button>
                </div>


            </div>
        </div>


    </main>
@endsection
@push('js')
    @includeIf('user.components.razorPay', ['order' => $order, 'redirect' => url('membership/ticket')])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add wife button click event
            document.getElementById('addWifeBtn').addEventListener('click', function() {
                // Show wife inputs
                document.getElementById('wifeInputs').style.display = 'block';
                // Show "Add Member Child" button
                document.getElementById('addChildBtn').style.display = 'block';
                // Hide "Add Wife" button
                this.style.display = 'none';
                // Show "Submit" button
                document.getElementById('submitBtn').style.display = 'block';
            });

            // Add member child button click event
            document.getElementById('addChildBtn').addEventListener('click', function() {
                // Show children inputs
                document.getElementById('childrenInputs1').style.display = 'block';
                // Show "Add Member Child" button
                document.getElementById('addChild2Btn').style.display = 'block';
                // Hide "Add Member Child" button
                this.style.display = 'none';
            });

            document.getElementById('addChild2Btn').addEventListener('click', function() {

                document.getElementById('childrenInputs2').style.display = 'block';
                // Hide "Add Member Child" button
                this.style.display = 'none';
            });
        });


        $("#memberForm").ajaxSubmit({
            success: function(response) {
                response=JSON.parse(response);
                if (response.errors) {
                    var errorMsg = '';
                    $.each(response.errors, function(field, errors) {
                        $.each(errors, function(index, error) {
                            errorMsg += error + '<br>';
                        });
                    });
                    iziToast.error({
                        message: errorMsg,
                        position: 'topRight'
                    });

                } else {
                    iziToast.success({
                        message: 'Members Added in your profile: ',
                        position: 'topRight'

                    });
                }

            },
            error: function() {
                iziToast.error({
                    message: 'An error occurred: ',
                    position: 'topRight'
                });
            }
        });

    </script>
@endpush
