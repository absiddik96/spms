<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Admin Login</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{!! asset('login/style.css') !!}">
        <link rel="icon" href="{!! asset('images/logo/favicon.png') !!}" type="image/x-icon" />

    </head>

    <body>
        <div class="wrapper-s">
            <div id="formContent">
                <!-- Tabs Titles -->
                <!-- <h2 class="active"> Sign In </h2>
                <h2 class="inactive underlineHover">Sign Up </h2> -->

                <!-- Icon -->
                <br>
                <div class="fadeIn first">
                    <img src="{!! asset('images/logo/gb_logo.png') !!}" width="80px" alt="User Icon" />
                </div>
                <div style="line-height:0px">
                    <h2 class="heading">Gono Bishwabidyalay</h2><br>
                    <h2 class="heading">Seat Plan Management System</h2>
                </div>
                <br>
                <b>Admin Login</b>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login.submit') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="admin_login" value="1">
                    <div class="{{ $errors->has('email') || $errors->has('active') ? ' has-error' : '' }}">
                        <input type="email" id="email" class="fadeIn second input-box" value="{{ old('email') }}" name="email" placeholder="Email" required autofocus><br>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('active'))
                            <span class="help-block">
                                <strong>{{ $errors->first('active') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" id="password" class="fadeIn third input-box" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <input type="submit" class="btn btn-primary" value="Log In">
                </form>

                <!-- Remind Passowrd -->
                <div id="formFooter">
                    <a class="underlineHover" href="#">© Copyright {{ date('Y') }}. Dept of CSE, Gono Bishwabidyalay</a>
                </div>

            </div>
        </div>
    </body>
</html>
