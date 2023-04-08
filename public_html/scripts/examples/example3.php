</head>

<body>
    <h1>Insert Test Results</h1>
    <?php

    // create short variable names
    $insertfield1 = $_POST["insertfield1"];
    $insertfield2 = $_POST["insertfield2"];
    $insertfield3 = $_POST["insertfield3"];
    $insertfield4 = $_POST["insertfield4"];
    $insertfield5 = $_POST["insertfield5"];
    $insertfield6 = $_POST["insertfield6"];
    $insertfield7 = $_POST["insertfield7"];

    //use trim function to strip whitespace inadvertently entered 
    $insertfield1 = trim($insertfield1);
    $insertfield2 = trim($insertfield2);
    $insertfield3 = trim($insertfield3);
    $insertfield4 = trim($insertfield4);
    $insertfield5 = trim($insertfield5);
    $insertfield6 = trim($insertfield6);
    $insertfield7 = trim($insertfield7);

    // show the data to be inserted in a formatted table
    echo "Data to be inserted: <br>";
    echo " <table border='1'>\n";
    echo "\t<tr>\n";
    echo "\t\t<td>name</td>\n";
    echo "\t\t<td>gamer name</td>\n";
    echo "\t\t<td>role</td>\n";
    echo "\t\t<td>country</td>\n";
    echo "\t\t<td>region</td>\n";
    echo "\t\t<td>rank</td>\n";
    echo "\t\t<td>team id</td>\n";
    echo "\t</tr>\n";
    echo "\t<tr>\n";
    echo "\t\t<td>$insertfield1</td>\n";
    echo "\t\t<td>$insertfield2</td>\n";
    echo "\t\t<td>$insertfield3</td>\n";
    echo "\t\t<td>$insertfield4</td>\n";
    echo "\t\t<td>$insertfield5</td>\n";
    echo "\t\t<td>$insertfield6</td>\n";
    echo "\t\t<td>$insertfield7</td>\n";
    echo "\t</tr>\n";
    echo "</table>\n";


    // check that all fields have been entered
    if ((!$insertfield1) or (!$insertfield2) or (!$insertfield3)) {
        echo 'You have not entered insert details.  Please go back and try again.';
        exit;
    }

    // connect to database
    $link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
        or die('Could not connect ');
    echo "Connected successfully <br>";

    // insert new data into table
    $result = mysqli_query($link, "INSERT INTO PLAYER (player_name, gamer_name, player_role, player_country, player_region, player_rank, team_id) VALUES ('$insertfield1', '$insertfield2', '$insertfield3', '$insertfield4', '$insertfield5', '$insertfield6', '$insertfield7')")
        or die("Query failed ");
    echo "query ok\n";

    // query table to show new data inserted
    $query = "SELECT * from PLAYER ORDER BY player_id DESC";
    $result = mysqli_query($link, $query)
        or die("Query failed ");
    echo "query ok\n";

    $num_results = mysqli_num_rows($result);

    echo '<p>New number of rows in table: ' . $num_results . '</p>';

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