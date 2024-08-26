<ul id="account-panel" class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route('Profile.account') }}" class="nav-link font-weight-bold" id="profile" role="tab"
            aria-controls="tab-login" aria-expanded="false"><i class="fas fa-user-alt"></i> My Profile</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('Profile.order') }}" class="nav-link font-weight-bold" role="tab" id="profile"
            aria-controls="tab-register" aria-expanded="false"><i class="fas fa-shopping-bag"></i> My Orders</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('Profile.wishlist') }}" class="nav-link font-weight-bold" id="profile" role="tab"
            aria-controls="tab-register" aria-expanded="false"><i class="fas fa-heart"></i> Wishlist</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('Profile.change-password') }}" class="nav-link font-weight-bold" id="profile" role="tab"
            aria-controls="tab-register" aria-expanded="false"><i class="fas fa-lock"></i> Change Password</a>
    </li>
    <li class="nav-item">

        <form method="POST" action="{{ route('logout') }}" id="Logout">
            @csrf
            <a href="{{ route('logout') }}" class="nav-link font-weight-bold" role="tab" aria-controls="tab-register"
                id="profile" aria-expanded="false" onclick="event.preventDefault();
                                                this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i>
                Logout</a>
        </form>
    </li>
</ul>