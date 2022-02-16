@if(Session::get('token'))
    @include('layouts.navbars.navs.auth')
@endif
    
@if(!Session::get('token'))
    @include('layouts.navbars.navs.guest')
@endif