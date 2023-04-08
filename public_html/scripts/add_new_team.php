<?php
include('header.php');
// connect to database
$link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
    or die('Could not connect ');

$team_id = $_POST['team_id'];
$team_name = $_POST['team_name'];
$team_region = $_POST['team_region'];
//perform SQL query for the table with the button name, based on button name
$query = "INSERT INTO TEAM (team_id, team_name, team_region) VALUES ('$team_id', '$team_name', '$team_region')";
$selection = "SELECT * FROM TEAM WHERE team_id = '$team_id'";

$insert = mysqli_query($link, $query)
    or die("Query failed ");

$result = mysqli_query($link, $selection)
    or die("Query failed ");

echo "<h1>New Team added:</h1>";

echo " <table class='table table-striped table-bordered table-hover table-condensed'>\n";
// prints the column headings
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

//Free result set
mysqli_free_result($result);

//close connection
mysqli_close($link);

?>