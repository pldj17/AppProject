@auth()
    @include("theme.$theme.navbars.navs.auth")
@endauth
    
@guest()
    @include("theme.$theme.navbars.navs.guest")
@endguest