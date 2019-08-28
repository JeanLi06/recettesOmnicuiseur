<?php
    
    /**
     * Class RecipeModel
     * Comporte les méthodes suivantes :
     *
     */
    class RecipeModel
    {
        //    Cette méthode retourne un tableau contenant la recette dont l'id est passé en paramètre
        public static function recipeFromId($id)
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
                DATE_FORMAT(creation_date, \'%d-%m-%Y à %Hh%i\') as creation_date_formatted
            FROM recette
            WHERE id = ?
            ORDER BY creation_date DESC
    ';
            $result_set = $pdo->prepare($query);
            $result_set->execute($id);
            return $result_set->fetch();
        }

//        Cette méthode récupère quelques valeurs de la dernière recette créée (grâce à ORDER BY ... DESC)
        public static function lastRecipeInfos()
        {
            global $pdo;
            $query = '
            SELECT
                id,
                name,
                photo
            FROM recette
            ORDER BY creation_date DESC
    ';
            $result_set = $pdo->query($query);
            return $result_set->fetch();
        }

//        Cette méthode met à jour la recette spécifiée par son Id
        public static function recipeUpdate($name, $photo, $ingredients_list, $how_many_persons, $cooking_time_minutes, $cooking_instructions, $category, $note, $recette_id)
        {
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

//        Cette méthode récupère la liste des ID des recettes, dans le tableau $tableIDs trié par date décroissante
        public static function recipesListOfIDs()
        {
            global $pdo;
            $query = '
            SELECT
               id
            FROM recette
            ORDER BY creation_date DESC
            ';
            $result_set = $pdo->prepare($query);
            $result_set->execute(array());
            return $result_set->fetchAll(PDO::FETCH_NUM);
        }

//        Cette méthode génère un tableau contenant une liste des recettes existantes, avec l'ID le nom, le nom de la photo et la date de création
        public static function listOfRecipes()
        {
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
        public static function recipeDelete($id)
        {
            $query = '
            DELETE FROM `recette`
            WHERE `id` = ?';
            execute($query, [$id]);
        }

//        Cette méthode compte le nombre de recette en base
        public static function recipesCount()
        {
            global $pdo;
            $query = '
            SELECT COUNT(*)
              AS qty
            FROM recette
            ';
            $result_set = $pdo->query($query);
            $quantity = $result_set->fetch();
            return $quantity['qty'];
        }

//        Cette méthode retourne le résultat de la recherche d'un terme dans la base sur le nom et les ingrédients
        public static function searchItem($item_to_search)
        {
            global $pdo;
            //        COLLATE utf8_unicode_ci permet d'être tolérant avec les accents de la requête
            $query = '
            SELECT
                id,
                name,
                photo,
                DATE_FORMAT(creation_date, \'%d-%m-%Y à %Hh%i\') as creation_date_formatted
            FROM `recette`
            WHERE `ingredients_list`  LIKE ?
            OR `name` LIKE ?
            COLLATE utf8_unicode_ci
            ';
            $item = strtolower(trim($item_to_search));
            $result_set = $pdo->prepare($query);
            $result_set->execute(["%$item%", "%$item%"]);
            return $result_set->fetchAll();
        }

//        Cette méthode ajoute une nouvelle recette dans la base de données
        public static function recipeAdd($name, $full_unique_name, $ingredients_list, $how_many_persons, $cooking_time_minutes, $cooking_instructions, $category, $note)
        {
            $query = '
            INSERT
            INTO recette (name, photo, ingredients_list, how_many_persons, cooking_time_minutes, cooking_instructions, category, note, creation_date)
            VALUES (?,?,?,?,?,?,?,?, NOW())
            ';
            execute($query,[$name, $full_unique_name, $ingredients_list, $how_many_persons, $cooking_time_minutes, $cooking_instructions, $category, $note]);
        }
    }
