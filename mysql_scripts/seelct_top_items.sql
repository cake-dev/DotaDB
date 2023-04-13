SELECT i.item_name, COUNT(*) AS item_count
FROM GAME_ITEMS gi
JOIN ITEM i ON gi.item_id_1 = i.item_id OR gi.item_id_2 = i.item_id 
            OR gi.item_id_3 = i.item_id OR gi.item_id_4 = i.item_id 
            OR gi.item_id_5 = i.item_id
GROUP BY i.item_name
ORDER BY item_count DESC
LIMIT 10;
