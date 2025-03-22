<div class="col-lg-2">
    <ul class="account-nav">
        <li><a href="{{route('users.dashboard')}}" class="menu-link menu-link_us-s">Dashboard</a></li>
        <li><a href="{{route('users.account-orders')}}" class="menu-link menu-link_us-s">Orders</a></li>
        <li><a href="/account-address" class="menu-link menu-link_us-s">Addresses</a></li>
        <li><a href="/account-details" class="menu-link menu-link_us-s">Account Details</a></li>
        <li><a href="/wishlist" class="menu-link menu-link_us-s">Wishlist</a></li>
        <form method="POST" action="{{route('dashboard.logout')}}" id="logout-form">
            @csrf
            <li><a href="{{route('dashboard.logout')}}" class="menu-link menu-link_us-s"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        </form>
    </ul>
</div>