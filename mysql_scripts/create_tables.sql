CREATE TABLE TEAM (
    team_id int PRIMARY KEY,
    team_name varchar(64),
    team_region varchar(32),
    team_winnings int DEFAULT 0
);

CREATE TABLE PLAYER (
    player_id int PRIMARY KEY AUTO_INCREMENT,
    player_name varchar(128) NOT NULL UNIQUE,
    gamer_name varchar(64) NOT NULL,
    player_role varchar(32) CHECK (
        player_role IN (
            'Carry',
            'Solo Middle',
            'Offlaner',
            'Support',
            'Coach'
        )
    ),
    player_country varchar(32),
    player_region varchar(32) CHECK (
        player_region IN (
            'North America',
            'South America',
            'Europe',
            'China',
            'Southeast Asia',
            'CIS',
            'Other'
        )
    ),
    player_rank int,
    team_id int,
    FOREIGN KEY (team_id) REFERENCES TEAM(team_id)
);

CREATE TABLE TOURNAMENT (
    t_id int PRIMARY KEY AUTO_INCREMENT,
    t_name varchar(64) NOT NULL,
    t_date datetime NOT NULL CHECK (t_date > '2017-01-01 00:00:00'),
    t_prize int DEFAULT 0,
    t_winner int,
    FOREIGN KEY (t_winner) REFERENCES TEAM(team_id)
);

CREATE TABLE GAME (
    game_id int PRIMARY KEY,
    game_winner int,
    game_duration int NOT NULL,
    game_date datetime NOT NULL CHECK (game_date > '2017-01-01 00:00:00'),
    FOREIGN KEY (game_winner) REFERENCES TEAM(team_id)
);

CREATE TABLE TOURNAMENT_GAMES (
    t_id int,
    game_id int,
    FOREIGN KEY (t_id) REFERENCES TOURNAMENT(t_id),
    FOREIGN KEY (game_id) REFERENCES GAME(game_id)
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
    armor_base float NOT NULL,
    move_speed_base int NOT NULL,
    turn_rate float NOT NULL
);

CREATE TABLE GAME_PERFORMANCE (
    g_kills int NOT NULL DEFAULT 0,
    g_deaths int NOT NULL DEFAULT 0,
    g_assists int NOT NULL DEFAULT 0,
    g_xpm int NOT NULL DEFAULT 0,
    g_gpm int NOT NULL DEFAULT 0,
    g_last_hits int NOT NULL DEFAULT 0,
    g_denies int NOT NULL DEFAULT 0,
    g_hero_damage int NOT NULL DEFAULT 0,
    g_tower_damage int NOT NULL DEFAULT 0,
    g_hero_healing int NOT NULL DEFAULT 0,
    g_level int NOT NULL DEFAULT 0,
    g_win int NOT NULL,
    player_id int NOT NULL,
    game_id int NOT NULL,
    hero_id int NOT NULL,
    FOREIGN KEY (player_id) REFERENCES PLAYER(player_id),
    FOREIGN KEY (game_id) REFERENCES GAME(game_id),
    FOREIGN KEY (hero_id) REFERENCES HERO(hero_id),
    PRIMARY KEY (player_id, game_id, hero_id)
);

CREATE TABLE PLAYER_TEAM_HISTORY (
    player_id int,
    team_id int,
    join_date datetime DEFAULT '2017-01-01 00:00:00',
    leave_date datetime,
    FOREIGN KEY (player_id) REFERENCES PLAYER(player_id),
    FOREIGN KEY (team_id) REFERENCES TEAM(team_id),
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

CREATE TABLE ITEM(
    item_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    item_name VARCHAR(25) NOT NULL,
    item_cost INTEGER NOT NULL,
    str_bonus NUMERIC(4, 1) DEFAULT 0,
    agi_bonus NUMERIC(4, 1) DEFAULT 0,
    int_bonus NUMERIC(4, 1) DEFAULT 0,
    health_bonus NUMERIC(5, 1) DEFAULT 0,
    mana_bonus INTEGER DEFAULT 0,
    hp_regen_bonus NUMERIC(4, 2) DEFAULT 0,
    mana_regen_bonus NUMERIC(4, 2) DEFAULT 0,
    armor_bonus NUMERIC(4, 1) DEFAULT 0,
    evasion_bonus NUMERIC(4, 2) DEFAULT 0,
    resistance_bonus NUMERIC(3, 1) DEFAULT 0,
    spell_amp_bonus NUMERIC(4, 2) DEFAULT 0,
    damage_bonus INTEGER DEFAULT 0,
    attack_speed_bonus NUMERIC(5, 1) DEFAULT 0,
    move_speed_bonus INTEGER DEFAULT 0,
    item_type VARCHAR(7) NOT NULL
);

CREATE TABLE ITEM_ABILITY(
    item_id INTEGER NOT NULL AUTO_INCREMENT,
    ability_1 VARCHAR(512) NOT NULL DEFAULT 'none',
    ability_2 VARCHAR(512) NOT NULL DEFAULT 'none',
    ability_3 VARCHAR(512) NOT NULL DEFAULT 'none',
    FOREIGN KEY (item_id) REFERENCES ITEM(item_id),
    PRIMARY KEY (item_id, ability_1)
);

CREATE TABLE GAME_ITEMS(
   hero_id    INTEGER  NOT NULL
  ,game_id    INTEGER  NOT NULL
  ,item_id_1  INTEGER  NOT NULL
  ,item_id_2  INTEGER  NOT NULL
  ,item_id_3  INTEGER  NOT NULL
  ,item_id_4  INTEGER  NOT NULL
  ,item_id_5  INTEGER  NOT NULL,
  PRIMARY KEY (hero_id, game_id, item_id_1),
  FOREIGN KEY (game_id) REFERENCES GAME(game_id)
);