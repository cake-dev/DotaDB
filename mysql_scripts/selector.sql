-- () select the players from a team by team name
-- SELECT p.player_id,
--     p.gamer_name,
--     p.player_name,
--     p.team_id,
--     p.player_role
-- FROM PLAYER p
--     INNER JOIN TEAM t ON p.team_id = t.team_id
-- WHERE t.team_name = 'Team Secret';
----------------------
-- () select the teams with the highest t_prize sum
-- select team_name,
--     sum(t_prize) as total_prize
-- from TEAM,
--     TOURNAMENT
-- WHERE TEAM.team_id = TOURNAMENT.t_winner
-- GROUP BY team_name
-- order by total_prize desc
-- limit 10;
----------------------
-- () select the teams with the most tournaments won
-- SELECT team_name,
--     count(t_winner) as total_wins
-- FROM TEAM,
--     TOURNAMENT
-- WHERE TEAM.team_id = TOURNAMENT.t_winner
-- GROUP BY team_name
-- order by total_wins desc
-- limit 10;
----------------------
-- () select the tournaments by date
-- SELECT t_name,
--     t_date
-- FROM TOURNAMENT
-- ORDER BY t_date desc
-- LIMIT 10;
--------------------------------
-- ()select the teams with the highest prize sum within a time period
-- SELECT team_name,
--     sum(t_prize) as total_prize
-- FROM TEAM,
--     TOURNAMENT
-- WHERE TEAM.team_id = TOURNAMENT.t_winner
--     AND TOURNAMENT.t_date BETWEEN '2019-01-01' AND '2019-12-31'
-- GROUP BY team_name
-- ORDER BY total_prize desc
-- LIMIT 10;
------------------------
-- -- () select the teams with less than 5 players
-- SELECT team_name, team_id
-- FROM TEAM
-- WHERE team_id IN (
--         SELECT team_id
--         FROM PLAYER
--         GROUP BY team_id
--         HAVING count(player_id) < 5
--     );
-- ------------------------
-- -- () get the tournaments won by teams with less than 5 players, grouped by team and t_id
-- SELECT t_name,
--     team_name
-- FROM TOURNAMENT,
--     TEAM
-- WHERE TOURNAMENT.t_winner = TEAM.team_id
--     AND TEAM.team_id IN (
--             SELECT team_id
--             FROM PLAYER
--             GROUP BY team_id
--             HAVING count(player_id) < 5
--         );
-- -- ------------------------
-- -- () get the teams and team id of teams with 5 or more players and 0 winnings
-- SELECT team_name,
--     team_id
-- FROM TEAM
-- WHERE team_id IN (
--         SELECT team_id
--         FROM PLAYER
--         GROUP BY team_id
--         HAVING count(player_id) >= 5
--     )
--     AND team_winnings = 0;
-- -- -- ------------------------
