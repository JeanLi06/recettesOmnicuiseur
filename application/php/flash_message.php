<!--    Gestion des messages flash -->
<?php if (session_status() === PHP_SESSION_NONE) session_start() ?>

    <?php if (isset($_SESSION['flash_error_message']) && !empty($_SESSION['flash_error_message']) || (isset($_SESSION['flash_confirm_message']) && !empty($_SESSION['flash_confirm_message']))): ?>
<!--        on charge la bonne classe selon le type de message-->
        <div class="
        <?php
            if (isset($_SESSION['flash_error_message'])): ?>
                <?= 'flash_error' ?>
            <?php elseif (isset($_SESSION['flash_confirm_message'])): ?>
                <?= 'flash_confirm' ?>
            <?php endif; ?>
<!--            Le message est caché à l'origne et sera révélé avec du JQuery-->
        " id="flash_message" hidden>
            <?php if (isset($_SESSION['flash_error_message'])): ?>
                <?= $_SESSION['flash_error_message'] ?>
            <?php elseif (isset($_SESSION['flash_confirm_message'])): ?>
                <?= $_SESSION['flash_confirm_message'] ?>
            <?php endif; ?>
        </div>
        <script>
            $(function () {
                $('#flash_message').slideDown("slow").delay(2000).slideUp("slow");
            });
        </script>
        <?php unset($_SESSION['flash_error_message']) ?>
        <?php unset($_SESSION['flash_confirm_message']) ?>
    <?php endif ?>
