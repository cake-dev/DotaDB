SELECT team_name,
    sum(t_prize) as total_prize
FROM TEAM,
    TOURNAMENT
WHERE TEAM.team_id = TOURNAMENT.t_winner
    AND TOURNAMENT.t_date BETWEEN '2019-01-01' AND '2019-12-31'
GROUP BY team_name
ORDER BY total_prize desc
LIMIT 10;