<nav class="navbar navbar-expand-lg fixed-top " style="z-index: 9; ">
    <div class="container-fluid">
       
        <div class="collapse navbar-collapse ms-auto" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li><a class="nav-link" href="{{route('all')}}" style="color: black; font-weight: bold">
                    {{ __('Product') }}
                </a></li>
                <li><a class="nav-link" href="{{route('cart.index')}}" style="color: black; font-weight: bold">
                    {{ __('Cart') }}
                </a></li>
                <li><a class="nav-link" href="{{route('history')}}" style="color: black; font-weight: bold">
                    {{ __('History') }}
                </a></li>
                <li><a class="nav-link" href="{{route('profile.edit')}}" style="color: black; font-weight: bold">
                    {{ __('Profile') }}
                </a></li>
                <li> <form method="POST" action="{{ route('logout') }}">
                    @csrf
    
                    <a href="route('logout')" class="nav-link" style="color: black; font-weight: bold"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form></li>
                
            </ul>
        </div>
    </div>
</nav>
