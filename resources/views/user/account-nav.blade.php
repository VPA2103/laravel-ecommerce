<ul class="account-nav">
    <li>
        <a href="{{ route('user.index') }}" class="menu-link d-flex align-items-center">
            <i class="icon-grid me-2"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{route('user.orders')}}" class="menu-link d-flex align-items-center">
            <i class="icon-shopping-cart me-2"></i>
            <span>Orders</span>
        </a>
    </li>
    <li>
        <a href="{{ route('user.account.address') }}" class="menu-link d-flex align-items-center">
            <i class="fas fa-map-marker-alt me-2"></i>
            <span>Addresses</span>
        </a>
    </li>
    <li>
        <a href="{{route('user.account.details')}}" class="menu-link d-flex align-items-center">
            <i class="icon-user me-2"></i>
            <span>Account Details</span>
        </a>
    </li>
    <li>
        <a href="{{route('wishlist.index')}}" class="menu-link d-flex align-items-center">
            <i class="icon-heart me-2"></i>
            <span>Wishlist</span>
        </a>
    </li>
    <li>
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <a href="{{ route('logout') }}" class="menu-link d-flex align-items-center"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="icon-log-out me-2"></i>
                <span>Logout</span>
            </a>
        </form>
    </li>
</ul>
