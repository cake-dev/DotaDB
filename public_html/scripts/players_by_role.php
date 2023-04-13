<!-- accepts player_role from the form and returns players with that role -->
<?php
include('header.php');
// connect to database
$link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
    or die('Could not connect ');

$player_role = $_POST['player_role'];
$query = "SELECT * FROM PLAYER WHERE player_role = '$player_role'";

$result = mysqli_query($link, $query)
    or die("Query failed ");

echo "<h1>Players with the role of: '$player_role'</h1>";

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