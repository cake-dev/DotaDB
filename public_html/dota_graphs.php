<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('scripts/header.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AI Query</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="css/dota_db_style.css">
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
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title">Graphs</h2>
                        <div id="stuffContainer">
                            <p class="text-white mt-5 mb-5">DotaDB Graphs</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <h2 class="tm-block-title">Stuff Area</h2>
                        <!-- <textarea name="query_text" id="query_textarea" rows="3" cols="50" placeholder="Enter your query here" class="form-control validate" required></textarea>
                        <input type="submit" value="Submit" class="btn btn-primary btn-block text-uppercase" id="query_submit"> -->
                    </div>
                </div>
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <!-- <div id="result_table"></div> -->
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