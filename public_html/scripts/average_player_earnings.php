<!-- accepts player_role from the form and returns players with that role -->
<?php
include('header.php');
// connect to database
$link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
    or die('Could not connect ');

$team_name = $_POST['team_name'];
$query = "SELECT 
ROUND(
    CASE p.player_role 
        WHEN 'Carry' THEN 
            LEAST(t.team_winnings, (COUNT(p.player_id) * 0.2 * t.team_winnings)) / COUNT(p.player_id)
        WHEN 'Solo Middle' THEN 
            LEAST(t.team_winnings, (COUNT(p.player_id) * 0.15 * t.team_winnings)) / COUNT(p.player_id)
        WHEN 'Offlaner' THEN 
            LEAST(t.team_winnings, (COUNT(p.player_id) * 0.15 * t.team_winnings)) / COUNT(p.player_id)
        WHEN 'Support' THEN 
            LEAST(t.team_winnings, (COUNT(p.player_id) * 0.10 * t.team_winnings)) / COUNT(p.player_id)
        WHEN 'Coach' THEN 
            LEAST(t.team_winnings, (COUNT(p.player_id) * 0.05 * t.team_winnings)) / COUNT(p.player_id)
    END, 2
) AS player_earnings,
p.player_name
FROM 
TEAM t 
INNER JOIN PLAYER p ON t.team_id = p.team_id 
WHERE 
t.team_name = '$team_name'
GROUP BY 
p.player_name;
";

$result = mysqli_query($link, $query)
    or die("Query failed ");

echo "<h1>Player Earnings for $team_name</h1>";

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