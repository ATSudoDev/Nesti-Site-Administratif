document.addEventListener("DOMContentLoaded", function () {

    const commandsTable = document.querySelector("#allCommandsTable");  // Get the table

    commandsTable.addEventListener('click', function () {
        const idCommand = event.target.parentNode.getAttribute('id');  // Get ID command

        getCommandDetails(idCommand)
        .then((response) => {
        
            if (response) {
                const detailsCommand = document.querySelector("#detailsCommands");
                detailsCommand.innerHTML = "";
                
                response['article-command'].forEach((element, index) => {
                    const row = document.createElement("row");
                    row.className= "d-flex justify-content-between";
                    row.innerHTML = element;
                    const link = document.createElement("a");
                    link.innerHTML = "Voir";
                    link.href = "https://teillier.needemand.com/realisations/Projet_Nesti/Nesti-Project-CodeIgniter/public/article/" + response['id-article-command'][index];
                    
                    row.appendChild(link);
                    detailsCommand.appendChild(row);
                    // add the articles lines to the divList
                })

                document.querySelector("#idCommandSelected").innerHTML = "ID n°" + idCommand;
            }
        });
    });

   // AJAX REQUEST
    async function getCommandDetails(commandID) {

        var myHeaders = new Headers();
        let formData = new FormData();

        formData.append('id_command', commandID);

        var myInit = {
            method: 'POST',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData
        };

        let response = await fetch(ROOT + 'articles/commands', myInit);

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