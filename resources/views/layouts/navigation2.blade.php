<nav class="navbar navbar-expand-lg bg-transparent" style="z-index: 9">
    <div class="container-fluid">
       
        <div class="collapse navbar-collapse ms-auto" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                
                <li><a class="nav-link text-dark" href="{{route('profile.edit')}}" style="color: black; font-weight: bold">
                    {{ __('Profile') }}
                </a></li>
                <li> <form method="POST" action="{{ route('logout') }}">
                    @csrf
    
                    <a href="route('logout')" class="nav-link text-dark" style="color: black; font-weight: bold"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form></li>
                
            </ul>
        </div>
    </div>
</nav>
