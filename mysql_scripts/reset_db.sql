-- drop all tables
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `jb240893`.`GAME_PERFORMANCE`;
DROP TABLE IF EXISTS `jb240893`.`HERO`;
DROP TABLE IF EXISTS `jb240893`.`PLAYER_TEAM_HISTORY`;
DROP TABLE IF EXISTS `jb240893`.`TEAM_GAME`;
DROP TABLE IF EXISTS `jb240893`.`PLAYER`;
DROP TABLE IF EXISTS `jb240893`.`GAME`;
DROP TABLE IF EXISTS `jb240893`.`TEAM`;
DROP TABLE IF EXISTS `jb240893`.`TOURNAMENT`;
DROP TABLE IF EXISTS `jb240893`.`TOURNAMENT_GAMES`;
DROP TABLE IF EXISTS `jb240893`.`ITEM`;
DROP TABLE IF EXISTS `jb240893`.`ITEM_ABILITY`;
DROP TABLE IF EXISTS `jb240893`.`GAME_ITEMS`;
SET FOREIGN_KEY_CHECKS = 1;
-- add all tables
SOURCE create_tables.sql;
-- add data to tables
SOURCE setup/add_teams.sql;
SOURCE setup/add_heroes.sql;
SOURCE setup/add_players.sql;
SOURCE setup/add_tournaments.sql;
SOURCE setup/add_items.sql;
SOURCE setup/add_item_abilities.sql;
SOURCE setup/add_games.sql;
SOURCE setup/add_game_performances.sql;
SOURCE setup/add_game_items.sql;
SOURCE setup/add_team_games.sql;
SOURCE setup/add_tournament_games.sql;
SOURCE setup/add_team_history.sql;

-- update team winnings
SOURCE setup/update_team_winnings.sql;