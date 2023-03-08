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