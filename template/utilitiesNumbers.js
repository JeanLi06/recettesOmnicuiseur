'use strict';   // Mode strict du JavaScript

/*************************************************************************************************/
/* *********************************** FONCTIONS UTILITAIRES *********************************** */
/*************************************************************************************************/

//Force l'utilisateur à rentrer un nombre entier, entre 2 valeurs
function getInteger(min, max, message) {
    var integer;

    do {
        integer = parseInt(window.prompt(message));
    } while (isNaN(integer) == true || integer < min || integer > max);

    return integer;
}

/**
 * Générateur de nombre entier maximum inclu
 * @param min {int} born minimum
 * @param max {int} born maximum
 * @returns {int} un nombre aléatoire entre les bornes min et max
 */
function getRandomInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}