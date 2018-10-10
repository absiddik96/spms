<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Student Login</title>
        <link rel="stylesheet" href="{!! asset('login/style.css') !!}">
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
                    <h2 class="active">Gono Bishwabidyalay</h2><br>
                    <h2 class="active">Seat Plan Management System</h2>
                </div>
                <br>
                <a class="a-active " href="">Student</a>
                <a class="a-btn" href="">Teacher</a>
                <br>
                <small>Student Login</small>

                <!-- Login Form -->
                <form>
                    <input type="text" id="login" class="fadeIn second" name="login" placeholder="Email">
                    <input type="text" id="password" class="fadeIn third" name="login" placeholder="Password">
                    <input type="submit" class="btn btn-primary" value="Log In">
                </form>

                <!-- Remind Passowrd -->
                <div id="formFooter">
                    <a class="underlineHover" href="#">Forgot Password?</a>
                </div>

            </div>
        </div>
    </body>
</html>
