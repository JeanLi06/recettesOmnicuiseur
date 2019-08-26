<?php
    
    
    class RecipeModel
    {
        public static function RecipeFromId()
        {
            global $pdo;
            $query = '
        SELECT
            name,
            photo,
            how_many_persons,
            ingredients_list,
            cooking_time_minutes,
            cooking_instructions,
            category,
            note,
            creation_date
        FROM recette
        WHERE id = ?
        ORDER BY creation_date DESC
    ';
            $resultSet = $pdo->prepare($query);
            $resultSet->execute([(int)$_GET['id']]);
            return $resultSet->fetch();
        }
    }