<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('scripts/header.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dota DB Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="css/dota_db_style.css">
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
            <!-- <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
                </div>
            </div> -->
            <!-- row -->
            <div class="row tm-content-row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title">Welcome </h2>
                        <div id="stuffContainer">
                            <p class="text-white mt-5 mb-5">Welcome to the Dota DB Dashboard. Here you can view all the tables in the database, as well as a list of recent games.</p>
                            <p class="text-white mt-5 mb-5">Additional functions are found through the functions tab at the top.</p>
                            <p class="text-white mt-5 mb-5">The database can be reset using the reset button above.  After resetting, the newly reset data can be viewed through the table buttons.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <h2 class="tm-block-title">All Tables</h2>
                        <div class="tm-notification-items">
                            <form action="dota_query.php" method="post">
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="TEAM" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="PLAYER" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="TOURNAMENT" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="GAME" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="HERO" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="ITEM" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="ITEM_ABILITY" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="GAME_PERFORMANCE" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="GAME_ITEMS" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="TEAM_GAME" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="TOURNAMENT_GAMES" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/db_icon.png" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <div class="text-center">
                                            <input type="submit" name="selected" value="PLAYER_TEAM_HISTORY" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Recent Games</h2>
                        <?php
                        include('header.php');
                        // connect to database
                        $link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
                            or die('Could not connect ');

                        // selects the most recent 100 games with the team names and game duration
                        $query = "SELECT g.game_id, g.game_date, tw.team_name AS winner_name, tl.team_name AS loser_name, g.game_duration
                        FROM GAME g
                        JOIN TEAM tw ON g.game_winner = tw.team_id
                        JOIN (
                            SELECT tg.game_id, t.team_id AS team_id
                            FROM TEAM_GAME tg
                            JOIN TEAM t ON t.team_id = tg.team1_id
                            UNION ALL
                            SELECT tg.game_id, t.team_id AS team_id
                            FROM TEAM_GAME tg
                            JOIN TEAM t ON t.team_id = tg.team2_id
                        ) tg ON g.game_id = tg.game_id
                        JOIN TEAM tl ON tl.team_id = (
                            CASE
                                WHEN g.game_winner = tg.team_id THEN (
                                    SELECT team_id
                                    FROM (
                                        SELECT tg.game_id, t.team_id AS team_id
                                        FROM TEAM_GAME tg
                                        JOIN TEAM t ON t.team_id = tg.team1_id
                                        UNION ALL
                                        SELECT tg.game_id, t.team_id AS team_id
                                        FROM TEAM_GAME tg
                                        JOIN TEAM t ON t.team_id = tg.team2_id
                                    ) t2
                                    WHERE t2.game_id = g.game_id AND t2.team_id != g.game_winner
                                    LIMIT 1
                                )
                            END
                        )
                        ORDER BY g.game_id DESC
                        LIMIT 100;
                        ";

                        $result = mysqli_query($link, $query)
                            or die("Query failed ");

                        echo " <table id='games_table' class='table table-striped table-bordered table-hover table-condensed'>\n";
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

            // replace the table headings with proper names
            $(document).ready(function () {
                var table = document.getElementById("games_table");
                var header = table.rows[0];
                var cells = header.cells;
                cells[0].innerHTML = "Game ID";
                cells[1].innerHTML = "Game Date";
                cells[2].innerHTML = "Winner";
                cells[3].innerHTML = "Loser";
                cells[4].innerHTML = "Game Duration";
                // add m to the game duration column values
                for (var i = 1, row; row = table.rows[i]; i++) {
                    var cell = row.cells[4];
                    cell.innerHTML = cell.innerHTML + "m";
                }
                // remove the time from the game date column values
                for (var i = 1, row; row = table.rows[i]; i++) {
                    var cell = row.cells[1];
                    cell.innerHTML = cell.innerHTML.substring(0, 10);
                }
            });
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
    <script>
        // Chart.defaults.global.defaultFontColor = 'white';
        // let ctxLine,
        //     ctxBar,
        //     ctxPie,
        //     optionsLine,
        //     optionsBar,
        //     optionsPie,
        //     configLine,
        //     configBar,
        //     configPie,
        //     lineChart;
        // barChart, pieChart;
        // // DOM is ready
        // $(function () {
        //     drawLineChart(); // Line Chart
        //     drawBarChart(); // Bar Chart
        //     drawPieChart(); // Pie Chart

        //     $(window).resize(function () {
        //         updateLineChart();
        //         updateBarChart();
        //     });
        // })
    </script>
</body>

</html>