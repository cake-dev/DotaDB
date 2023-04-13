<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include('../scripts/header.php');
  ?>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Analyst Functions</title>
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
      <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
        <div class="tm-bg-primary-dark tm-block tm-block-taller">
          <h2 class="tm-block-title">Players by Role</h2>
          <form action="dota_query.php" method="post">
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
            <button type="submit" class="btn btn-primary btn-block text-uppercase">View Players</button>
          </form>
        </div>
      </div>
      <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
        <div class="tm-bg-primary-dark tm-block tm-block-taller">
          <h2 class="tm-block-title">Player Earnings</h2>
          <form action="dota_query.php" method="post">
            <div class="form-group col-lg-6">
              <label for="player_role">Team Name:</label>
              <select name="team_name_earnings" id="team_name" class="custom-select">
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
            </div>
            <button type="submit" class="btn btn-primary btn-block text-uppercase">View Player Earnings</button>
          </form>
        </div>
      </div>
      <!-- <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
        <div class="tm-bg-primary-dark tm-block tm-block-product-categories">

        </div>
      </div> -->
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

  <script src="js/jquery-3.3.1.min.js"></script>
  <!-- https://jquery.com/download/ -->
  <script src="js/bootstrap.min.js"></script>
  <!-- https://getbootstrap.com/ -->
  <script>
    $(function () {
      $(".tm-product-name").on("click", function () {
        window.location.href = "edit-product.html";
      });
    });
  </script>
</body>

</html>