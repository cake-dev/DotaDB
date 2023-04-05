UPDATE TEAM
SET team_winnings = (
        SELECT sum(t_prize)
        FROM TOURNAMENT
        WHERE TOURNAMENT.t_winner = TEAM.team_id
    );
-- change nulls to 0 in team
UPDATE TEAM
SET team_winnings = 0
WHERE team_winnings IS NULL;