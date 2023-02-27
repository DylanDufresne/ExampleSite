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

<!--php script for the different queries-->
<?php
//connection to finalDB to be used for all queries
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "finalDB");

//if user selects show all authors
if (filter_input(INPUT_POST, "authors") == "Authors") {
    $authorResults = mysqli_query($mysqli, "SELECT * FROM authors");
    if (mysqli_num_rows($authorResults) > 0) {
        echo "<div id='title'><h1> List of all authors in the database</h1></div>";
        echo "<table>";
        echo "<th>Author Name</th> <th>Born</th><th>Death</th><th>Main Genre</th>";
        while ($row = mysqli_fetch_array($authorResults)) {
            echo "<tr><td>" . $row['authorName'] . "</td><td>" . $row['birth'] . "</td><td>" . $row['death'] . "</td><td>" . $row['mainGenre'] . "</td></tr>";
            $select .= '<option value="' . $row['authorName'] . '">' . $row['authorName'] . '</option>';
        }
        echo"</table><br><br>";
    }
}

//if user selects show all books
else if (filter_input(INPUT_POST, "books") == "Books") {
    $bookResults = mysqli_query($mysqli, "SELECT * FROM books");
    if (mysqli_num_rows($bookResults) > 0) {
        echo "<div id='title'><h1> List of all books in the database</h1></div>";
        echo "<table>";
        echo "<th>Book Name</th><th>Series Name</th><th>Genre</th><th>Author Name</th><th>Number of Pages</th><th>Published in</th>";
        while ($row = mysqli_fetch_array($bookResults)) {
            echo "<tr><td>" . $row['bookName'] . "</td><td>" . $row['seriesName'] . "</td><td>" . $row['genre'] . "</td><td>" . $row['authorName'] . "</td><td>" . $row['numberOfPages'] . "</td><td>" . $row['publishYear'] . "</td></tr>";
            $select .= '<option value="' . $row['authorName'] . '">' . $row['authorName'] . '</option>';
        }
        echo"</table><br><br>";
    }
}

//if user selects show all books from one author
else if (filter_input(INPUT_POST, "selectedAuthor") == "Submit") {
    $author = filter_input(INPUT_POST, "selectAuthors");
    $selectAuthorResults = mysqli_query($mysqli, "SELECT * FROM books WHERE authorName = '$author';");
    if (mysqli_num_rows($selectAuthorResults) > 0) {
        echo "<div id='title'><h1> List of all Books Written by " . $author . "</h1></div>";
        echo "<table>";
        echo "<th>Book Name</th><th>Series Name</th><th>Genre</th><th>Author Name</th><th>Number of Pages</th><th>Published in</th>";
        while ($row = mysqli_fetch_array($selectAuthorResults)) {
            echo "<tr><td>" . $row['bookName'] . "</td><td>" . $row['seriesName'] . "</td><td>" . $row['genre'] . "</td><td>" . $row['authorName'] . "</td><td>" . $row['numberOfPages'] . "</td><td>" . $row['publishYear'] . "</td></tr>";
        }
        echo"</table><br><br>";
    }
}

//if user selects show all books from genre
else if (filter_input(INPUT_POST, "selectedGenre") == "Submit") {
    $genre = filter_input(INPUT_POST, "genres");
    $selectGenreResults = mysqli_query($mysqli, "SELECT * FROM books WHERE genre = '$genre';");
    if (mysqli_num_rows($selectGenreResults) > 0) {
        echo "<div id='title'><h1> List of all Books in the " . $genre . " Genre</h1></div>";
        echo "<table>";
        echo "<th>Book Name</th><th>Series Name</th><th>Genre</th><th>Author Name</th><th>Number of Pages</th><th>Published in</th>";
        while ($row = mysqli_fetch_array($selectGenreResults)) {
            echo "<tr><td>" . $row['bookName'] . "</td><td>" . $row['seriesName'] . "</td><td>" . $row['genre'] . "</td><td>" . $row['authorName'] . "</td><td>" . $row['numberOfPages'] . "</td><td>" . $row['publishYear'] . "</td></tr>";
        }
        echo"</table><br><br>";
    }
}

//if user selects show all books with series info and author info taken from three different tables 
//(not really necessary but couldn't think of anything else to showcase joins)
else if (filter_input(INPUT_POST, "combo") == "All") {
    $author = filter_input(INPUT_POST, "selectAuthors");
    $sqlJoinResults = mysqli_query($mysqli, "SELECT bookName,series.seriesName,genre,authors.authorName,numberOfPages,series.numberOfBooks,publishYear,birth,death,mainGenre "
            . "from books "
            . "inner join authors on books.authorName= authors.authorName "
            . "inner join series on books.seriesName = series.seriesName");
    if (mysqli_num_rows($sqlJoinResults) > 0) {
        echo "<div id='title'><h1> List of all Series</h1></div>";
        echo "<table>";
        echo "<th>Book Name</th><th>Series Name</th><th>Genre</th><th>Author Name</th><th>Number of Pages</th><th>Books in Series</th><th>Published in</th><th>Born</th><th>Died</th><th>Main Genre</th>";
        while ($row = mysqli_fetch_array($sqlJoinResults)) {
            echo "<tr><td>" . $row['bookName'] . "</td><td>" . $row['seriesName'] . "</td><td>" . $row['genre'] . "</td><td>" . $row['authorName'] . "</td><td>" . $row['numberOfPages'] . "</td><td>" . $row['numberOfBooks'] . "</td><td>" . $row['publishYear'] . "</td><td>" . $row['birth'] . "</td><td>" . $row['death'] . "</td><td>" . $row['mainGenre'] . "</td></tr>";
        }
        echo"</table><br><br>";
    }
}
?>


<html>
    <head>
        <title>Results Page</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Menu</button>
        <div id="myDropdown" class="dropdown-content">
            <a href="mainmenu.php">Main Menu</a>
            <a href='userProfile.php'>Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div><br><br>
</head>
<footer>
    <h4>Dylan Dufresne's COSC 213 Website Created in 2021</h4>
</footer>
</html>
