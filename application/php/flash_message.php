<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
// Gestion des messages flash.
//    Ce fichier est à inclure au début des pages où les messages-flash sont utilisés.

    if ((!empty($_SESSION['flash_error_message']) && !empty($_SESSION['flash_error_message'])) || (isset($_SESSION['flash_confirm_message']) && !empty($_SESSION['flash_confirm_message']))) {
//      On écrit la bonne classe CSS dans le html, selon le type de message
        if (!empty($_SESSION['flash_error_message']))
            echo '<div class="flash-error" id="flash_message">';
        elseif (!empty($_SESSION['flash_confirm_message']))
            echo '<div class="flash-confirm" id="flash_message">';
//      On identifie le type de message : erreur ou confirmation
        if (!empty($_SESSION['flash_error_message']))
            echo $_SESSION['flash_error_message'];
        elseif (!empty($_SESSION['flash_confirm_message']))
            echo $_SESSION['flash_confirm_message'];
        echo '</div>';
        // Insertion de jQuery : Cache un message flash (progressivement) dans une page, identifié par son id
        echo '<script>$(function () {
        $("#flash_message").delay(2000).slideUp("low");
    });</script>';
        unset($_SESSION['flash_error_message'], $_SESSION['flash_confirm_message']);
    }
    