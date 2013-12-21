<!DOCTYPE html>
<html>
    <head>
        <title>
            @section('title')
            Rasla
            @show
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS are placed here -->
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/bootstrap-responsive.css') }}
        {{ HTML::style('css/bootstrap-responsive.css') }}
        {{ HTML::style('css/bootstrap-responsive.css') }}


        <style>
        @section('styles')
            body {
                padding-top: 60px;
            }
        @show
        </style>
    </head>

    <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{ HTML::link(Route('home'), 'Rasla' ,array("class"=>"navbar-brand")) }}
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
<!--                    <li class="active"> {{ HTML::link(Route('home'), 'Home') }}</li>-->
                    @if ( !Auth::guest() )
                    @if ( allowed('users_view') )
                    <li>{{ HTML::link(Route('user/index'), 'Users') }}</li>
                    @endif
                    @if ( allowed('roles_view') )
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>{{ HTML::link(Route('role/index'), 'Roles') }}</li>
                         </ul>
                    </li>
                </ul>
                         @endif
                      @endif
                <div class="nav pull-right">
                    <ul class="nav">
                        @if ( Auth::guest() )
                        <li>{{ HTML::link('login', 'Login') }}</li>
                        @else
                        <li>
                            {{ HTML::link('logout', 'Logout', array('style' => 'display: inline')) }}
                            {{ HTML::link('user/profile', Auth::user()->username, array('style' => 'display: inline; color: #FFFFFF')) }}
                        </li>
                        @endif
                    </ul>
                </div>
            </div><!--/.nav-collapse -->

        </div>
    </div>


        <!-- Container -->
        <div class="container">

            <!-- Error Messages -->
            @if($errors->has())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4 class="alert-heading">Error</h4>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br />
                    @endforeach
                </div>
            @endif
            <!-- Success-Messages -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Success</h4>
                    {{{ $message }}}
                </div>
            @endif

            <!-- Content -->
            @yield('content')

        </div>

        <!-- Scripts are placed here -->
        {{ HTML::script('js/jquery.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}

    </body>
</html>
