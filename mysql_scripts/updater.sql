-- () change nulls to 0 in team
-- UPDATE TEAM
-- SET team_winnings = 0
-- WHERE team_winnings IS NULL;
-- ----------------------
-- () drop the players that are on a team with less than 5 players
-- DELETE FROM PLAYER
-- WHERE team_id IN (
--         SELECT team_id
--         FROM TEAM
--         WHERE team_id IN (
--                 SELECT team_id
--                 FROM PLAYER
--                 GROUP BY team_id
--                 HAVING count(player_id) < 5
--             )
--     );
-- ----------------------
-- () drop the teams with less than 5 players
-- DELETE FROM TEAM
-- WHERE team_id IN (
--         SELECT team_id
--         FROM PLAYER
--         GROUP BY team_id
--         HAVING count(player_id) < 5
--     );
----------------------
-- UPDATE TOURNAMENT SET t_winner = 78 WHERE t_date= '2017-03-19';
-- UPDATE TOURNAMENT SET t_winner = 12 WHERE t_date= '2017-04-09';
-- UPDATE TOURNAMENT SET t_winner = 20 WHERE t_date= '2017-04-14';
-- UPDATE TOURNAMENT SET t_winner = 15 WHERE t_date= '2017-06-08';
-- UPDATE TOURNAMENT SET t_winner = 54 WHERE t_date= '2017-08-22';
-- UPDATE TOURNAMENT SET t_winner = 78 WHERE t_date= '2017-08-23';
-- UPDATE TOURNAMENT SET t_winner = 7 WHERE t_date= '2017-10-29';
-- UPDATE TOURNAMENT SET t_winner = 18 WHERE t_date= '2017-11-01';
-- UPDATE TOURNAMENT SET t_winner = 68 WHERE t_date= '2017-11-02';
-- UPDATE TOURNAMENT SET t_winner = 64 WHERE t_date= '2018-03-14';
-- UPDATE TOURNAMENT SET t_winner = 56 WHERE t_date= '2018-04-09';
-- UPDATE TOURNAMENT SET t_winner = 73 WHERE t_date= '2018-06-02';
-- UPDATE TOURNAMENT SET t_winner = 18 WHERE t_date= '2018-06-25';
-- UPDATE TOURNAMENT SET t_winner = 64 WHERE t_date= '2018-10-25';
-- UPDATE TOURNAMENT SET t_winner = 4 WHERE t_date= '2018-12-30';
-- UPDATE TOURNAMENT SET t_winner = 5 WHERE t_date= '2019-02-26';
-- UPDATE TOURNAMENT SET t_winner = 64 WHERE t_date= '2019-03-20';
-- UPDATE TOURNAMENT SET t_winner = 11 WHERE t_date= '2019-09-15';
-- UPDATE TOURNAMENT SET t_winner = 28 WHERE t_date= '2019-09-24';
-- UPDATE TOURNAMENT SET t_winner = 48 WHERE t_date= '2020-04-05';
-- UPDATE TOURNAMENT SET t_winner = 78 WHERE t_date= '2020-05-21';
-- UPDATE TOURNAMENT SET t_winner = 54 WHERE t_date= '2020-05-22';
-- UPDATE TOURNAMENT SET t_winner = 42 WHERE t_date= '2020-06-15';
-- UPDATE TOURNAMENT SET t_winner = 68 WHERE t_date= '2020-07-25';
-- UPDATE TOURNAMENT SET t_winner = 59 WHERE t_date= '2020-08-18';
-- UPDATE TOURNAMENT SET t_winner = 55 WHERE t_date= '2020-10-21';
-- UPDATE TOURNAMENT SET t_winner = 70 WHERE t_date= '2020-10-27';
-- UPDATE TOURNAMENT SET t_winner = 72 WHERE t_date= '2020-11-08';
-- UPDATE TOURNAMENT SET t_winner = 16 WHERE t_date= '2020-12-10';
-- UPDATE TOURNAMENT SET t_winner = 19 WHERE t_date= '2020-12-30';
-- UPDATE TOURNAMENT SET t_winner = 61 WHERE t_date= '2021-02-02';
-- UPDATE TOURNAMENT SET t_winner = 34 WHERE t_date= '2021-03-25';
-- UPDATE TOURNAMENT SET t_winner = 34 WHERE t_date= '2021-04-30';
-- UPDATE TOURNAMENT SET t_winner = 59 WHERE t_date= '2021-06-28';
-- UPDATE TOURNAMENT SET t_winner = 49 WHERE t_date= '2021-07-03';
-- UPDATE TOURNAMENT SET t_winner = 66 WHERE t_date= '2021-07-06';
-- UPDATE TOURNAMENT SET t_winner = 17 WHERE t_date= '2021-07-08';
-- UPDATE TOURNAMENT SET t_winner = 74 WHERE t_date= '2021-08-26';
-- UPDATE TOURNAMENT SET t_winner = 56 WHERE t_date= '2021-08-28';
-- UPDATE TOURNAMENT SET t_winner = 59 WHERE t_date= '2021-09-06';
-- UPDATE TOURNAMENT SET t_winner = 58 WHERE t_date= '2021-09-25';
-- UPDATE TOURNAMENT SET t_winner = 69 WHERE t_date= '2021-10-04';
-- UPDATE TOURNAMENT SET t_winner = 64 WHERE t_date= '2022-01-18';
-- UPDATE TOURNAMENT SET t_winner = 56 WHERE t_date= '2022-01-22';
-- UPDATE TOURNAMENT SET t_winner = 26 WHERE t_date= '2022-03-06';
-- UPDATE TOURNAMENT SET t_winner = 18 WHERE t_date= '2022-03-21';
-- UPDATE TOURNAMENT SET t_winner = 34 WHERE t_date= '2022-05-17';
-- UPDATE TOURNAMENT SET t_winner = 55 WHERE t_date= '2022-06-20';
-- UPDATE TOURNAMENT SET t_winner = 65 WHERE t_date= '2022-11-29';
-- UPDATE TOURNAMENT SET t_winner = 15 WHERE t_date= '2022-11-30';
-- UPDATE TOURNAMENT SET t_winner = 43 WHERE t_date= '2022-12-04';
-- UPDATE TOURNAMENT SET t_winner = 47 WHERE t_date= '2022-12-16';
----------------------------
-- -- () using the GAME and TOURNAMENT table, match the tournament_id to game_date, and use that game_id to insert the game_id, t_id values into the TOURNAMENT_GAME table
-- INSERT INTO
--     TOURNAMENT_GAMES (game_id, t_id)
-- SELECT
--     game_id,
--     t_id
-- FROM
--     GAME,
--     TOURNAMENT
-- WHERE
--     game_date = t_date;
-- ----------------------------
-- () a query to move a player to a new team, given a team name and gamer name
UPDATE
    PLAYER
SET
    team_id = (
        SELECT
            team_id
        FROM
            TEAM
        WHERE
            team_name = 'NO_TEAM'
    )
WHERE
    gamer_name = 'BullyHunter';
-- ----------------------------