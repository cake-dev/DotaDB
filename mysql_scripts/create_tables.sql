CREATE TABLE TEAM (
    team_id int PRIMARY KEY AUTO_INCREMENT,
    team_name varchar(64),
    team_region varchar(32),
    team_winnings int DEFAULT 0
);
CREATE TABLE PLAYER (
    player_id int PRIMARY KEY AUTO_INCREMENT,
    player_name varchar(128) NOT NULL,
    gamer_name varchar(64) NOT NULL,
    player_role varchar(32),
    player_country varchar(32),
    player_region varchar(32),
    player_rank int,
    team_id int,
    FOREIGN KEY (team_id) REFERENCES TEAM(team_id)
);
CREATE TABLE TOURNAMENT (
    t_id int PRIMARY KEY AUTO_INCREMENT,
    t_name varchar(64) NOT NULL,
    t_date datetime NOT NULL,
    t_prize int DEFAULT 0,
    t_winner int NOT NULL
);
CREATE TABLE GAME (
    game_id int PRIMARY KEY AUTO_INCREMENT,
    game_winner int,
    game_duration int NOT NULL,
    game_date datetime NOT NULL,
    tournament_id int,
    FOREIGN KEY (tournament_id) REFERENCES TOURNAMENT(t_id),
    FOREIGN KEY (game_winner) REFERENCES TEAM(team_id)
);
CREATE TABLE HERO (
    hero_id int PRIMARY KEY,
    hero_name varchar(32) NOT NULL UNIQUE,
    hero_main_stat varchar(16) NOT NULL,
    str_base int NOT NULL,
    str_gain float NOT NULL,
    str_30 float NOT NULL,
    agi_base int NOT NULL,
    agi_gain float NOT NULL,
    agi_30 float NOT NULL,
    int_base int NOT NULL,
    int_gain float NOT NULL,
    int_30 float NOT NULL,
    attack_type varchar(16) NOT NULL,
    attack_range int NOT NULL,
    damage_base int NOT NULL,
    armor_base int NOT NULL,
    move_speed_base int NOT NULL,
    turn_rate float NOT NULL
);
CREATE TABLE GAME_PERFORMANCE (
    gameplay_id int PRIMARY KEY AUTO_INCREMENT,
    g_kills int NOT NULL DEFAULT 0,
    g_deaths int NOT NULL DEFAULT 0,
    g_assists int NOT NULL DEFAULT 0,
    g_xpm int NOT NULL DEFAULT 0,
    g_gpm int NOT NULL DEFAULT 0,
    g_last_hits int NOT NULL DEFAULT 0,
    g_win int NOT NULL DEFAULT 0,
    player_id int NOT NULL,
    game_id int NOT NULL,
    hero_id int NOT NULL,
    FOREIGN KEY (player_id) REFERENCES PLAYER(player_id),
    FOREIGN KEY (game_id) REFERENCES GAME(game_id),
    FOREIGN KEY (hero_id) REFERENCES HERO(hero_id)
);
CREATE TABLE PLAYER_TEAM_HISTORY (
    player_id int,
    team_id int,
    join_date datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (player_id) REFERENCES PLAYER(player_id),
    PRIMARY KEY (player_id, team_id, join_date)
);
CREATE TABLE TEAM_GAME (
    team1_id int,
    team2_id int,
    game_id int,
    FOREIGN KEY (team1_id) REFERENCES TEAM(team_id),
    FOREIGN KEY (team2_id) REFERENCES TEAM(team_id),
    FOREIGN KEY (game_id) REFERENCES GAME(game_id),
    PRIMARY KEY (team1_id, team2_id, game_id)
);