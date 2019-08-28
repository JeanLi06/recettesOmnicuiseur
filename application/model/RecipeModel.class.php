<?php
    
    class RecipeModel
    {
        //    Cette fonction retourne un tableau contenant la recette dont l'id est passé en paramètre
        public static function recipeFromId($id) {
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

//        Cette méthode récupère quelques valeurs de la dernière recette créée (grâce à ORDER BY ... DESC)
        public static function lastRecipeInfos() {
            global $pdo;
            $query = '
            SELECT
                id,
                name,
                photo
            FROM recette
            ORDER BY creation_date DESC
    ';
            $resultSet = $pdo->query($query);
            return $resultSet->fetch();
        }

//        Cette méthode met à jour la recette spécifiée par son Id
        public static function recipeUpdate($name, $photo, $ingredients_list, $how_many_persons, $cooking_time_minutes, $cooking_instructions, $category, $note, $recette_id) {
            $query = '
                  UPDATE `recette`
                  SET name = ?,
                      photo = ?,
                      ingredients_list = ?,
                      how_many_persons = ?,
                      cooking_time_minutes = ?,
                      cooking_instructions = ?,
                      category = ?,
                      note = ?,
                      creation_date = NOW()
                  WHERE id = ?';
            execute($query, [$name, $photo, $ingredients_list, $how_many_persons, $cooking_time_minutes, $cooking_instructions, $category, $note, (int)$recette_id]);
        }
        
//        Cette fonction récupère la liste des ID des recettes, dans le tableau $tableIDs trié par date décroissante
        public static function recipesListOfIDs() {
            global $pdo;
            $query = '
            SELECT
               id
            FROM recette
            ORDER BY creation_date DESC
            ';
            $resultSet = $pdo->prepare($query);
            $resultSet->execute(array());
            return $resultSet->fetchAll(PDO::FETCH_NUM);
        }
        
//        Cette méthode génère un tableau contenant une liste des recettes existantes, avec l'ID le nom, le nom de la photo et la date de création
        public static function listOfRecipes() {
            global $pdo;
            $query = "
            SELECT
                id,
                name,
                photo,
                DATE_FORMAT(creation_date, '%d-%m-%Y à %Hh%i') as creation_date_formatted
            FROM recette
            ORDER BY creation_date DESC
            ";
            $result_set = $pdo->prepare($query);
            $result_set->execute();
            return $result_set->fetchAll();
        }
        
//        Cette méthode efface une recette d'après son ID
        public static function recipeDelete($id) {
            $query = '
            DELETE FROM `recette`
            WHERE `id` = ?';
            execute($query, [$id]);
        }
    }
