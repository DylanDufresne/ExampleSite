<?php
//if there is no current session, start one
if (!session_id()) {
    session_start();
}

//if there is no set username, connect to the database and log the user in. 
//Set session variables for username, password, first, and lastname. (Probably not very secure)
if (!ISSET($_SESSION['inputUser'])) {
//Connect to the finalDB table on the localhost server
    $sqlConnect = mysqli_connect("localhost", "cs213user", "letmein", "finalDB");
//Create the query based on username and password
    $_SESSION['inputUser'] = filter_input(INPUT_POST, 'username');
    $_SESSION['inputPass'] = filter_input(INPUT_POST, 'password');
//Select the user's first and last name
    $sqlQuery = "SELECT firstName, lastName FROM authorized WHERE username = '" . $_SESSION['inputUser'] .
            "' AND password = SHA1('" . $_SESSION['inputPass'] . "')";
//Store the results of the query in the $result variable
    $result = mysqli_query($sqlConnect, $sqlQuery) or die(mysqli_error($mysqli));
//If there is a single row in $result variable
    if (mysqli_num_rows($result) == 1) {
        //Set the local variables to contain first and last name
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['lastName'] = $row['lastName'];
        }
        //Create an authorization cookie with the current session id, this will last for 30 minutes
        setcookie("auth", session_id(), time() + 60 * 30, "/", "", 0);
        echo "<div>" . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . " Logged In</div>";
        //else user is not found in authorized table
    } else {
        //redirect back to login form if not authorized
        header("Location: userlogin.php");
        exit;
    }
}
?>

<!--Learned from W3 Schools https://www.w3schools.com/howto/howto_js_dropdown.asp-->
<!--script for dropdown menu-->
<script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    window.onclick = function (event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>

<html>
    <head>
        <title>Main Menu</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    <div id="title">
        <h1><strong>Main Menu</strong></h1>
        <h2>Click a button below to create a report</h2>
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Menu</button>
            <div id="myDropdown" class="dropdown-content">
                <a href="mainmenu.php">Main Menu</a>
                <a href='userProfile.php'>Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div><br>

    </div>

</head>
<body>
    <!--body items and submit buttons for different queries-->
    <form action="resultsPage.php" method="post">

        <h3>To Show all Authors in the Database:</h3>
        <input type="submit" name="authors" value="Authors"><br>
        <h3>To Show all Books in the Database:</h3>
        <input type="submit" name="books" value="Books"><br>
        <h3> To Show all Series:</h3>
        <input type="submit" name="combo" value="All">


        <h3>Select an Author from the List to Show all Books Written by them</h3>
        <?php
        //php block to fill out list of authors automatically from database
        $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "finalDB");
        $authorResults = mysqli_query($mysqli, "SELECT authorName FROM authors");
        if (mysqli_num_rows($authorResults) > 0) {
            $select = '<select name="selectAuthors">';
            while ($row = mysqli_fetch_array($authorResults)) {
                $select .= '<option value="' . $row['authorName'] . '">' . $row['authorName'] . '</option>';
            }
        }
        $select .= '</select><br><br>';
        echo $select;
        ?>
        <input type="submit" name="selectedAuthor" value="Submit">

        <h3>Select a Genre from the List to Show all Books in that Genre</h3>
        <select name="genres">
            <option value="Scifi">Science Fiction</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Children">Children</option>
        </select><br><br>
        <input type="submit" name="selectedGenre" value="Submit">
    </form><br><br>
</body>
<footer>
    <h4>Dylan Dufresne's COSC 213 Website Created in 2021</h4>
</footer>
</html>