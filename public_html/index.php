<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- a link to webpage.php -->
    <a href="dota_db_pages/index.php">Dashboard</a>
    <!-- a form with multiple buttons to perfrom a variety of sql queries -->
    <form action="scripts/dota_db_query.php" method="post">
        <label for="selected">Select all:</label>
        <input type="submit" name="selected" value="TEAM">
        <input type="submit" name="selected" value="PLAYER">
        <input type="submit" name="selected" value="TOURNAMENT">
        <input type="submit" name="selected" value="GAME">
        <input type="submit" name="selected" value="HERO">
        <input type="submit" name="selected" value="ITEM">
        <input type="submit" name="selected" value="ITEM_ABILITY">
        <input type="submit" name="selected" value="GAME_ITEMS">
        <input type="submit" name="selected" value="GAME_PERFORMANCE">
        <input type="submit" name="selected" value="TEAM_GAME">
        <input type="submit" name="selected" value="TOURNAMENT_GAMES">
        <input type="submit" name="selected" value="PLAYER_TEAM_HISTORY">
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
    <!-- a form for getting player info -->

    <form action="scripts/show_player_info.php" method="post">
        <select name="playerName" id="playerNameSelect">
            <option value="team_name">Player Name</option>
            <?php
            $link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
                or die('Could not connect ');
            $query = "SELECT gamer_name FROM PLAYER ORDER BY gamer_name ASC";
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
        <input type="submit" name="getPlayerInfo" value="Player Info">
    </form>

    <br>

    <!-- form for getting the teams with the highest earnings between two dates -->
    <form action="scripts/get_teams_highest_earnings.php" method="post">
        <label for="start">Start date:</label>
        <input type="date" id="start" name="date_start" value="2017-03-19" min="2017-03-19" max="2022-12-31">
        <label for="end">End date:</label>
        <input type="date" id="end" name="date_end" value="2017-03-20" min="2017-03-20" max="2022-12-31">
        <input type="submit" name="getTeamEarnings" value="Show Winnings">
    </form>

    <br>

    <!-- form for adding a new team -->
    <div class="container">
        <form action="scripts/add_new_team.php" method="post">
            <div class="form-group">
                <label for="team_id">Team ID:</label>
                <input type="number" class="form-control" id="team_id" name="team_id" required>
            </div>
            <div class="form-group">
                <label for="team_name">Team Name:</label>
                <input type="text" class="form-control" id="team_name" name="team_name" required>
            </div>
            <div class="form-group">
                <label for="team_region">Team Region:</label>
                <select id="team_region" name="team_region" class="form-control" required>
                    <option value="North America">North America</option>
                    <option value="South America">South America</option>
                    <option value="Europe">Europe</option>
                    <option value="China">China</option>
                    <option value="Southeast Asia">Southeast Asia</option>
                    <option value="CIS">CIS</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Team</button>
        </form>
    </div>
    <!-- end new team form -->

    <br>

    <!-- form for adding a new player -->
    <form action="scripts/add_new_player.php" method="post">
        <h3>Add new player</h3>
        <label for="team_id">Player Team ID:</label>
        <input type="number" id="team_id" name="team_id" required><br>

        <label for="player_name">Player Name:</label>
        <input type="text" id="player_name" name="player_name" required><br>
        <label for="gamer_name">Gamer Name:</label>
        <input type="text" id="gamer_name" name="gamer_name" required><br>
        <label for="player_role">Player Role:</label>
        <select id="player_role" name="player_role" required>
            <option value="Carry">Carry</option>
            <option value="Solo Middle">Solo Middle</option>
            <option value="Offlaner">Offlaner</option>
            <option value="Support">Support</option>
            <option value="Coach">Coach</option>
        </select><br>
        <label for="player_country">Player Country:</label>
        <input type="text" id="player_country" name="player_country"><br>
        <label for="player_region">Player Region:</label>
        <select id="player_region" name="player_region" required>
            <option value="North America">North America</option>
            <option value="South America">South America</option>
            <option value="Europe">Europe</option>
            <option value="China">China</option>
            <option value="Southeast Asia">Southeast Asia</option>
            <option value="CIS">CIS</option>
            <option value="Other">Other</option>
        </select><br>

        <input type="submit" value="Add Player">

    </form>
    <!-- end new player form -->
    <br>

    <!-- <form action="scripts/show_player_info.php" method="post">
        <input type="text" id="playerNameField" placeholder="Enter player name" name="playerName">
        <input type="submit" name="getPlayerInfo" value="Player Info">
    </form> -->

    <!-- <input type="text" id="playerName" placeholder="Enter player name">
    <button id="submit-btn" onclick="showPlayerInfo()" type="submit">Submit</button> -->

    <script>

        function showPlayerInfo() {
            var request = {
                playerName: $('#playerName').val()
            };
            $.ajax({
                url: "scripts/show_player_info.php",
                type: "POST",
                data: request,
                success: function () {
                    alert('Successfully connected to the server');
                },
                error: function () {
                    alert('Something went wrong');
                }
            });
        }

    </script>

</html>
<script>
</script>