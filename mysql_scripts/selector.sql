-- -- () select the players from a team by team name
-- -- SELECT p.player_id,
-- --     p.gamer_name,
-- --     p.player_name,
-- --     p.team_id,
-- --     p.player_role
-- -- FROM PLAYER p
-- --     INNER JOIN TEAM t ON p.team_id = t.team_id
-- -- WHERE t.team_name = 'Team Secret';
-- ----------------------
-- -- () select the teams with the highest t_prize sum
-- select
--     team_name,
--     sum(t_prize) as total_prize
-- from
--     TEAM,
--     TOURNAMENT
-- WHERE
--     TEAM.team_id = TOURNAMENT.t_winner
-- GROUP BY
--     team_name
-- order by
--     total_prize desc
-- limit
--     10;
-- ----------------------
-- -- () select the teams with the most tournaments won
-- -- SELECT team_name,
-- --     count(t_winner) as total_wins
-- -- FROM TEAM,
-- --     TOURNAMENT
-- -- WHERE TEAM.team_id = TOURNAMENT.t_winner
-- -- GROUP BY team_name
-- -- order by total_wins desc
-- -- limit 10;
-- ----------------------
-- -- () select the tournaments by date
-- -- SELECT t_name,
-- --     t_date
-- -- FROM TOURNAMENT
-- -- ORDER BY t_date desc
-- -- LIMIT 10;
-- --------------------------------
-- -- ()select the teams with the highest prize sum within a time period
-- -- SELECT team_name,
-- --     sum(t_prize) as total_prize
-- -- FROM TEAM,
-- --     TOURNAMENT
-- -- WHERE TEAM.team_id = TOURNAMENT.t_winner
-- --     AND TOURNAMENT.t_date BETWEEN '2019-01-01' AND '2019-12-31'
-- -- GROUP BY team_name
-- -- ORDER BY total_prize desc
-- -- LIMIT 10;
-- ------------------------
-- -- -- () select the teams with less than 5 players
-- -- SELECT team_name, team_id
-- -- FROM TEAM
-- -- WHERE team_id IN (
-- --         SELECT team_id
-- --         FROM PLAYER
-- --         GROUP BY team_id
-- --         HAVING count(player_id) < 5
-- --     );
-- -- ------------------------
-- -- -- () get the tournaments won by teams with less than 5 players, grouped by team and t_id
-- -- SELECT t_name,
-- --     team_name
-- -- FROM TOURNAMENT,
-- --     TEAM
-- -- WHERE TOURNAMENT.t_winner = TEAM.team_id
-- --     AND TEAM.team_id IN (
-- --             SELECT team_id
-- --             FROM PLAYER
-- --             GROUP BY team_id
-- --             HAVING count(player_id) < 5
-- --         );
-- -- -- ------------------------
-- -- -- () get the teams and team id of teams with 5 or more players and 0 winnings
-- -- SELECT team_name,
-- --     team_id
-- -- FROM TEAM
-- -- WHERE team_id IN (
-- --         SELECT team_id
-- --         FROM PLAYER
-- --         GROUP BY team_id
-- --         HAVING count(player_id) >= 5
-- --     )
-- --     AND team_winnings = 0;
-- -- -- -- ------------------------
-- -- count the unique team1_id in TEAM_GAME
-- -- SELECT
-- --     count(distinct team1_id)
-- -- FROM
-- --     TEAM_GAME;
---------------------
-- SELECT
--     orders.OrderID,
--     customers.CustomerName,
--     shippers.ShipperName
-- FROM
--     (
--         (
--             orders
--             inner join customers on orders.CustomerID = customers.CustomerID
--         )
--         inner join shippers on orders.ShipperID = shippers.ShipperID
--     );
-----------------------
-- SELECT
--     SupplierName
-- from
--     suppliers
-- WHERE
--     EXISTS (
--         select
--             ProductName
--         from
--             products
--         where
--             SupplierID = suppliers.SupplierID
--             and Price < 20
--     );
---------------------
-- -- list the names of all customers who have a contact name whose first name starts with the same letter as themselves
-- SELECT
--     CustomerName
-- FROM
--     customers
-- WHERE
--     LEFT(CustomerName, 1) = LEFT(ContactName, 1);
--------------------
-- list the names of all products that have a total order quantity > 30 as well as the contact name for the customers who bought them
-- SELECT
--     productname,
--     contactname
-- FROM
--     (
--         (
--             (
--                 products
--                 INNER JOIN order_details ON products.productid = order_details.productid
--             )
--             INNER JOIN orders ON order_details.orderid = orders.orderid
--         )
--         INNER JOIN customers ON orders.customerid = customers.customerid
--     );
--------------
-- () select the names of the most used items for games in 2017
SELECT
    item_name,
    count(item_name) as total_uses
FROM
    ITEM,
    GAME_ITEMS,
    GAME
WHERE
    ITEM.item_id in (GAME_ITEMS.item_id_1, GAME_ITEMS.item_id_2, GAME_ITEMS.item_id_3, GAME_ITEMS.item_id_4, GAME_ITEMS.item_id_5)
    AND GAME_ITEMS.game_id = GAME.game_id
    AND GAME.game_date BETWEEN '2017-01-01' AND '2017-12-31'
GROUP BY
    item_name
ORDER BY
    total_uses desc
LIMIT
    10;
-------------------
-- 
-- SELECT 
--     p.player_name,
--     p.player_role,
--     CASE 
--         WHEN p.player_role = 'carry' THEN ROUND((t.team_winnings * 0.4) / COUNT(p.player_id), 2)
--         WHEN p.player_role = 'support' THEN ROUND((t.team_winnings * 0.2) / COUNT(p.player_id), 2)
--         WHEN p.player_role = 'solo middle' THEN ROUND((t.team_winnings * 0.25) / COUNT(p.player_id), 2)
--         WHEN p.player_role = 'offlaner' THEN ROUND((t.team_winnings * 0.3) / COUNT(p.player_id), 2)
--         WHEN p.player_role = 'coach' THEN ROUND((t.team_winnings * 0.05) / COUNT(p.player_id), 2)
--         ELSE 0
--     END AS player_earnings
-- FROM 
--     TEAM t 
--     INNER JOIN PLAYER p ON t.team_id = p.team_id 
-- WHERE 
--     t.team_name = 'Infamous'
-- GROUP BY 
--     p.player_name;
-- seelct players and their earnings from a team
-- SELECT 
--     ROUND(
--         CASE p.player_role 
--             WHEN 'Carry' THEN 
--                 LEAST(t.team_winnings, (COUNT(p.player_id) * 0.2 * t.team_winnings)) / COUNT(p.player_id)
--             WHEN 'Solo Middle' THEN 
--                 LEAST(t.team_winnings, (COUNT(p.player_id) * 0.15 * t.team_winnings)) / COUNT(p.player_id)
--             WHEN 'Offlaner' THEN 
--                 LEAST(t.team_winnings, (COUNT(p.player_id) * 0.15 * t.team_winnings)) / COUNT(p.player_id)
--             WHEN 'Support' THEN 
--                 LEAST(t.team_winnings, (COUNT(p.player_id) * 0.10 * t.team_winnings)) / COUNT(p.player_id)
--             WHEN 'Coach' THEN 
--                 LEAST(t.team_winnings, (COUNT(p.player_id) * 0.05 * t.team_winnings)) / COUNT(p.player_id)
--         END, 2
--     ) AS player_earnings,
--     p.player_name
-- FROM 
--     TEAM t 
--     INNER JOIN PLAYER p ON t.team_id = p.team_id 
-- WHERE 
--     t.team_name = 'Infamous'
-- GROUP BY 
--     p.player_name;
-------------------
-- SELECT t.team_name, COUNT(CASE when g.game_winner = t.team_id then 1 end)/COUNT(CASE when t.team_id = tg.team1_id OR t.team_id = tg.team2_id then 1 end) as winrate
-- FROM TEAM t, GAME g, TEAM_GAME tg
-- WHERE t.team_id = tg.team1_id OR t.team_id = tg.team2_id
-- AND tg.game_id = g.game_id
-- GROUP BY t.team_name
-- ORDER BY winrate DESC;
-------------------
-- seelct the number of games played by each team
-- SELECT
--     team_name,
--     count(game_id) as games_played
-- FROM
--     TEAM,
--     TEAM_GAME
-- WHERE
--     TEAM.team_id = TEAM_GAME.team1_id
--     OR TEAM.team_id = TEAM_GAME.team2_id
-- GROUP BY
--     team_name
-- ORDER BY
--     games_played desc;
-------------------
-- select the number of games won by each team
-- SELECT
--     t.team_name,
--     count(g.game_id) as games_won
-- FROM
--     TEAM t,
--     TEAM_GAME tg,
--     GAME g
-- WHERE
--     t.team_id = tg.team1_id
--     OR t.team_id = tg.team2_id
--     AND tg.game_id = g.game_id
--     AND g.game_winner = t.team_id
-- GROUP BY
--     t.team_name
-- ORDER BY
--     games_won desc;
-- -------------------
-- () select the winrate of the top 10 played heroes in a date range (using game_performance, game, and hero)
-- SELECT
--     hero_name,
--     count(game_id) as games_played,
--     count(CASE when game_winner = team_id then 1 end) as games_won,
--     ROUND(count(CASE when game_winner = team_id then 1 end)/count(game_id), 2) as winrate
-- FROM
--     HERO,
--     GAME_PERFORMANCE,
--     GAME
-- WHERE
--     hero_id = hero_id_1
--     OR hero_id = hero_id_2
--     OR hero_id = hero_id_3
--     OR hero_id = hero_id_4
--     OR hero_id = hero_id_5
--     AND game_id = game_id
--     AND game_date BETWEEN '2017-01-01' AND '2017-12-31'
-- GROUP BY
--     hero_name
-- ORDER BY
--     games_played desc
-- LIMIT
--     10;
-- -------------------