<?php
	 
    $first_name = htmlentities($view_data['first_name']);
    $last_name = htmlentities($view_data['last_name']);
?>

<h3>Welcome!</h3>
<p class="content">Welcome to the site!</p>

<p class="content">Please complete your profile:</p>
<form action="index.php/user/registerUser" method="post" id="full_signup_form" class="content">
    <label for="firstName" >First Name:</label>
         <input type="text" name="firstName" id="firstName" maxlength="20" size="20" value="<?php echo $first_name; ?>" required /><br />
    <label for="lastName" >Last Name:</label>
        <input type="text" name="lastName" id="lastName" maxlength="20" size="20" value="<?php echo $last_name; ?>" required /><br /><br />
    <label for="newUsername" >Username:</label>
        <input type="text" name="newUsername" id="newUsername" maxlength="20" size="20" required /><br />
    <label for="newPassword">Password:</label>
        <input type="password" name="newPassword" id="newPassword" maxlength="20" size="20" required /><br /><br />
    <label for="userHeight">User Height:</label>
        <input type="userHeight" name="userHeight" id="userHeight" maxlength="20" size="20" required /><br />
    <label for="userWeight">User Weight:</label>
        <input type="userWeight" name="userWeight" id="userWeight" maxlength="20" size="20" required /><br />
    <label for="targetWeight">Target Weight:</label>
        <input type="targetWeight" name="targetWeight" id="targetWeight" maxlength="20" size="20" required /><br />
    <input type="submit" name="signup_btn" id="signup_btn" value="Sign Up!"/> 
</form>

<p id="back_link"><a href="<?php echo BASE_URL.BASE_PATH."/index.php"; ?>"><< Go Back</a></p>