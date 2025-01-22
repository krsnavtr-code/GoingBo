@if (isset($businessLogin))
<aside class="sidebar">
    <ul>
        @if ($businessLogin->business_type === 'cab')
            <li><a href="{{ route('cab.add_route') }}">Add Cab Route</a></li>
            <li><a href="{{ route('cab.add') }}">Add Cab</a></li>
            <li><a href="{{ route('cab.edit') }}">Edit Cab</a></li>
            <li><a href="{{ route('cab.view_routes') }}">View Cab Routes</a></li>
            <li><a href="{{ route('cab.view') }}">View Cabs</a></li>
        @elseif ($businessLogin->business_type === 'hotel')
            <li><a href="{{ url('admin/business-login/hotel/add') }}">Add Hotel</a></li>
            <li><a href="{{ route('hotel.edit') }}">Edit Hotel</a></li>
            <li><a href="{{ route('hotel.view_rooms') }}">View Hotel Rooms</a></li>
        @endif

        <!-- Common Links -->
        <li><a href="{{ route('account.info') }}">Account Info</a></li>
        {{-- <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>  --}}
        <li> <a href="admin/business-login/logout" > Logout </a> </li>
        {{-- <form id="logout-form" action="{{ url('admin/business-login/logout') }}" method="POST" style="display: none;">
            @csrf
        </form> --}}
        
             
        
    </ul>
</aside>
@endif
