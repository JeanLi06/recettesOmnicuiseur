"use strict";

// ecouteur d'évènement sur le changement du fichier photo de edit_single_recipe.phtml
// $(function () {
//     $('#photo').change( function () {
//         // on change le src de l'image
//         //TODO coder en dynamique
//         $('#image_recette').attr('src', 'img/test.jpg');
//     })
// });

/////////////Update de l'image après choix utilisateur sur pages update & create////////////////
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_recette').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#photo").change(function(){
    readURL(this);
});
////////////////////////////////////////////////////////////////////////////////////////////////