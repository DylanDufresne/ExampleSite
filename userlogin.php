<!DOCTYPE html>
<html>
    <head>
        <title>User Login Form</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <!--        div for css applied to title text-->
    <div id="title">
        <h1>Welcome to Dylan Dufresne's COSC 213 Final Project</h1>
        <h2>Please enter your login information below to proceed</h2>
        <h5>Enter username: dling and password: letmein</h5>
    </div>
</head>
<body>
    <!--If the user was redirected from the logout file, echo a logout message-->
    <?php
    if (!empty($_GET['logout'])) {
        echo '<div>Successfully Logged Out</div>';
    }
    ?>

    <!--Javascript function to check if the password field is filled out-->
    <script>
        function validation() {
            let password = document.forms["loginForm"]["password"].value;
            if (password === "") {
                alert("Please enter a password");
            }
        }
    </script>
    <form name="loginForm" method="post" action="mainmenu.php" onsubmit="return validation()">
        <fieldset> <legend><h3> Website Login </h3></legend>
            <p><strong>USERNAME:</strong><br/>
                <input type="text" name="username" required/></p>
            <p><strong>PASSWORD:</strong><br/>
                <input type="password" name="password"/></p>
            <p><input type="submit" name="submit" value="login"/></p>
        </fieldset>
    </form><br>
</body>
<footer>
    <h4>Dylan Dufresne's COSC 213 Website Created in 2021</h4>
</footer>
</html>