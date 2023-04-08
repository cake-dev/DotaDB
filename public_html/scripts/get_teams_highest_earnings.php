<?php
include('header.php');
// connect to database
$link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
    or die('Could not connect ');

$date_start = $_POST['date_start'];
$date_end = $_POST['date_end'];
//perform SQL query for the table with the button name, based on button name
$query = "SELECT team_name, sum(t_prize) as total_prize FROM TEAM, TOURNAMENT WHERE TEAM.team_id = TOURNAMENT.t_winner AND TOURNAMENT.t_date BETWEEN '$date_start' AND '$date_end' GROUP BY team_name ORDER BY total_prize desc LIMIT 10;";

$result = mysqli_query($link, $query)
    or die("Query failed ");

echo "<h1>The Team Earnings table</h1>";

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