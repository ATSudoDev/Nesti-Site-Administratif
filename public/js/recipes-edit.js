document.addEventListener("DOMContentLoaded", function () {

    const buttonAddIngredient = document.querySelector("#buttonAddIngredient");

    var buttonsDeleteIngredient = document.querySelectorAll(".buttonDeleteIngredient");

    buttonAddIngredient.addEventListener('click', function () {

        // Get Values
        var ingredientName = document.getElementById("inputIngredientName").value;
        var ingredientQuantity = document.getElementById("inputIngredientQuantity").value;
        var ingredientUnit = document.getElementById("inputIngredientUnit").value;

        addIngredientDB(idRecipe, ingredientName, ingredientQuantity, ingredientUnit)
            .then((response) => {
                if (response) {

                    id_ingredient = response["id_ingredient"];
                    id_measure_unit_ingredient = response["id_measure_unit_ingredient"];
                    id_recipe = response['id_recipe'];

                    // Create elements
                    var listIngredients = document.getElementById("listIngredients");
                    var newIngredient = document.createElement("li");
                    var buttonDelete = document.createElement("button")

                    // Add classes
                    buttonDelete.innerHTML = "<i class='fas fa-times'></i>";
                    buttonDelete.className = "buttonDeleteIngredient rounded";
                    buttonDelete.setAttribute('data-quantity', ingredientQuantity);
                    buttonDelete.setAttribute('data-id-recipe', id_recipe);
                    buttonDelete.setAttribute('data-id-product', id_ingredient);
                    buttonDelete.setAttribute('data-id-measure-unit', id_measure_unit_ingredient);
                    buttonDelete.setAttribute('data-bs-toggle', 'modal');
                    buttonDelete.setAttribute('data-bs-target', '#deleteIngredient');
                    newIngredient.className = "justify-content-between mb-1";

                    // AppendChild Element
                    newIngredient.appendChild(document.createTextNode(ingredientQuantity + " " + ingredientUnit + " de " + ingredientName + "  "));
                    newIngredient.appendChild(buttonDelete);
                    listIngredients.appendChild(newIngredient);

                    // Reset all inputs new ingredient
                    document.getElementById("inputIngredientName").value = '';
                    document.getElementById("inputIngredientQuantity").value = '';
                    document.getElementById("inputIngredientUnit").value = '';

                    buttonsDeleteIngredient = document.querySelectorAll(".buttonDeleteIngredient");
                    
                    buttonsDeleteIngredient.forEach(button => button.addEventListener('click', function () {
                        var modalDeleteIngredient = document.querySelector("#button-delete-ingredient-recipe");
                        modalDeleteIngredient.onclick = function () {
                            deleteIngredient(button);
                        };
                    }));


                    // Add alerte
                    var alertes = document.querySelector("#alertes-recipe-ingredients");
                    alertes.innerHTML = "";
                    var div = document.createElement("div");
                    div.className = "alert alert-success";
                    var remove = 'removeAlert(this)';
                    div.setAttribute('onclick', remove);
                    div.innerHTML = "L'ingrédient a bien été ajouté à la recette.";
                    alertes.appendChild(div);
                }
            });


        // AJAX REQUEST
        async function addIngredientDB(idRecipe, ingredientName, ingredientQuantity, ingredientUnit) {

            var myHeaders = new Headers();

            let formData = new FormData();
            formData.append('id_recipe', idRecipe);
            formData.append('name_ingredient', ingredientName);
            formData.append('quantity_ingredient', ingredientQuantity);
            formData.append('unit_ingredient', ingredientUnit);

            var myInit = {
                method: 'POST',
                headers: myHeaders,
                mode: 'cors',
                cache: 'default',
                body: formData
            };

            let response = await fetch(ROOT + 'recipes/edit/' + idRecipe + '/addingredient', myInit);

            try {
                if (response.ok) {
                    return await response.json();

                } else {
                    return false;
                }
            } catch (e) {
                console.error(e.message);
            }

        }

    });

    buttonsDeleteIngredient.forEach(button => button.addEventListener('click', function () {
        var modalDeleteIngredient = document.querySelector("#button-delete-ingredient-recipe");
        modalDeleteIngredient.onclick = function () {
            deleteIngredient(button);
        };
    }));
});

function deleteIngredient(button) {
    // Get Values
    var idRecipe = button.getAttribute('data-id-recipe');
    var idIngredient = button.getAttribute('data-id-product');
    var ingredientQuantity = button.getAttribute('data-quantity');
    var idMeasureUnit = button.getAttribute('data-id-measure-unit');

    deleteIngredientDB(idRecipe, idIngredient, ingredientQuantity, idMeasureUnit)
        .then((response) => {
            if (response) {

                button.parentNode.remove();

                // Add alerte
                var alertes = document.querySelector("#alertes-recipe-ingredients");
                alertes.innerHTML = "";
                var div = document.createElement("div");
                div.className = "alert alert-danger";
                var remove = 'removeAlert(this)';
                div.setAttribute('onclick', remove);
                div.innerHTML = "L'ingrédient a bien été supprimé de la recette.";
                alertes.appendChild(div);
            }
        });


    // AJAX REQUEST
    async function deleteIngredientDB(idRecipe, idIngredient, ingredientQuantity, idMeasureUnit) {

        var myHeaders = new Headers();

        let formData = new FormData();
        formData.append('id_recipe', idRecipe);
        formData.append('id_ingredient', idIngredient);
        formData.append('quantity_ingredient', ingredientQuantity);
        formData.append('id_measure_unit', idMeasureUnit);

        var myInit = {
            method: 'POST',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData
        };

        let response = await fetch(ROOT + 'recipes/edit/' + idRecipe + '/deleteingredient', myInit);

        try {
            if (response.ok) {
                return await response.json();

            } else {
                return false;
            }
        } catch (e) {
            console.error(e.message);
        }
    }
}


// --------------------------------------- IMAGE PART ------------------------------------

document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("#formPictureRecipe");

    form.addEventListener('submit', (function (e) {
        e.preventDefault();
        const img = document.querySelector("#InputFileEditRecipe");
        if (img.value != "") {
            editPicture(this)
                .then((response) => {
                    if (response) {
                        const divPicture = document.querySelector("#display-img-recipe");
                        divPicture.style.backgroundImage = "url(" + response["path"] + ")";

                        // Add alerte
                        var alertes = document.querySelector("#alertes-recipe-image");
                        console.log(alertes);
                        alertes.innerHTML = "";
                        var div = document.createElement("div");
                        div.className = "alert alert-success";
                        var remove = 'removeAlert(this)';
                        div.setAttribute('onclick', remove);
                        div.innerHTML = "L'image a bien été ajoutée à la recette.";
                        alertes.appendChild(div);
                    }
                });
        }
    }));

    //AJAX REQUEST
    async function editPicture(obj) {
        var myHeaders = new Headers();

        let formData = new FormData(obj);

        var myInit = {
            method: 'POST',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData
        };
        let response = await fetch(ROOT + 'recipes/edit/' + idRecipe + '/editpicture', myInit);
        try {
            if (response.ok) {
                return await response.json();
            } else {
                return false;
            }
        } catch (e) {
            console.error(e.message);
        }
    }

    const buttonDeletePicture = document.querySelector("#button-delete-picture-recipe");

    buttonDeletePicture.addEventListener('click', function () {

        deletePicture()
            .then((response) => {
                if (response) {
                    const divPicture = document.querySelector("#display-img-recipe");
                    divPicture.style.backgroundImage = "";

                    // Add alerte
                    var alertes = document.querySelector("#alertes-recipe-image");
                    console.log(alertes);
                    alertes.innerHTML = "";
                    var div = document.createElement("div");
                    div.className = "alert alert-danger";
                    var remove = 'removeAlert(this)';
                    div.setAttribute('onclick', remove);
                    div.innerHTML = "L'image a bien été supprimée de la recette.";
                    alertes.appendChild(div);
                };
            });
    });


    // AJAX REQUEST
    async function deletePicture() {

        var myHeaders = new Headers();
        let formData = new FormData();
        formData.append('id_recipe', idRecipe);

        var myInit = {
            method: 'POST',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData
        };

        let response = await fetch(ROOT + 'recipes/edit/' + idRecipe + '/deletepicture', myInit);

        try {
            if (response.ok) {
                return await response.json();

            } else {
                return false;
            }
        } catch (e) {
            console.error(e.message);
        }
    }

});

// --------------------------------------- PREPARATION PART ------------------------------------

document.addEventListener("DOMContentLoaded", function () {

    constructParagraphs();

    function constructParagraphs() {

        loadParagraphs()
            .then((response) => {
                if (response) {
                    var stepsPreparation = document.querySelector("#stepsPreparation");
                    stepsPreparation.innerHTML = "";
                    var length = response.length;
                    response.forEach(element => {
                        renewTable(element, length);
                    });
                }
            });
    }


    // AJAX REQUEST
    async function loadParagraphs() {

        var myHeaders = new Headers();
        let formData = new FormData();
        formData.append('id_recipe', idRecipe);

        var myInit = {
            method: 'POST',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData
        };

        let response = await fetch(ROOT + 'recipes/edit/' + idRecipe + '/loadparagraphs', myInit);

        try {
            if (response.ok) {
                return await response.json();

            } else {
                return false;
            }
        } catch (e) {
            console.error(e.message);
        }
    }


    // ------------------------ Add paragraph ----------------------------------

    const buttonAddStepPreparation = document.querySelector("#buttonAddStepPreparation");

    buttonAddStepPreparation.addEventListener('click', function () {

        addParagraphDB()
            .then((response) => {
                if (response) {
                    var stepsPreparation = document.querySelector("#stepsPreparation");
                    stepsPreparation.innerHTML = "";
                    var length = response.length;
                    response.forEach(element => {
                        renewTable(element, length)

                        var alertes = document.querySelector("#alertes-recipe-preparations");
                        alertes.innerHTML = "";
                        var div = document.createElement("div");
                        div.className = "alert alert-success";
                        var remove = 'removeAlert(this)';
                        div.setAttribute('onclick', remove);
                        div.innerHTML = "Une étape de préparation a bien été ajoutée à la recette";
                        alertes.appendChild(div);
                    });
                }
            });
    });

    // AJAX REQUEST
    async function addParagraphDB() {

        var myHeaders = new Headers();
        let formData = new FormData();
        formData.append('id_recipe', idRecipe);

        var myInit = {
            method: 'POST',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData
        };

        let response = await fetch(ROOT + 'recipes/edit/' + idRecipe + '/addparagraph', myInit);

        try {
            if (response.ok) {
                return await response.json();

            } else {
                return false;
            }
        } catch (e) {
            console.error(e.message);
        }
    }

    function renewTable(element, length) {

        // Create elements
        var newRow = document.createElement("div");
        var buttonsColumn = document.createElement("div");
        var arrowUp = document.createElement("a");
        var iconArrowUp = document.createElement("i");
        var arrowDown = document.createElement("a");
        var iconArrowDown = document.createElement("i");
        var trash = document.createElement("a");
        var iconTrash = document.createElement("i");
        var textAreaColumn = document.createElement("div");
        var textArea = document.createElement("textarea");

        // AppendChild Element
        stepsPreparation.appendChild(newRow);
        newRow.appendChild(buttonsColumn);
        newRow.appendChild(textAreaColumn);
        textAreaColumn.appendChild(textArea);

        if (element.order_paragraph == 1) {
            buttonsColumn.appendChild(arrowDown);
            arrowDown.appendChild(iconArrowDown);
            arrowDown.className = "mb-2";
            iconArrowDown.className = "fas fa-caret-square-down";
        }
        else if (element.order_paragraph == length) {
            buttonsColumn.appendChild(arrowUp);
            arrowUp.appendChild(iconArrowUp);
            arrowUp.className = "mb-2";
            iconArrowUp.className = "fas fa-caret-square-up";

        } else {
            buttonsColumn.appendChild(arrowUp);
            arrowUp.appendChild(iconArrowUp);
            buttonsColumn.appendChild(arrowDown);
            arrowDown.appendChild(iconArrowDown);
            arrowUp.className = "mb-2";
            arrowDown.className = "mb-2";
            iconArrowDown.className = "fas fa-caret-square-down";
            iconArrowUp.className = "fas fa-caret-square-up";
        }

        buttonsColumn.appendChild(trash);
        trash.appendChild(iconTrash);

        // Add classes and features
        newRow.className = "row d-flex justify-content-between paragraph-line mb-4";
        buttonsColumn.className = "col-1 d-flex flex-column";
        textAreaColumn.className = "col-11";
        textArea.className = "paragraph-content bg-white border border-info rounded w-100";
        textArea.rows = "6";
        iconTrash.className = "fas fa-trash";
        iconTrash.setAttribute('data-bs-toggle', 'modal');
        iconTrash.setAttribute('data-bs-target', '#deletePreparation');

        newRow.setAttribute('data-id-recipe', element.fk_id_recipes);
        newRow.setAttribute('data-id-paragraph', element.id_paragraph);
        newRow.setAttribute('data-order', element.order_paragraph);
        textArea.innerHTML = element.content_paragraph;

        addEventListenerContentParagraph();
        addEventListenerDeleteParagraph(iconTrash);
        addEventListenerArrowUp(iconArrowUp);
        addEventListenerArrowDown(iconArrowDown);
    }

    function addEventListenerContentParagraph() {
        var paragraphContents = document.querySelectorAll(".paragraph-content");

        paragraphContents.forEach(content => content.addEventListener('blur', function () {
            paragraph = content.parentNode.parentNode;
            id_recipe = paragraph.getAttribute('data-id-recipe');
            id_paragraph = paragraph.getAttribute('data-id-paragraph');
            content_paragraph = content.value;
            order_paragraph = paragraph.getAttribute('data-order');
            addContentParagraphDB(id_recipe, id_paragraph, content_paragraph, order_paragraph);
        }));

    }

    // AJAX REQUEST
    async function addContentParagraphDB(id_recipe, id_paragraph, content_paragraph, order_paragraph) {

        var myHeaders = new Headers();

        let formData = new FormData();
        formData.append('id_recipe', id_recipe);
        formData.append('id_paragraph', id_paragraph);
        formData.append('content_paragraph', content_paragraph);
        formData.append('order_paragraph', order_paragraph);

        var myInit = {
            method: 'POST',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData
        };

        let response = await fetch(ROOT + 'recipes/edit/' + idRecipe + '/addcontentparagraph', myInit);

        try {
            if (response.ok) {
                return await response.json();

            } else {
                return false;
            }
        } catch (e) {
            console.error(e.message);
        }

    }

    function addEventListenerDeleteParagraph(button) {

        button.addEventListener('click', function () {

            var modalDeletePreparation = document.querySelector("#button-delete-preparation-recipe");

            modalDeletePreparation.onclick = function () {
                deleteParagraphLine(button);
            };
        })
    }

    function deleteParagraphLine(button) {

        // Get Values
        paragraph = button.parentNode.parentNode.parentNode;
        id_recipe = paragraph.getAttribute('data-id-recipe');
        id_paragraph = paragraph.getAttribute('data-id-paragraph');
        order_paragraph = paragraph.getAttribute('data-order');

        deleteParagraphDB(id_recipe, id_paragraph, order_paragraph)
            .then((response) => {
                if (response) {
                    var stepsPreparation = document.querySelector("#stepsPreparation");
                    stepsPreparation.innerHTML = "";

                    var length = response.length;
                    response.forEach(element => {
                        renewTable(element, length);
                    });

                    var alertes = document.querySelector("#alertes-recipe-preparations");
                    alertes.innerHTML = "";
                    var div = document.createElement("div");
                    div.className = "alert alert-danger";
                    var remove = 'removeAlert(this)';
                    div.setAttribute('onclick', remove);
                    div.innerHTML = "L'étape de préparation a bien été supprimée.";
                    alertes.appendChild(div);
                }
            });
    }

    // AJAX REQUEST
    async function deleteParagraphDB(id_recipe, id_paragraph, order_paragraph) {

        var myHeaders = new Headers();

        let formData = new FormData();
        formData.append('id_recipe', id_recipe);
        formData.append('id_paragraph', id_paragraph);
        formData.append('order_paragraph', order_paragraph);

        var myInit = {
            method: 'POST',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData
        };

        let response = await fetch(ROOT + 'recipes/edit/' + idRecipe + '/deleteparagraph', myInit);

        try {
            if (response.ok) {
                return await response.json();

            } else {
                return false;
            }
        } catch (e) {
            console.error(e.message);
        }
    }

    function addEventListenerArrowUp(button) {
        button.addEventListener('click', function () {
            moveUpParagraphLine(button);
        });
    }


    function moveUpParagraphLine(button) {

        // Get Values
        paragraph = button.parentNode.parentNode.parentNode;

        id_recipe = paragraph.getAttribute('data-id-recipe');
        id_paragraph = paragraph.getAttribute('data-id-paragraph');
        order_paragraph = paragraph.getAttribute('data-order');

        moveUpParagraphsDB(id_recipe, id_paragraph, order_paragraph)
            .then((response) => {
                if (response) {
                    var stepsPreparation = document.querySelector("#stepsPreparation");
                    stepsPreparation.innerHTML = "";

                    var length = response.length;
                    response.forEach(element => {
                        renewTable(element, length);
                    });

                    var alertes = document.querySelector("#alertes-recipe-preparations");
                    alertes.innerHTML = "";
                    var div = document.createElement("div");
                    div.className = "alert alert-success";
                    var remove = 'removeAlert(this)';
                    div.setAttribute('onclick', remove);
                    div.innerHTML = "L'étape de préparation a bien été déplacée vers le haut.";
                    alertes.appendChild(div);
                }
            });
    }

    // AJAX REQUEST
    async function moveUpParagraphsDB(id_recipe, id_paragraph, order_paragraph) {

        var myHeaders = new Headers();

        let formData = new FormData();
        formData.append('id_recipe', id_recipe);
        formData.append('id_paragraph', id_paragraph);
        formData.append('order_paragraph', order_paragraph);

        var myInit = {
            method: 'POST',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData
        };

        let response = await fetch(ROOT + 'recipes/edit/' + idRecipe + '/moveupparagraphs', myInit);

        try {
            if (response.ok) {
                return await response.json();

            } else {
                return false;
            }
        } catch (e) {
            console.error(e.message);
        }
    }

    function addEventListenerArrowDown(button) {
        button.addEventListener('click', function () {
            moveDownParagraphLine(button);
        });
    }


    function moveDownParagraphLine(button) {

        // Get Values
        paragraph = button.parentNode.parentNode.parentNode;

        id_recipe = paragraph.getAttribute('data-id-recipe');
        id_paragraph = paragraph.getAttribute('data-id-paragraph');
        order_paragraph = paragraph.getAttribute('data-order');

        moveDownParagraphsDB(id_recipe, id_paragraph, order_paragraph)
            .then((response) => {
                if (response) {
                    var stepsPreparation = document.querySelector("#stepsPreparation");
                    stepsPreparation.innerHTML = "";

                    var length = response.length;
                    response.forEach(element => {
                        renewTable(element, length);
                    });

                    var alertes = document.querySelector("#alertes-recipe-preparations");
                    alertes.innerHTML = "";
                    var div = document.createElement("div");
                    div.className = "alert alert-success";
                    var remove = 'removeAlert(this)';
                    div.setAttribute('onclick', remove);
                    div.innerHTML = "L'étape de préparation a bien été déplacée vers le bas.";
                    alertes.appendChild(div);
                }
            });
    }

    // AJAX REQUEST
    async function moveDownParagraphsDB(id_recipe, id_paragraph, order_paragraph) {

        var myHeaders = new Headers();

        let formData = new FormData();
        formData.append('id_recipe', id_recipe);
        formData.append('id_paragraph', id_paragraph);
        formData.append('order_paragraph', order_paragraph);

        var myInit = {
            method: 'POST',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData
        };

        let response = await fetch(ROOT + 'recipes/edit/' + idRecipe + '/movedownparagraphs', myInit);

        try {
            if (response.ok) {
                return await response.json();

            } else {
                return false;
            }
        } catch (e) {
            console.error(e.message);
        }
    }

});