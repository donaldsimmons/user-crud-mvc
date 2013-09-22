<?php
    
    $full_name = $view_data['full_name'];
    $first_name = $view_data['first_name'];
    $last_name = $view_data['last_name'];
        
    $username = $view_data['username'];
    $height = $view_data['height'];
    $weight = $view_data['weight'];
    $target_weight = $view_data['target_weight'];
	
?>

<h3>Your Profile</h3>

<p class="content">Welcome back, <?php echo htmlentities($full_name); ?>!</p>

<ul id="stat_list">
    <li><b>Username:</b> <?php echo htmlentities($username) ?></li><br />
    <li><b>Height:</b> <?php echo htmlentities($height) ?> in</li>
    <li><b>Weight:</b> <?php echo htmlentities($weight) ?> lbs</li>
    <li><b>Target Weight:</b> <?php echo htmlentities($target_weight) ?> lbs</li>
</ul>

<div id="edit_profile_form">
    <h4>Edit Profile</h4>
    <form actions="?" method="post">
        <label for="firstName" >First Name:</label>
             <input type="text" name="firstName" id="firstName" maxlength="20" size="20" value="<?php echo $first_name ?>" /><br />
        <label for="lastName" >Last Name:</label>
            <input type="text" name="lastName" id="lastName" maxlength="20" size="20" value="<?php echo $last_name ?>" /><br /><br />
        <label for="userHeight">User Height (inches):</label>
            <input type="userHeight" name="userHeight" id="userHeight" maxlength="3" size="3" /><br />
        <label for="userWeight">User Weight (pounds):</label>
            <input type="userWeight" name="userWeight" id="userWeight" maxlength="3" size="3" /><br />
        <label for="userTargetWeight">Target Weight (pounds):</label>
            <input type="userTargetWeight" name="userTargetWeight" id="userTargetWeight" maxlength="3" size="3" /><br />
        <input type="submit" name="edit_profile_btn" id="edit_profile_btn" value="Edit Profile" />
        <input type="submit" name="delete_user_btn" id="delete_user_btn" value="Delete User?" />
    </form>
</div>

<p id="back_link"><a href="<?php echo BASE_URL.BASE_PATH."/index.php/user/signout"; ?>"><< Log Out</a></p>