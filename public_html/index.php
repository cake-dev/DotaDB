<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- a form with multiple buttons to perfrom a variety of sql queries -->
    <form action="scripts/dota_db_query.php" method="post">
        <input type="submit" name="selected" value="TEAM">
        <input type="submit" name="selected" value="PLAYER">
        <input type="submit" name="selected" value="TOURNAMENT">
        <input type="submit" name="selected" value="HERO">
        <input type="submit" name="selected" value="GAME">
    </form>
    <br>
    <form action="scripts/dota_db_query.php" method="post">
        <select name="team_name" id="team_name">
            <option value="team_name">Team Name</option>
            <?php
            $link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
                or die('Could not connect ');
            $query = "SELECT team_name FROM TEAM ORDER BY team_name ASC";
            $result = mysqli_query($link, $query)
                or die("Query failed ");
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                foreach ($row as $col_value) {
                    echo "<option value='$col_value'>$col_value</option>";
                }
            }
            //Free result set
            mysqli_free_result($result);

            //close connection
            mysqli_close($link);
            ?>
        </select>
        <input type="submit" name="getPlayersByTeamName" value="Team Roster">
    </form>
    <br>

</html>
<script>
</script>