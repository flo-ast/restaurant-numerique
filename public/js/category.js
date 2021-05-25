"use strict";

//déclaration des variables

//variable de la nouvelle catégorie
let boolNameCategory = true;
//constante du formulaire des modifications des catégories
const updateCategoryForm = document.getElementById('updateCategory');
//contante du Drag and Drop
const dragAndDrops = document.querySelectorAll(".drop");
//variable du Drag and Drop
let dragged;
//constante de l'input drag
const input = document.querySelector(".order");
//constante du formulaire de mise a jour de l'ordre des categories
const updateOrderCategoryForm = document.getElementById('updateOrderCategories');



//déclaration des fonctions


//verification pour le formulaire de modification d'une catégorie

//vérifie la valeur des inputs
function updateCategoryValue(nameControl, idControl) {

    //verification du nom du produit
    if (nameControl == 'nameCategory') {

        //verification du format
        if (document.getElementById(idControl).value == '') {
            document.getElementById(idControl).style.border = '2px solid var(--redColor)';
            message.innerText = 'Le nom de la catégorie doit être renseigné';
            boolNameCategory = false;
        }
        else {
            message.innerText ='';
            document.getElementById(idControl).style.border='1px solid transparent';
            boolNameCategory = true;
        }
    }
}


//Permet de valider le formulaire si les champs sont bien remplis
function validateUpdateCategory() {
    if (boolNameCategory == true) {
        //message.innerText = 'Le formulaire est complet';
        updateCategoryForm.submit();
        return true;
    }
    else {
        message.innerText = 'Le formulaire n\'est pas complet'
        return false;
    }

}




// Animation du Drag and Drop :

    
//boucle pour chaque element draganddropable
for (let dragAndDrop of dragAndDrops) {
    
    //départ de la zone de drop
    dragAndDrop.ondragstart = (e) => {
        dragged = dragAndDrop;
        e.dataTransfer.setData('text/plain', dragAndDrop.innerHTML);
        dragAndDrop.classList.add("dragged");
    };
    
    //zone de drop
    dragAndDrop.ondragover = (e) => {
        e.preventDefault();
    };
    
    //rentre dans le drag
    dragAndDrop.ondragenter = () => {
        if (!dragAndDrop.classList.contains("dragged")) {
            dragAndDrop.classList.add("draggedOn");
        }
        dragAndDrop.classList.remove("shake");
    };
    
    //sort du drag
    dragAndDrop.ondragleave = () => {
        dragAndDrop.classList.remove("draggedOn");
    };
    
    //rentre dans le drop
    dragAndDrop.ondragend = () => {
        dragAndDrop.classList.remove("dragged");
    };

    //arrivée zone de drop
    dragAndDrop.ondrop = (e) => {
        dragged.innerHTML = dragAndDrop.innerHTML;
        dragAndDrop.innerHTML = e.dataTransfer.getData("text/plain");
        dragAndDrop.classList.remove("draggedOn");
        dragAndDrop.classList.add("shake");

        const data = [  
            {
                name :  dragged.innerHTML, 
                position : dragged.dataset.position
            },
            {
                name : dragAndDrop.innerHTML, 
                position : dragAndDrop.dataset.position
            }
        ];
        
        //transformation au format JSON
        input.value = JSON.stringify(data);

        //requete fetch
        const form = new FormData(updateOrderCategoryForm);
        fetch("updateOrderCategories", {
          method: "POST",
          body: form
        })

        //rechargement pour mettre a jour le menu
        document.location.reload();

    };
}