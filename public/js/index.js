"use strict";


//déclaration des variables

//bouton croix
const toggleBtn = document.querySelector(".toggle");
//menu rideau
const navConnexion = document.querySelector("nav.connexion ul");
//div
const div = document.querySelector('.logo');
//header titre
const title = document.querySelector('h1');
//header phrase d'accroche
const sentence = document.querySelector('.logo p');
//cart inscription/connexion
const cart = document.querySelector('.cart');




//au chargement de la page
window.addEventListener('load', () => {
    

    //Animations sur le header
    if (title !== null && sentence !== null && cart !== null) {
        //animation du titre
        title.classList.add('show');
        
        //animation de la phrase d'accroche
        sentence.classList.add('show2');
        
        //animation au scroll
        window.addEventListener('scroll', (e)=>{
            e.preventDefault();
            cart.classList.add('flip');
        });
    }
    


    // Animation dans header du toggle : menu en rideau pour les mobiles et tablettes
    toggleBtn.addEventListener('click', () => {
        toggleBtn.classList.toggle('active');
    
        if (toggleBtn.classList.contains('active')) {
            navConnexion.style.height = '100%';
        }
        else {
            navConnexion.style.height = '0';
        }
        
    });
    

});  
