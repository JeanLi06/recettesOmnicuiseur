<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
// Gestion des messages flash
    
    if ((!empty($_SESSION['flash_error_message']) && !empty($_SESSION['flash_error_message'])) || (isset($_SESSION['flash_confirm_message']) && !empty($_SESSION['flash_confirm_message']))) {
//      Charge la bonne classe CSS dans le html, selon le type de message
        echo '<div class="';
        if (!empty($_SESSION['flash_error_message']))
            echo 'flash-error';
        elseif (!empty($_SESSION['flash_confirm_message']))
            echo 'flash-confirm';
        echo '" id="flash_message">';
//        On identifie le type de message : erreur ou confirmation
        if (!empty($_SESSION['flash_error_message']))
            echo $_SESSION['flash_error_message'];
        elseif (!empty($_SESSION['flash_confirm_message']))
            echo $_SESSION['flash_confirm_message'];
//        Un petit effet d'affichage avec jQuery...
        echo '</div>
        <script type="text/javascript">
            $(function () {
//                $("#flash_message").slideDown("slow").delay(2000).slideUp("low");
                $("#flash_message").delay(2000).slideUp("low");
            });
        </script>';
        unset($_SESSION['flash_error_message']);
        unset($_SESSION['flash_confirm_message']);
    }