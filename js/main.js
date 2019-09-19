"use strict";

/////////////Update de l'image après choix utilisateur sur pages edit_recipe & add-recipe ////////////////
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_recette')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////

// Apparition de la flêche retour vers le haut, après un défilement de 100px
$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('.button-scroll-to-top:hidden').stop(true, true).fadeIn();
    } else {
        $('.button-scroll-to-top').stop(true, true).fadeOut();
    }
});

// Permet un défilement doux (smooth scroll) si click sur un lien qui commence par #
$('a[href^="#"]').click(function () {
    var the_id = $(this).attr("href");
    //On test si ce n'est pas juste un lien vide qui mène nulle part
    if (the_id === '#') {
        return;
    }
    $('html, body').animate({
        scrollTop: $(the_id).offset().top
    }, 'slow');
    //On empêche le comportement normal (saut vers l'ancre et affichage dans l'url)
    return false;
});

