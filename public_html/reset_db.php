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
                        <!-- php section -->
                        <?php
                        header("refresh:3;url=index.php");
                        // resets the database
                        // ini_set('display_errors', 1);
                        // ini_set('display_startup_errors', 1);
                        // error_reporting(E_ALL);
                        // connect to database
                        $link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
                            or die('Could not connect ');

                        echo "Resetting database...";
                        $query_fk0 = "SET FOREIGN_KEY_CHECKS = 0;";

                        // a query to delete data from all tables
                        $query_delete1 = "DELETE FROM TEAM;";
                        $query_delete2 = "DELETE FROM HERO;";
                        $query_delete3 = "DELETE FROM PLAYER;";
                        $query_delete4 = "DELETE FROM TOURNAMENT;";
                        $query_delete5 = "DELETE FROM ITEM;";
                        $query_delete6 = "DELETE FROM ITEM_ABILITY;";
                        $query_delete7 = "DELETE FROM GAME;";
                        $query_delete8 = "DELETE FROM GAME_PERFORMANCE;";
                        $query_delete9 = "DELETE FROM GAME_ITEMS;";
                        $query_delete10 = "DELETE FROM TEAM_GAME;";
                        $query_delete11 = "DELETE FROM TOURNAMENT_GAMES;";
                        $query_delete12 = "DELETE FROM PLAYER_TEAM_HISTORY;";

                        // concat and execute query as multi query
                        $query_delete = $query_delete1 . $query_delete2 . $query_delete3 . $query_delete4 . $query_delete5 . $query_delete6 . $query_delete7 . $query_delete8 . $query_delete9 . $query_delete10 . $query_delete11 . $query_delete12;

                        echo "Data deleted from tables...";

                        $query_insert_team = file_get_contents("sql_data/team_insert.sql");
                        $query_insert_hero = file_get_contents("sql_data/hero_insert.sql");
                        $query_insert_player = file_get_contents("sql_data/player_insert.sql");
                        $query_insert_tournament = file_get_contents("sql_data/tournament_insert.sql");
                        $query_insert_item = file_get_contents("sql_data/item_insert.sql");
                        $query_insert_item_ability = file_get_contents("sql_data/item_ability_insert.sql");
                        $query_insert_game = file_get_contents("sql_data/game_insert.sql");
                        $query_insert_game_performance = file_get_contents("sql_data/game_performance_insert.sql");
                        $query_insert_game_items = file_get_contents("sql_data/game_item_insert.sql");
                        $query_insert_team_game = file_get_contents("sql_data/team_game_insert.sql");
                        $query_insert_tournament_games = file_get_contents("sql_data/tournament_game_insert.sql");
                        $query_insert_player_team_history = file_get_contents("sql_data/team_history_insert.sql");
                        $query_update_winnings = file_get_contents("sql_data/update_winnings.sql");

                        $query_insert = $query_insert_team . $query_insert_hero . $query_insert_player . $query_insert_tournament . $query_insert_item . $query_insert_item_ability . $query_insert_game . $query_insert_game_performance . $query_insert_game_items . $query_insert_team_game . $query_insert_tournament_games . $query_insert_player_team_history . $query_update_winnings;

                        echo "Data inserted into tables...";

                        $query_fk1 = "SET FOREIGN_KEY_CHECKS = 1;";

                        // concat and execute all queries as multi query
                        $query = $query_fk0 . $query_delete . $query_insert . $query_fk1;
                        $result = mysqli_multi_query($link, $query)
                            or die("Query failed ");
                        // clear results
                        while (mysqli_more_results($link)) {
                            mysqli_next_result($link);
                            if ($result = mysqli_store_result($link)) {
                                mysqli_free_result($result);
                            }
                        }

                        echo "Database reset complete.";

                        // end php
                        
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