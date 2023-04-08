<!-- accepts the button input and runs the query associated with the button -->
<?php
include('header.php');
// connect to database
$link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
    or die('Could not connect ');

if ($_POST['selected']) {
    $selected = $_POST['selected'];
    //perform SQL query for the table with the button name, based on button name
    $query = "SELECT * from " . $selected;

    $result = mysqli_query($link, $query)
        or die("Query failed ");
}

if ($_POST['team_name']) {
    $teamname = $_POST['team_name'];
    //perform SQL query for the team name to get the players on the team
    $query = "SELECT p.player_id,
    p.gamer_name,
    p.player_name,
    p.team_id,
    p.player_role,
    p.player_country,
    p.player_region
FROM PLAYER p
    INNER JOIN TEAM t ON p.team_id = t.team_id
WHERE t.team_name = '$teamname';";

    $result = mysqli_query($link, $query)
        or die("Query failed ");
    echo "query ok";
}


// print results in html with a nicely formatted bootstrap table with column headings
if ($teamname) {
    echo "<h1>The " . $teamname . " team roster</h1>";
}
if ($selected) {
    echo "<h1>The " . $selected . " table</h1>";
}

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