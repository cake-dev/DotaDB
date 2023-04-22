<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('scripts/header.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Query Result</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
    Product Admin CSS Template
    https://templatemo.com/tm-524-product-admin
    -->
</head>


<body id="reportsPage">
    <div class="" id="home">
        <!--Navigation bar-->
        <div id="nav-placeholder">

        </div>

        <script>
            $(document).ready(function () {
                $('#nav-placeholder').load('nav.html');
            });
        </script>
        <!--end of Navigation bar-->
        <div class="container">
            <div class="row tm-content-row">
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title" id="table_title">Query Result</h2>
                        <?php
                        // connect to database
                        $link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
                            or die('Could not connect ');

                        if ($_POST['selected']) {
                            $selected = $_POST['selected'];
                            //perform SQL query for the table with the button name, based on button name
                            $query = "SELECT * from " . $selected;
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

                        }

                        if ($_POST['team_region']) {
                            $team_id = mysqli_real_escape_string($link, $_POST['team_id']);
                            $team_name = mysqli_real_escape_string($link, $_POST['team_name']);
                            $team_region = mysqli_real_escape_string($link, $_POST['team_region']);
                            //perform SQL query for the table with the button name, based on button name
                            $query = "INSERT INTO TEAM (team_id, team_name, team_region) VALUES ('$team_id', '$team_name', '$team_region')";
                            $selection = "SELECT * FROM TEAM WHERE team_id = '$team_id'";

                            $insert = mysqli_query($link, $query)
                                or die("Query failed ");

                            $result = mysqli_query($link, $selection)
                                or die("Query failed ");
                        }

                        if ($_POST['gamer_name']) {
                            if ($_POST['team_id']) {
                                $team_id = $_POST['team_id'];
                            } else {
                                $team_id = 0;
                            }
                            $player_name = mysqli_real_escape_string($link, $_POST['player_name']);
                            $gamer_name = mysqli_real_escape_string($link, $_POST['gamer_name']);
                            $player_role = mysqli_real_escape_string($link, $_POST['player_role']);
                            $player_country = mysqli_real_escape_string($link, $_POST['player_country']);
                            $player_region = mysqli_real_escape_string($link, $_POST['player_region']);
                            // sanitize inputs
                            //perform SQL query for the table with the button name, based on button name
                            $query = "INSERT INTO PLAYER (team_id, player_name, gamer_name, player_role, player_country, player_region) VALUES ('$team_id', '$player_name', '$gamer_name', '$player_role', '$player_country', '$player_region')";
                            $selection = "SELECT * FROM PLAYER WHERE gamer_name = '$gamer_name'";

                            $insert = mysqli_query($link, $query)
                                or die("Query failed ");

                            $result = mysqli_query($link, $selection)
                                or die("Query failed ");
                        }

                        if ($_POST['player_role'] && !$_POST['team_id']) {
                            $player_role = $_POST['player_role'];
                            //perform SQL query for the table with the button name, based on button name
                            $query = "SELECT * FROM PLAYER WHERE player_role = '$player_role'";
                        }

                        if ($_POST['team_name_earnings']) {
                            $team_name = $_POST['team_name_earnings'];
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


                        }

                        if ($_POST['start_date']) {
                            $start_date = $_POST['start_date'];
                            $end_date = $_POST['end_date'];
                            $query = "SELECT
                                item_name,
                                count(item_name) as total_uses
                            FROM
                                ITEM,
                                GAME_ITEMS,
                                GAME
                            WHERE
                                ITEM.item_id in (GAME_ITEMS.item_id_1, GAME_ITEMS.item_id_2, GAME_ITEMS.item_id_3, GAME_ITEMS.item_id_4, GAME_ITEMS.item_id_5)
                                AND GAME_ITEMS.game_id = GAME.game_id
                                AND GAME.game_date BETWEEN '$start_date' AND '$end_date'
                            GROUP BY
                                item_name
                            ORDER BY
                                total_uses desc
                            LIMIT
                                10;";
                        }

                        if ($_POST['player_id_delete']) {
                            $player_id = $_POST['player_id_delete'];
                            $query_fk0 = "SET FOREIGN_KEY_CHECKS = 0";
                            $execute_fk0 = mysqli_query($link, $query_fk0)
                                or die("Query failed ");

                            $query2 = "DELETE FROM PLAYER WHERE player_id = $player_id";

                            $execute2 = mysqli_query($link, $query2)
                                or die("Query failed ");

                            $query_fk1 = "SET FOREIGN_KEY_CHECKS = 1";
                            $execute_fk1 = mysqli_query($link, $query_fk1)
                                or die("Query failed ");
                        }

                        if ($_POST['completed_query']) {
                            $query = $_POST['completed_query'];
                            //echo $query;
                        }

                        
                        // handles all queries except for the delete query
                        if (!$_POST['player_id_delete']) {
                            $result = mysqli_query($link, $query)
                                or die("Query failed ");
                        }


                        // print results in html with a nicely formatted bootstrap table with column headings
                        if ($teamname) {
                            echo "<script>document.getElementById('table_title').innerHTML = 'Players on " . $teamname . "';</script>";
                        }
                        if ($selected) {
                            echo "<script>document.getElementById('table_title').innerHTML = '" . $selected . "';</script>";
                        }
                        if ($team_id) {
                            echo "<script>document.getElementById('table_title').innerHTML = '" . $team_name . " added to TEAM';</script>";
                        }
                        if ($gamer_name) {
                            echo "<script>document.getElementById('table_title').innerHTML = '" . $gamer_name . " added to PLAYER';</script>";
                        }
                        // handles all queries except for the delete query
                        if (!$_POST['player_id_delete']) {
                            echo " <table id='results_table' class='table table-striped table-bordered table-hover table-condensed'>\n";
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
                        }

                        //close connection
                        mysqli_close($link);

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--footer area-->
        <div id="footer-placeholder">

        </div>

        <script>
            $(document).ready(function () {
                $('#footer-placeholder').load("footer.html");
            });

            // remove the underscores from the results table column titles and capitalize the first letter of each word
            var table = document.getElementById("results_table");
            for (var i = 0, row; row = table.rows[i]; i++) {
                for (var j = 0, col; col = row.cells[j]; j++) {
                    col.innerHTML = col.innerHTML.replace(/_/g, " ");
                    col.innerHTML = col.innerHTML.replace(/\w\S*/g, function (txt) {
                        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                    });
                }
            }
        </script>
        <!--end of footer area-->
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="js/tooplate-scripts.js"></script>
</body>

</html>