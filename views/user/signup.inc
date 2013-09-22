<?php
	 
    $first_name = htmlentities($view_data['first_name']);
    $last_name = htmlentities($view_data['last_name']);
?>

<h3>Welcome!</h3>
<p class="content">Welcome to the site!</p>

<p class="content">Please complete your profile:</p>
<form action="<?php echo BASE_URL.BASE_PATH."/index.php/user/registerUser"; ?>" method="post" id="full_signup_form" class="content">
    <label for="new_first_name" >First Name:</label>
         <input type="text" name="new_first_name" id="new_first_name" maxlength="20" size="20" value="<?php echo $first_name; ?>" required /><br />
    <label for="new_last_name" >Last Name:</label>
        <input type="text" name="new_last_name" id="new_last_name" maxlength="20" size="20" value="<?php echo $last_name; ?>" required /><br /><br />
    <label for="new_username" >Username:</label>
        <input type="text" name="new_username" id="new_username" maxlength="20" size="20" required /><br />
    <label for="new_password">Password:</label>
        <input type="password" name="new_password" id="new_password" maxlength="20" size="20" required /><br /><br />
    <label for="new_user_height">User Height:</label>
        <input type="new_user_height" name="new_user_height" id="new_user_height" maxlength="20" size="20" required /><br />
    <label for="new_user_weight">User Weight:</label>
        <input type="new_user_weight" name="new_user_weight" id="new_user_weight" maxlength="20" size="20" required /><br />
    <label for="new_target_weight">Target Weight:</label>
        <input type="new_target_weight" name="new_target_weight" id="new_target_weight" maxlength="20" size="20" required /><br />
    <input type="submit" name="signup_btn" id="signup_btn" value="Sign Up!"/> 
</form>

<p id="back_link"><a href="<?php echo BASE_URL.BASE_PATH."/index.php"; ?>"><< Go Back</a></p>