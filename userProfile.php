<?php
session_start();
?>
<!--Learned from W3 Schools https://www.w3schools.com/howto/howto_js_dropdown.asp-->
<!--script for the dropdown button-->
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
        <title>User Profile</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    <div id="title">
        <h1> <?php echo $_SESSION['firstName'] ?>'s Profile </h1>
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Menu</button>
            <div id="myDropdown" class="dropdown-content">
                <a href="mainmenu.php">Main Menu</a>
                <a href='userProfile.php'>Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div><br>
    </div><br>
</head>
<body>
    <div id='userInfo'>
        <table>
            <tr><td>First Name:</td><td><?php echo $_SESSION['firstName'] ?></td></tr>
            <tr><td>Last Name:</td><td><?php echo $_SESSION['lastName'] ?></td></tr>
            <tr><td>Username:</td><td><?php echo $_SESSION['inputUser'] ?></td></tr>
        </table>
    </div><br>
</body>
<footer>
    <h4>Dylan Dufresne's COSC 213 Website Created in 2021</h4>
</footer>
</html>

