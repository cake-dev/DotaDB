<?php
// resets the database
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../scripts/header.php");
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