<div @class([
    'seat',
    'free' => $seat['Price'] == 0,
    'booked' => $seat['AvailablityType'] != 1,
]) onclick="choose_seat(this,'{{ $seat['Code'] }}','{{ $seat['Price'] }}')" data-type="{{$type}}" data-index="{{$index}}" data-seatCode="{{$seatCode}}">
    <div class="seat_design">
        @if ($seat['AvailablityType'] == 1)
            <span>{{ $seat['Code'] }}</span>
        @else
            <i class="fa-solid fa-xmark"></i>
        @endif
    </div>
    <p class="tooltip">{{ $seat['Currency'] }}
        {{ $seat['Price'] }}</p>
</div>
