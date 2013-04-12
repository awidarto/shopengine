<!DOCTYPE html PUBLIC "-//W3C//DTD XHtml 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Laravel Authentication Demo</title>
    {{ Html::style('/css/style.css') }}
</head>
<body>
    <div id="container">
        <div id="nav">
            <ul>
                <li>{{ Html::link('/', 'Home') }}</li>
                @if(Auth::check())
                    <li>{{ Html::link('profile', 'Profile' ) }}</li>
                    <li>{{ Html::link('logout', 'Logout ('.Auth::user()->username.')') }}</li>
                @else
                    <li>{{ Html::link('signup', 'Sign Up') }}</li>
                    <li>{{ Html::link('login', 'Login') }}</li>
                @endif
            </ul>
        </div><!-- end nav -->

        <!-- check for flash notification message -->
        @if(Session::has('flash_notice'))
            <div id="flash_notice">{{ Session::get('flash_notice') }}</div>
        @endif

        @yield('content')
    </div><!-- end container -->
</body>
</html>