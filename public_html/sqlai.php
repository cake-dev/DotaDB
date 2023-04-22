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
                        <h2 class="tm-block-title">Query with GPT</h2>
                        <div id="stuffContainer">
                            <p class="text-white mt-5 mb-5">AI powered natural language queries</p>
                            <p class="text-white mt-5 mb-5">Only SELECT type queries are currently supported</p>
                            <p class="text-white mt-5 mb-5">The preface to the completion query is: "A query to "<br>
                            User input is appended to the end of the preface<br><br>
                            <b>Example</b>: (A query to) get the players and teams where the team starts with the letter A</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <h2 class="tm-block-title">Input area</h2>
                        <textarea name="query_text" id="query_textarea" rows="4" cols="50" placeholder="Enter your query here" class="form-control validate" required></textarea>
                        <input type="submit" value="Submit" class="btn btn-primary btn-block text-uppercase" id="query_submit">
                    </div>
                </div>
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <div id="result_table"></div>
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

            const query_text = document.getElementById("query_textarea");
            const submitBtn = document.getElementById("query_submit");

            submitBtn.addEventListener("click", function () {
                OpenaiFetchAPI();
            });

            function OpenaiFetchAPI() {
                console.log("Calling GPT3")

                var url = "https://api.openai.com/v1/completions";
                var bearer = 'Bearer ' + 'API_KEY_HERE'
                const textareaValue = query_text.value;
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Authorization': bearer,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        "model": "text-davinci-003",
                        "prompt": "### MariaDB SQL tables, with their properties:\n#\n# GAME(game_id, game_winner, game_duration, game_date)\n# GAME_ITEMS(hero_id, game_id, item_id_1, item_id_2, item_id_3, item_id_4, item_id_5)\n# GAME_PERFORMANCE(g_kills, g_deaths, g_assists, g_xpm, g_gpm, g_last_hits, g_denies, g_hero_damage, g_hero_healing, g_level, g_win, player_id, game_id, hero_id)\n# HERO(hero_id, hero_name, hero_main_stat, str_base, str_gain, str_30, agi_base, agi_gain, agi_30, int_base, int_gain, int_30, attack_type, attack_range, damange_base, armor_base, move_speed_base, turn_rate)\n# ITEM(item_id, item_name, item_cost, str_bonus, agi_bonus, int_bonus, health_bonus, mana_bonus, hp_regen_bonus, mana_regen_bonus, armor_bonus, evasion_bonus, resistance_bonus, spell_amp_bonus, damage_bonus, attack_speed_bonus, move_speed_bonus, item_type)\n# ITEM_ABILITY(item_id, ability_1, ability_2, ability_3)\n# PLAYER(player_id, player_name, gamer_name, player_role, player_country, player_region, player_rank, team_id)\n# PLAYER_TEAM_HISTORY(player_id, team_id, join_date, leave_date)\n# TEAM(team_id, team_name, team_region, team_winnings)\n# TEAM_GAME(team1_id, team2_id, game_id)\n# TOURNAMENT(t_id, t_name, t_date, t_prize, t_winner)\n# TOURNAMENT_GAMES(t_id, game_id)\n#\n### A query to " + textareaValue + " \nSELECT ",
                        "temperature": 0,
                        "max_tokens": 150,
                        "top_p": 1,
                        "frequency_penalty": 0,
                        "presence_penalty": 0,
                        "stop": ["#", ";"]
                    })


                }).then(response => {

                    return response.json()

                }).then(data => {
                    console.log(data)
                    console.log(typeof data)
                    console.log(Object.keys(data))
                    // console.log(data['choices'][0].text)
                    var completed_query = "SELECT " + data['choices'][0].text
                    console.log(completed_query)

                    // send the value of completed_query to php
                    $.ajax({
                        type: "POST",
                        url: "dota_query.php",
                        data: {
                            completed_query: completed_query
                        },
                        success: function (data) {
                            // extract the table from the data
                            var table = data.substring(data.indexOf("<table"), data.indexOf("</table>") + 8);
                            console.log(table);
                            // show the query
                            alert("Your query is: \n" + completed_query);
                            // populates the table with the result data
                            $("#result_table").html(table);
                            // removes the underscores from the results table column titles and capitalize the first letter of each word
                            fixTable();
                        }
                    });

                })
                    .catch(error => {
                        console.log('Something bad happened ' + error)
                    });

            }

            // remove the underscores from the results table column titles and capitalize the first letter of each word
            function fixTable() {
                var table = document.getElementById("results_table");
                for (var i = 0, row; row = table.rows[i]; i++) {
                    for (var j = 0, col; col = row.cells[j]; j++) {
                        col.innerHTML = col.innerHTML.replace(/_/g, " ");
                        col.innerHTML = col.innerHTML.replace(/\w\S*/g, function (txt) {
                            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                        });
                    }
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