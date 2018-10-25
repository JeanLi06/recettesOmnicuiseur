"use strict";


function getLocalStorage(key) {
    var datas;

    // conversion et récupération des données dans le local storage
    datas = JSON.parse(window.localStorage.getItem(key));

    // si la clé n'existe pas on retourne quand même un tableau vide
    if (datas == null)
        datas = [];

    return datas;

    // équivalent de la fonction en écriture ternaire
    // return datas = window.localStorage.getItem(key) ? JSON.parse(datas) : [];
}


function saveLocalStorage(key, datas) {

    // on met les datas sous forme de chaine de caractère avec JSON.stringify()
    // car localstorage ne peux pas stocker des données de type "complexe".
    datas = JSON.stringify(datas);

    // enregistrement des données
    window.localStorage.setItem(key, datas);

}