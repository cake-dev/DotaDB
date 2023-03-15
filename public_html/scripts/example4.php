</head>

<body>
    <h1>Delete Test Results</h1>
    <?php
    include 'header.php';

    // create short variable names
    $deletefield1 = $_POST["deletefield1"];


    //use trim function to strip whitespace inadvertently entered 
    $deletefield1 = trim($deletefield1);

    // show the data to be inserted in a formatted table
    echo "Data to be deleted: <br>";
    echo " <table border='1'>\n";
    echo "\t<tr>\n";
    echo "\t\t<td>name</td>\n";
    echo "\t</tr>\n";
    echo "\t<tr>\n";
    echo "\t\t<td>$deletefield1</td>\n";
    echo "\t</tr>\n";
    echo "</table>\n";


    // check that all fields have been entered
    if ((!$deletefield1)) {
        echo 'You have not entered insert details.  Please go back and try again.';
        exit;
    }

    // connect to database
    $link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
        or die('Could not connect ');
    echo "Connected successfully <br>";

    // insert new data into table
    $result = mysqli_query($link, "DELETE FROM PLAYER WHERE player_name = '$deletefield1'")
        or die("Query failed ");
    echo "query ok\n";

    // query table to show new data inserted
    $query = "SELECT * from PLAYER ORDER BY player_id DESC";
    $result = mysqli_query($link, $query)
        or die("Query failed ");
    echo "query ok\n";

    $num_results = mysqli_num_rows($result);

    echo '<p>New number of rows in table: ' . $num_results . '</p>';

    // print results in html with a nicely formatted bootstrap table with column headings
    echo "<h1>the Player table</h1>";

    echo " <table class='table table-striped table-bordered table-hover table-condensed'>\n";
    echo "\t<tr>\n";
    while ($fieldinfo = $result->fetch_field()) {
        echo "\t\t<td>$fieldinfo->name</td>\n";
        //echo"";
    }
    echo "\t</tr>\n";

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        echo "\t<tr>\n";
        foreach ($row as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";

    //print column headings
    echo "\t\n";
    while ($fieldinfo = $result->fetch_field()) {
        echo "\t\n";
        printf($fieldinfo->name);
        echo "";
    }
    echo "\t\n";

    // show results of table with new data inserted
    echo " <table border='1'>\n";
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($row as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";

    //Free result set
    mysqli_free_result($result);

    //close connection
    mysqli_close($link);

    ?>
</body>

</html>