"use strict";

//déclaration des variables

//variables des nouveaux produits
let boolNameNewProduct = false;
let boolDescriptionNewProduct = false;
let boolImageNewProduct = false;
let boolQuantityNewProduct = false;
let boolPriceNewProduct = false;
//variables des modifications des produits
let boolNameUpdateProduct = true;
let boolDescriptionUpdateProduct = true;
let boolImageUpdateProduct = true;
let boolQuantityUpdateProduct = true;
let boolPriceUpdateProduct = true;
//regex chiffres entiers
let intRegex = /^[0-9]+$/;
//regex chiffres float avec 2 chiffres apres virgule
let floatRegex = /^[0-9]+([.|,]?[0-9]{0,2})?$/;
//regex format .jpeg ou .jpg ou .png
let imageRegex = /(\.jpeg)|(\.jpg)|(\.png)$/gi;
//constante du formulaire des nouveaux produits
const newProductForm = document.getElementById('newProduct');
//constante du formulaire des modifications des produits
const updateProductForm = document.getElementById('updateProduct');



//déclaration des fonctions

//efface la valeur par défaut
function eraseValue(textDefault,nameControl)
{
    if (document.getElementById(nameControl).value == textDefault) {
        document.getElementById(nameControl).value='';
    }
}

//remet la valeur par défaut
function restoreValue(textDefault,nameControl)
{
    if (document.getElementById(nameControl).value == '') {
        document.getElementById(nameControl).value = textDefault;
    }
}



//verification pour le formulaire d'enregistement d'un nouveau produit

//vérifie la valeur des inputs
function newProductValue(textDefault,nameControl) {

    //verification du nom du produit
    if (nameControl == 'nameNewProduct') {

        //verification du format
        if (document.getElementById(nameControl).value == '' || document.getElementById(nameControl).value == textDefault) {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'Le nom du produit n\'est pas correct';
            boolNameNewProduct = false;
        }
        else {
            message.innerText ='';
            document.getElementById(nameControl).style.border='1px solid transparent';
            boolNameNewProduct = true;
        }
    }
    //verification de la description du produit
    else if (nameControl == 'descriptionNewProduct') {

        //verification du format
        if (document.getElementById(nameControl).value == '' || document.getElementById(nameControl).value == textDefault) {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'La description du produit n\'est pas correct';
            boolDescriptionNewProduct = false;
        }
        //verification de la longueur
        else if (document.getElementById(nameControl).value.length >= 100) {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'La description du produit est trop longue, ne pas dépasser 100 lettres';
            boolDescriptionNewProduct = false;
        }
        else {
            message.innerText ='';
            document.getElementById(nameControl).style.border='1px solid transparent';
            boolDescriptionNewProduct = true;
        }
    }
    //verification de la photo du produit
    else if (nameControl == 'imageNewProduct') {

        //verification de l'existence
        if (document.getElementById(nameControl).value == '') {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'La photo est obligatoire';
            boolImageNewProduct = false;
        }
        //verification du format
        else if (!document.getElementById(nameControl).value.match(imageRegex)) {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'La photo doit être au format .jpeg ou .jpg ou .png';
            boolImageNewProduct = false;
        }
        else {
            message.innerText ='';
            document.getElementById(nameControl).style.border='1px solid transparent';
            boolImageNewProduct = true;
        }
    }
    //verification de la quantité 
    else if (nameControl == 'quantityNewProduct') {

        //verification du format
        if (!document.getElementById(nameControl).value.match(intRegex)) {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'La quantité doit être un chiffre entier';
            boolQuantityNewProduct = false;
        }
        else {
            message.innerText = '';
            document.getElementById(nameControl).style.border = '1px solid transparent';
            boolQuantityNewProduct = true;
        }
    }
    //verification du prix 
    else if (nameControl == 'priceNewProduct') {

        //verification du format
        if (!document.getElementById(nameControl).value.match(floatRegex)) {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'La quantité doit être un chiffre à virgule, ex : 12.50';
            boolPriceNewProduct = false;
        }
        else {
            document.getElementById(nameControl).value = document.getElementById(nameControl).value.replace(/,/g,".");
            message.innerText = '';
            document.getElementById(nameControl).style.border = '1px solid transparent';
            boolPriceNewProduct = true;
        }
    }
    
}

//Permet de valider le formulaire si les champs sont bien remplis
function validateNewProduct() {
    if (boolNameNewProduct == true && boolDescriptionNewProduct == true && boolImageNewProduct == true && boolQuantityNewProduct == true && boolPriceNewProduct == true) {
        //message.innerText = 'Le formulaire est complet';
        newProductForm.submit();
        return true;
    }
    else {
        message.innerText = 'Le formulaire n\'est pas complet';
        return false;
    }

}




//verification pour le formulaire de modification d'un produit

//vérifie la valeur des inputs
function updateProductValue(textDefault, nameControl, idControl) {

    //verification du nom du produit
    if (nameControl == 'nameUpdateProduct') {

        //verification s'il existe deja
        if (document.getElementById(idControl).value == textDefault) {
            message.innerText ='';
            document.getElementById(idControl).style.border='1px solid transparent';
            boolNameUpdateProduct = true;
        }
        //verification du format
        else if (document.getElementById(idControl).value == '') {
            document.getElementById(idControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'Le nom du produit doit être renseigné';
            boolNameUpdateProduct = false;
        }
        else {
            message.innerText ='';
            document.getElementById(idControl).style.border='1px solid transparent';
            boolNameUpdateProduct = true;
        }
    }
    //verification de la description du produit
    else if (nameControl == 'descriptionUpdateProduct') {
        //verification s'il existe deja
        if (document.getElementById(idControl).value == textDefault) {
            message.innerText ='';
            document.getElementById(idControl).style.border='1px solid transparent';
            boolDescriptionUpdateProduct = true;
        }
        //verification du format
        else if (document.getElementById(idControl).value == '') {
            document.getElementById(idControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'La description du produit doit être renseignée';
            boolDescriptionUpdateProduct = false;
        }
        //verification de la longueur
        else if (document.getElementById(idControl).value.length >= 100) {
            document.getElementById(idControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'La description du produit est trop longue, ne pas dépasser 100 lettres';
            boolDescriptionUpdateProduct = false;
        }
        else {
            message.innerText ='';
            document.getElementById(idControl).style.border='1px solid transparent';
            boolDescriptionUpdateProduct = true;
        }
    }
    //verification de la photo du produit
    else if (nameControl == 'imageUpdateProduct') {

        //verification s'il existe deja
        if (document.getElementById(idControl).value == textDefault) {
            message.innerText ='';
            document.getElementById(idControl).style.border='1px solid transparent';
            boolImageUpdateProduct = true;
        }
        //verification de l'existence
        else if (document.getElementById(idControl).value == '') {
            boolImageUpdateProduct = true;
        }
        //verification du format
        else if (!document.getElementById(idControl).value.match(imageRegex)) {
            document.getElementById(idControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'La photo doit être au format .jpeg ou .jpg ou .png';
            boolImageUpdateProduct = false;
        }
        else {
            message.innerText ='';
            document.getElementById(idControl).style.border='1px solid transparent';
            boolImageUpdateProduct = true;
        }
    }
    //verification de la quantité 
    else if (nameControl == 'quantityUpdateProduct') {
        //verification s'il existe deja
        if (document.getElementById(idControl).value == textDefault) {
            message.innerText ='';
            document.getElementById(idControl).style.border='1px solid transparent';
            boolQuantityUpdateProduct = true;
        }
        //verification du format
        else if (!document.getElementById(idControl).value.match(intRegex)) {
            document.getElementById(idControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'La quantité doit être un chiffre entier';
            boolQuantityUpdateProduct = false;
        }
        else {
            message.innerText = '';
            document.getElementById(idControl).style.border = '1px solid transparent';
            boolQuantityUpdateProduct = true;
        }
    }
    //verification du prix 
    else if (nameControl == 'priceUpdateProduct') {
        //verification s'il existe deja
        if (document.getElementById(idControl).value == textDefault) {
            message.innerText ='';
            document.getElementById(idControl).style.border='1px solid transparent';
            boolPriceUpdateProduct = true;
        }
        //verification du format
        else if (!document.getElementById(idControl).value.match(floatRegex)) {
            document.getElementById(idControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'La quantité doit être un chiffre à virgule, ex : 12.50';
            boolPriceUpdateProduct = false;
        } 
        else {
            document.getElementById(idControl).value = document.getElementById(idControl).value.replace(/,/g,".");
            message.innerText = '';
            document.getElementById(idControl).style.border = '1px solid transparent';
            boolPriceUpdateProduct = true;
        }
    }
    
}

//Permet de valider le formulaire si les champs sont bien remplis
function validateUpdateProduct() {
    if (boolNameUpdateProduct == true && boolDescriptionUpdateProduct == true && boolImageUpdateProduct == true && boolQuantityUpdateProduct == true && boolPriceUpdateProduct == true) {
        //message.innerText = 'Le formulaire est complet';
        updateProductForm.submit();
        return true;
    }
    else {
        message.innerText = 'Le formulaire n\'est pas complet';
        return false;
    }

}