// --------------------------------------- IMAGE PART ------------------------------------

document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("#formPictureArticle");

    form.addEventListener('submit', (function (e) {
        e.preventDefault();
        const img = document.querySelector("#InputFileEditArticle");
        if (img.value != "") {
            editPicture(this)
                .then((response) => {
                    if (response) {
                        const divPicture = document.querySelector("#display-img-article");
                        divPicture.style.backgroundImage = "url(" + response["path"] + ")";

                        // Add alerte
                        var alertes = document.querySelector("#alertes-article-image");
                        console.log(alertes);
                        alertes.innerHTML = "";
                        var div = document.createElement("div");
                        div.className = "alert alert-success";
                        var remove = 'removeAlert(this)';
                        div.setAttribute('onclick', remove);
                        div.innerHTML = "L'image a bien été ajoutée à l'article.";
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
        let response = await fetch(ROOT + 'articles/edit/' + idArticle + '/editpicture', myInit);
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

    const buttonDeletePicture = document.querySelector("#button-delete-picture-article");

    buttonDeletePicture.addEventListener('click', function () {

        deletePicture()
            .then((response) => {
                if (response) {
                    const divPicture = document.querySelector("#display-img-article");
                    divPicture.style.backgroundImage = "";

                     // Add alerte
                     var alertes = document.querySelector("#alertes-article-image");
                     console.log(alertes);
                     alertes.innerHTML = "";
                     var div = document.createElement("div");
                     div.className = "alert alert-danger";
                     var remove = 'removeAlert(this)';
                     div.setAttribute('onclick', remove);
                     div.innerHTML = "L'image a bien été supprimée de l'article.";
                     alertes.appendChild(div);
                };
            });
    });


    // AJAX REQUEST
    async function deletePicture() {

        var myHeaders = new Headers();
        let formData = new FormData();
        formData.append('id_article', idArticle);

        var myInit = {
            method: 'POST',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData
        };

        let response = await fetch(ROOT + 'articles/edit/' + idArticle + '/deletepicture', myInit);

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
