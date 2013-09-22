<div id="login_form">
    <h3>User Log-In</h3>
    <form action="index.php/user/signin" method="post" class="content">
        <label for="username">Username:</label>
            <input type="text" name="username" id="username" maxlength="20" size="20" /><br />
        <label for="password">Password:</label>
            <input type="password" name="password" id="password" maxlength="20" size="20" /><br />
        <input type="submit" name="signin_btn" id="submit_btn" value="Submit"/>
    </form>
</div> <!-- End LogIn Form Div-->
<div id="signup_form">
    <h3>Sign-Up Today!</h3>
    <form action="<?php echo BASE_URL.BASE_PATH."/index.php/user/signup"; ?>" method="post" class="content">
        <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" maxlength="20" size="20" /><br />
        <label for="last_name">Last Name:</label>
            <input type="last_name" name="last_name" id="last_name" maxlength="20" size="20" /><br />
        <input type="submit" name="home_signup_btn" id="home_signup_btn" value="Sign Up!"/>
    </form>
</div> <!-- End SignUp Form Div-->  
