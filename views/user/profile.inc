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
    <form action="<?php echo BASE_URL.BASE_PATH."/index.php/user/editUser"; ?>" method="post">
        <label for="name" >Name:</label>
             <input type="text" name="name" id="name" maxlength="20" size="20" /><br /><br />
        <label for="user_height">User Height (inches):</label>
            <input type="user_height" name="user_height" id="user_height" maxlength="3" size="3" /><br />
        <label for="user_weight">User Weight (pounds):</label>
            <input type="user_weight" name="user_weight" id="user_weight" maxlength="3" size="3" /><br />
        <label for="user_target_weight">Target Weight (pounds):</label>
            <input type="user_target_weight" name="user_target_weight" id="user_target_weight" maxlength="3" size="3" /><br />
        <input type="submit" name="edit_profile_btn" id="edit_profile_btn" value="Edit Profile" />
        <h5 id="delete_user_btn"><a href="<?php echo BASE_URL.BASE_PATH."/index.php/user/deleteUser"; ?>">Delete User?</a></h5>
    </form>
</div>

<p id="back_link"><a href="<?php echo BASE_URL.BASE_PATH."/index.php/user/signout"; ?>"><< Log Out</a></p>