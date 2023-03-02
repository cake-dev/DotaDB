SELECT p.player_id,
    p.gamer_name,
    p.player_name,
    p.team_id,
    p.player_role
FROM PLAYER p
    INNER JOIN TEAM t ON p.team_id = t.team_id
WHERE t.team_name = 'Team Secret';