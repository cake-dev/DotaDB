-- update the team winnings based on their prize totals
UPDATE TEAM
SET team_winnings = (
        SELECT sum(t_prize)
        FROM TOURNAMENT
        WHERE TOURNAMENT.t_winner = TEAM.team_id
    );