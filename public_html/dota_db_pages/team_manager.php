<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../scripts/header.php');
    ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Team Manager Functions</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
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
        <div class="container mt-5">
            <div class="row tm-content-row">
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                        <h2 class="tm-block-title">List of Teams</h2>
                        <p class="text-white">Teams</p>
                        <form action="dota_query.php" method="post">
                            <select name="team_name" id="team_name" class="custom-select">
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
                            <input type="submit" name="getPlayersByTeamName" value="Team Roster" class="btn btn-primary btn-block text-uppercase">
                        </form>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row">
                <!-- <div class="tm-block-col tm-col-avatar">
                    <div class="tm-bg-primary-dark tm-block tm-block-avatar">
                        <h2 class="tm-block-title">Change Avatar</h2>
                        <div class="tm-avatar-container">
                            <img src="img/avatar.png" alt="Avatar" class="tm-avatar img-fluid mb-4" />
                            <a href="#" class="tm-avatar-delete-link">
                                <i class="far fa-trash-alt tm-product-delete-icon"></i>
                            </a>
                        </div>
                        <button class="btn btn-primary btn-block text-uppercase">
                            Upload New Photo
                        </button>
                    </div>
                </div> -->
                <!-- form for adding a new team -->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title">Add New Team </h2>
                        <form action="dota_query.php" method="post">
                            <div class="form-group col-lg-6">
                                <label for="team_id">Team ID:</label>
                                <!-- the team ID input starts from the highest current team_id -->
                                <?php
                                $link = mysqli_connect("localhost", "jb240893", "ooc3kei8bahwei6ooF9aihoo4eedoo", "jb240893")
                                    or die('Could not connect ');
                                $query = "SELECT MAX(team_id) FROM TEAM";
                                $result = mysqli_query($link, $query)
                                    or die("Query failed ");
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    foreach ($row as $col_value) {
                                        $col_value = $col_value + 1;
                                        echo "<label for='team_id' id='team_id_label'>(must be $col_value or greater)</label>";
                                        // echo "<input type='number' class='form-control' id='team_id' name='team_id' value='$col_value' required>";
                                    }
                                }
                                //Free result set
                                mysqli_free_result($result);

                                //close connection
                                mysqli_close($link);
                                ?>
                                <input type="number" class="form-control" id="team_id_input" name="team_id" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="team_name">Team Name:</label>
                                <input type="text" class="form-control" id="team_name" name="team_name" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="team_region">Team Region:</label>
                                <select id="team_region" name="team_region" class="form-control" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option value="North America">North America</option>
                                    <option value="South America">South America</option>
                                    <option value="Europe">Europe</option>
                                    <option value="China">China</option>
                                    <option value="Southeast Asia">Southeast Asia</option>
                                    <option value="CIS">CIS</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block text-uppercase">Add Team</button>
                        </form>
                    </div>
                </div>
                <!-- end new team form -->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-settings">
                        <h2 class="tm-block-title">Add New Player</h2>
                        <!-- form for adding a new player -->
                        <form action="dota_query.php" method="post" class="tm-signup-form row">
                            <div class="form-group col-lg-6">
                                <label for="team_id">Player Team ID (0 for no team):</label>
                                <input type="number" id="team_id" name="team_id" class="form-control validate">
                            </div>
                            <br>
                            <div class="form-group col-lg-6">
                                <label for="player_name">Player Name:</label>
                                <input type="text" id="player_name" name="player_name" class="form-control validate" required>
                            </div>
                            <br>
                            <div class="form-group col-lg-6">
                                <label for="gamer_name">Gamer Name:</label>
                                <input type="text" id="gamer_name" name="gamer_name" class="form-control validate" required>
                            </div>
                            <br>
                            <div class="form-group col-lg-6">
                                <label for="player_role">Player Role:</label>
                                <select id="player_role" name="player_role" class="custom-select">
                                    <option disabled selected value> -- select an option -- </option>
                                    <option value="Carry">Carry</option>
                                    <option value="Solo Middle">Solo Middle</option>
                                    <option value="Offlaner">Offlaner</option>
                                    <option value="Support">Support</option>
                                    <option value="Coach">Coach</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group col-lg-6">
                                <label for="player_country">Player Country:</label>
                                <input type="text" id="player_country" name="player_country" class="form-control validate">
                            </div>
                            <br>
                            <div class="form-group col-lg-6">
                                <label for="player_region">Player Region:</label>
                                <select id="player_region" name="player_region" class="custom-select">
                                    <option disabled selected value> -- select an option -- </option>
                                    <option value="North America">North America</option>
                                    <option value="South America">South America</option>
                                    <option value="Europe">Europe</option>
                                    <option value="China">China</option>
                                    <option value="Southeast Asia">Southeast Asia</option>
                                    <option value="CIS">CIS</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <br>

                            <input type="submit" value="Add Player" class="btn btn-primary btn-block text-uppercase">

                        </form>
                        <!-- end new player form -->
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title">Move Player </h2>
                        <!-- a form for moving a player to a new team, given the player name or gamer name, and the new team name or team id -->
                        <form action="../scripts/move_player.php" method="post">
                            <div class="form-group col-lg-6">
                                <label for="team_name_option" class=>Move to team:</label>
                                <select name="team_name" id="team_name" class="custom-select">
                                    <option value="team_name" id="team_name_option">Team Name</option>
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
                            </div>
                            <div class="form-group col-lg-6">
                                <select name="gamer_name" id="gamer_name" class="custom-select">
                                    <option value="gamer_name">Gamer Name</option>
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
                                <input type="submit" name="movePlayer" value="Move Player" class="btn btn-primary btn-block text-uppercase">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title">#TODO </h2>
                        <div id="stuffContainer">

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
        <script src="js/bootstrap.min.js"></script>
        <!-- https://getbootstrap.com/ -->
</body>

</html>