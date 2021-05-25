"use strict";

//déclaration des variables

//variables boolean des input
let boolEmail = false;
let boolPassword = false;
let boolUsermail = false;
let boolUserpassword = false;
//regex email
let emailRegex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
//constante du formulaire d'inscription
const accountForm = document.getElementById('account');
//constante du formulaire de connexion
const loginForm = document.getElementById('login');
//constante du message d'erreur
const message = document.getElementById('message');



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



//verification pour le formulaire d'inscription

//vérifie la valeur des inputs
function checkValue(nameControl) {

    //verification de l'email
    if (nameControl == 'email') {

        //verification du format
        if (!document.getElementById(nameControl).value.match(emailRegex)) {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'Votre mail n\'est pas correct';
            boolEmail = false;
        }
        else {
            message.innerText ='';
            document.getElementById(nameControl).style.border='1px solid transparent';
            boolEmail = true;
        }
    }
    //verification du 1er mot de passe 
    else if (nameControl == 'password') {
        if (document.getElementById(nameControl).value.length < 8) {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'Le mot de passe doit comporter 8 caractères minimum';
            boolPassword = false;
        }
        else {
            message.innerText = '';
            document.getElementById(nameControl).style.border = '1px solid transparent';
        }
    }
    //verification du 2eme mot de passe 
    else if (nameControl == 'password2') {
        if (document.getElementById(nameControl).value != document.getElementById('password').value) {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'Les mots de passe doivent être identiques';
            boolPassword = false;
        }
        else {
            message.innerText = '';
            document.getElementById(nameControl).style.border = '1px solid transparent';
            boolPassword = true;
        }
    }
    
}

//Permet de valider le formulaire si les champs sont bien remplis
function validateAccount() {
    if (boolEmail == true && boolPassword == true) {
        //message.innerText = 'Le formulaire est complet';
        accountForm.submit();
        return true;
    }
    else {
        message.innerText = 'Le formulaire n\'est pas complet';
        return false;
    }

}



//verification pour le formulaire de connexion

//vérifie la valeur des inputs
function verifyValue(nameControl)
{
    //verification de l'email
    if (nameControl == 'userMail') {

        //verification du format
        if (!document.getElementById(nameControl).value.match(emailRegex)) {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'Votre mail n\'est pas correct';
            boolUsermail = false;
        }
        else {
            message.innerText ='';
            document.getElementById(nameControl).style.border='1px solid transparent';
            boolUsermail = true;
        }
    }
    //verification du mot de passe 
    else if (nameControl == 'userPassword') {
        if (document.getElementById(nameControl).value.length < 8) {
            document.getElementById(nameControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'Le mot de passe doit comporter 8 caractères minimum';
            boolUserpassword = false;
        }
        else {
            message.innerText = '';
            document.getElementById(nameControl).style.border = '1px solid transparent';
            boolUserpassword = true;
        }
    }
    
}

//Permet de valider le formulaire si les champs sont bien remplis
function validateLogin() {
    if (boolUsermail == true && boolUserpassword == true) {
        //message.innerText = 'Le formulaire est complet';
        loginForm.submit();
        return true;
    }
    else {
        message.innerText = 'Le formulaire n\'est pas complet';
        return false;
    }

}