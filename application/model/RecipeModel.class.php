<?php
//    Cette fonction retourne un tableau contenant la recette dont l'id est passé en paramètre
    
    class RecipeModel
    {
        public static function RecipeFromId($id)
        {
            echo "<p></p>";
            echo "RecipeModel Chargé";
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
            DATE_FORMAT(creation_date, \'%d-%m-%Y à %Hh%i\') as creation_date_formatted
        FROM recette
        WHERE id = ?
        ORDER BY creation_date DESC
    ';
            $resultSet = $pdo->prepare($query);
            $resultSet->execute($id);
            return $resultSet->fetch();
        }
    }