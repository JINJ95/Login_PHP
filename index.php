<?php
$knownUsernames = array();
$knownPasswords = array();
// define variables
$showForm = true;
$granted = false;
$Username = $Password = ' ';

if ((isset($_POST['username']) && (isset($_POST['password'])))) {
    $Username = $_POST['username'];
    $Password = $_POST['password'];



    
    //read file
    $fs = fopen('./includes/users.txt', 'r');
    $contents = fread($fs, filesize('./includes/users.txt'));
    $words = explode('||>><<||', $contents);

    //Loop Through array every odd number is Username every password is even
    foreach ($words as $word) {
        $names = explode(",", $word);
        for ($x = 0; $x < sizeof($names); $x++) {
            // first element is username
            if ($x == 0) {
                // echo '<p>Username: ';
                array_push($knownUsernames, $names[$x]);
            } else {
                // echo "</p>Password: ";
                array_push($knownPasswords, $names[$x]);
            }
            // echo $names[$x] . '</p>';
        }
    }
    //If password and Username are correct
    for ($i = 0; $i < sizeof($knownUsernames); $i++) {
        if ($Username == $knownUsernames[$i] && $Password == $knownPasswords[$i]) {
            $granted = true;
            $showForm = false;
        }
    }

    if ($granted == true) {
        echo '<h1 class="success">Access Granted</h1>';
    } else {
        echo '<h1 class="failure">Access Denied</h1>';
        $showForm = false;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password System! :)</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <?php if ($showForm) : ?>
        <h1 id="login">Login Here!</h1>
        <div id="emailHelp" class="form-text">Please enter required information:</div>
        <br>
        <form id="form" action="index.php" method="post">
            <span class="error">*</span>
            <label for="fname">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" value="">
            <br><br>
            <span class="error">*</span>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" value=""><br>
            <br>
            <input name="login-button" type="submit">
            <input type="reset">
        </form>
        <br>
        <?php endif; ?>

        <script src="./js/index.js"></script>
</body>

</html>