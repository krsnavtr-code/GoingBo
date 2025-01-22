    
    <form action="{{ url('hotel/checkout') }}" method="POST" class="text-box" style="overflow: auto; ">
        @csrf
        <!--  General -->
        <input name="prebook" value="{{ json_encode($prebook) }}" hidden>
        <input name="hotelname" value="{{$hotels[0]['HotelName']}}" hidden>
        
        <button type="reset" class="x">x</button>
        <div>
            <h1 class="heading" style="text-align: center; "> Booking & contact </h1>
        </div>
        <!--  Details -->
        <div>
            <h2 class="heading">Details</h2>
            <div class="grid">
                <div class="col-1-4 col-1-4-sm">
                    <div class="controls">
                        <input type="date" class="floatLabel" disabled>
                        <label class="label-date" style=" top: 8px; width: 60%;" ><i  class="fa fa-calendar"></i> &nbsp;Arrive{{ date('d-m-y', strtotime(session('hotel_search_inputs.dep_date'))) }} </label>
                    </div>
                </div>
                <div class="col-1-4 col-1-4-sm">
                    <div class="controls">
                        <input type="date" class="floatLabel" disabled>
                        <label class="label-date" style=" top: 8px; width: 60%;" ><i class="fa fa-calendar"></i> &nbsp;Depart{{ date('d-m-y', strtotime(session('hotel_search_inputs.ret_date'))) }} </label>
                    </div>
                </div>
            </div>
            <div class="grid">
                <div class="col-1-3 col-1-3-sm">
                    <div class="controls">
                        <input type="text" value="{{ session('hotel_search_inputs.adult') + session('hotel_search_inputs.child') }} People" disabled>
                        <label for="fruit" style=" top: 8px; width: 60%;" ><i class="fa fa-male" ></i> </label>
                    </div>
                </div>
                <div class="col-1-3 col-1-3-sm">
                    <div class="controls">
                        <input type="text" value="{{ session('hotel_search_inputs.room') }} Room" disabled>
                        <label for="fruit" style=" top: 8px; width: 60%;"><i class="fa-solid fa-hotel"></i></i>  </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Passenger Details -->
        <div class="inputs" >
          <h2 class="heading">Passenger Details</h2>
          
          @php
            //   dd(session('hotel_search_inputs'));
              $rooms = session('hotel_search_inputs.room');
              $adults = session('hotel_search_inputs.adult');
              $children = session('hotel_search_inputs.child');
              $childAges = session('hotel_search_inputs.child_ages');
              $childAges = array_map('intval', explode(',', session('hotel_search_inputs.child_ages')));

            //   dd($childAges);
              // Calculate distribution of adults and children
              $adultsPerRoom = intdiv($adults, $rooms);
              $extraAdults = $adults % $rooms;

              $childrenPerRoom = intdiv($children, $rooms);
              $extraChildren = $children % $rooms;

              $childIndex = 0;
          @endphp
          @for ($i = 1; $i <= $rooms; $i++)
              <div class="room-details">
                  <h3>Room {{ $i }}</h3>
                  <!-- Details for adults -->
                  @php
                      $currentRoomAdults = $adultsPerRoom + ($i <= $extraAdults ? 1 : 0);
                      $currentRoomChildren = $childrenPerRoom + ($i <= $extraChildren ? 1 : 0);
                  @endphp
                  @for ($j = 1; $j <= $currentRoomAdults; $j++)
                      <div class="passenger">
                          <h4>Adult {{ $j }}</h4>
                          <div class="controls">                            
                            <select name="passenger[{{ $i }}][adult][{{ $j }}][title]" class="floatLabel" required>
                                <option value="Mr">Mr</option>
                                <option value="Ms">Ms</option>
                                <option value="Mrs">Mrs</option>
                            </select>
                            <label for="passenger[{{ $i }}][adult][{{ $j }}][title]">Title</label>                             
                          </div>
                          <div class="controls">
                              <input type="text" name="passenger[{{ $i }}][adult][{{ $j }}][first_name]" class="floatLabel" required>
                              <label for="passenger[{{ $i }}][adult][{{ $j }}][first_name]">First Name*</label>
                          </div>
                          <div class="controls">
                              <input type="text" name="passenger[{{ $i }}][adult][{{ $j }}][middle_name]" class="floatLabel">
                              <label for="passenger[{{ $i }}][adult][{{ $j }}][middle_name]">Middle Name</label>
                          </div>
                          <div class="controls">
                              <input type="text" name="passenger[{{ $i }}][adult][{{ $j }}][last_name]" class="floatLabel" required>
                              <label for="passenger[{{ $i }}][adult][{{ $j }}][last_name]">Last Name*</label>
                          </div>
                          <div class="controls">
                            <input type="number" min="13" max="120" name="passenger[{{ $i }}][adult][{{ $j }}][age]" class="floatLabel" >
                            <label for="passenger[{{ $i }}][adult][{{ $j }}][age]">Age</label>
                          </div>
                          <!-- Mandatory phone and email for lead passenger -->
                          @if ($j == 1)
                              <div class="controls">
                                  <input type="tel" name="passenger[{{ $i }}][adult][{{ $j }}][phone]" class="floatLabel" required>
                                  <label for="passenger[{{ $i }}][adult][{{ $j }}][phone]">Phone *</label>
                              </div>
                              <div class="controls">
                                  <input type="email" name="passenger[{{ $i }}][adult][{{ $j }}][email]" class="floatLabel" required>
                                  <label for="passenger[{{ $i }}][adult][{{ $j }}][email]">Email *</label>
                              </div>
                          @else
                              <div class="controls">
                                  <input type="tel" name="passenger[{{ $i }}][adult][{{ $j }}][phone]" class="floatLabel">
                                  <label for="passenger[{{ $i }}][adult][{{ $j }}][phone]">Phone</label>
                              </div>
                              <div class="controls">
                                  <input type="email" name="passenger[{{ $i }}][adult][{{ $j }}][email]" class="floatLabel">
                                  <label for="passenger[{{ $i }}][adult][{{ $j }}][email]">Email</label>
                              </div>
                          @endif
                          
                          <input type="hidden" name="passenger[{{ $i }}][adult][{{ $j }}][leadpassenger]" value="{{ $j == 1 ? 'true' : 'false' }}">
                          <!-- Optional Passport and PAN -->
                          <div class="controls">
                              <input type="text" name="passenger[{{ $i }}][adult][{{ $j }}][passport_no]" class="floatLabel">
                              <label for="passenger[{{ $i }}][adult][{{ $j }}][passport_no]">Passport No</label>
                          </div>
                          <div class="controls">
                              <input type="date" name="passenger[{{ $i }}][adult][{{ $j }}][passport_issue_date]" class="floatLabel">
                              <label for="passenger[{{ $i }}][adult][{{ $j }}][passport_issue_date]">Passport Issue Date</label>
                          </div>
                          <div class="controls">
                              <input type="date" name="passenger[{{ $i }}][adult][{{ $j }}][passport_exp_date]" class="floatLabel">
                              <label for="passenger[{{ $i }}][adult][{{ $j }}][passport_exp_date]">Passport Expiry Date</label>
                          </div>
                          <div class="controls">
                              <input type="text" name="passenger[{{ $i }}][adult][{{ $j }}][pan]" class="floatLabel">
                              <label for="passenger[{{ $i }}][adult][{{ $j }}][pan]">PAN</label>
                          </div>
                      </div>
                  @endfor
                  <!-- Details for children -->
                  @if ($children > 0)
                      @for ($k = 1; $k <= $currentRoomChildren; $k++)
                          <div class="passenger">
                              <h4>Child {{ $k }}</h4>
                              <div class="controls">
                                
                                <select name="passenger[{{ $i }}][child][{{ $k }}][title]" class="floatLabel" required>
                                    <option value="Mstr">Mstr</option>
                                    <option value="Ms">Ms</option>                            
                                </select>
                                <label for="passenger[{{ $i }}][child][{{ $k }}][title]">Title</label>
                                  
                              </div>
                              <div class="controls">
                                  <input type="text" name="passenger[{{ $i }}][child][{{ $k }}][first_name]" class="floatLabel" required>
                                  <label for="passenger[{{ $i }}][child][{{ $k }}][first_name]">First Name*</label>
                              </div>
                              <div class="controls">
                                  <input type="text" name="passenger[{{ $i }}][child][{{ $k }}][middle_name]" class="floatLabel">
                                  <label for="passenger[{{ $i }}][child][{{ $k }}][middle_name]">Middle Name</label>
                              </div>
                              <div class="controls">
                                  <input type="text" name="passenger[{{ $i }}][child][{{ $k }}][last_name]" class="floatLabel" required>
                                  <label for="passenger[{{ $i }}][child][{{ $k }}][last_name]">Last Name*</label>
                              </div>
                              <div class="controls">
                                  <input type="number"  class="floatLabel"   disabled>
                                  <label for="passenger[{{ $i }}][child][{{ $k }}][age]"> Age {{ $childAges[$childIndex] }}  </label>
                                  <input type="hidden" name="passenger[{{ $i }}][child][{{ $k }}][age]" value="{{ $childAges[$childIndex] }}">
                              </div>
                                @php
                                $childIndex++;
                                @endphp
                                
                              <!-- Optional Passport and PAN for children -->
                              <div class="controls">
                                  <input type="text" name="passenger[{{ $i }}][child][{{ $k }}][passport_no]" class="floatLabel">
                                  <label for="passenger[{{ $i }}][child][{{ $k }}][passport_no]">Passport No</label>
                              </div>
                              <div class="controls">
                                  <input type="date" name="passenger[{{ $i }}][child][{{ $k }}][passport_issue_date]" class="floatLabel">
                                  <label for="passenger[{{ $i }}][child][{{ $k }}][passport_issue_date]">Passport Issue Date</label>
                              </div>
                              <div class="controls">
                                  <input type="date" name="passenger[{{ $i }}][child][{{ $k }}][passport_exp_date]" class="floatLabel">
                                  <label for="passenger[{{ $i }}][child][{{ $k }}][passport_exp_date]">Passport Expiry Date</label>
                              </div>
                              <div class="controls">
                                  <input type="text" name="passenger[{{ $i }}][child][{{ $k }}][pan]" class="floatLabel">
                                  <label for="passenger[{{ $i }}][child][{{ $k }}][pan]">PAN</label>
                              </div>
                          </div>
                      @endfor
                  @endif
              </div>
          @endfor
      </div>
        <div class="grid">
        <div class="controls">
            <h4> GST Details </h4>
            <input type="number" name="gst_num" placeholder="Enter your GST number">
            <input type="text" name="gst_comp" placeholder="Enter your GST company name">
            <input type="phone" name="gst_comp_no" placeholder="Enter your GST company contact number">
            <input type="text" name="gst_comp_add" placeholder="Enter your GST company address">            
            <input type="email" name="gst_comp_email" placeholder="Enter your GST company email">
        </div>
        </div>
        <div class="grid">
            <p class="info-text">Please describe your needs e.g. Extra beds, children's cots</p>
            <br>
            <div class="controls">
                <textarea name="comments" class="floatLabel" id="comments"></textarea>
                <label for="comments">Comments</label>
            </div>
            <button type="submit" value="Submit" class="col-1-4">Submit</button>
        </div>
    </form>




           
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script>
        (function($) {
            function floatLabel(inputType) {
                $(inputType).each(function() {
                    var $this = $(this);
                    // on focus add cladd active to label
                    $this.focus(function() {
                        $this.next().addClass("active");
                    });
                    //on blur check field and remove class if needed
                    $this.blur(function() {
                        if ($this.val() === '' || $this.val() === 'blank') {
                            $this.next().removeClass();
                        }
                    });
                });
            }
            // just add a class of "floatLabel to the input field!"
            floatLabel(".floatLabel");
        })(jQuery);
    </script>
@endpush
