<!-- accepts input from the form with team name or team id, player name or gamer name, and then moves the player to the new team -->
<?php
include('header.php');
// connect to database
$link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
    or die('Could not connect ');

if ($_POST['team_name']) {
    $team_name = $_POST['team_name'];
}
if ($_POST['team_id']) {
    $team_id = $_POST['team_id'];
}
if ($_POST['player_name']) {
    $player_name = $_POST['player_name'];
}
if ($_POST['gamer_name']) {
    $gamer_name = $_POST['gamer_name'];
}
//perform SQL query 
if ($gamer_name) {
    $query = "UPDATE
    PLAYER
SET
    team_id = (
        SELECT
            team_id
        FROM
            TEAM
        WHERE
            team_name = '$team_name'
    )
WHERE
    gamer_name = '$gamer_name';";
}
if ($player_name) {
    $query = "UPDATE
    PLAYER
SET
    team_id = (
        SELECT
            team_id
        FROM
            TEAM
        WHERE
            team_name = '$team_name'
    )
WHERE
    player_name = '$player_name';";
}
$update = mysqli_query($link, $query)
    or die("Query failed ");

$selection = "SELECT * FROM PLAYER WHERE team_id = '$team_id'";

$result = mysqli_query($link, $selection)
    or die("Query failed ");

echo "<h1>Player Moved: '$gamer_name'</h1>";

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