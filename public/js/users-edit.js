document.addEventListener("DOMContentLoaded", function () {

    const commandsTable = document.querySelector("#commandsUserTable");  // Get the table

    /**
     * On click on one of the table rows, the user gets the details of the command in another div
     */
    commandsTable.addEventListener('click', function () {
        const idCommand = event.target.parentNode.getAttribute('id');  // Get ID command

        getCommandDetails(idCommand)
        .then((response) => {
        
            if (response) {
                const detailsCommandsUser = document.querySelector("#detailsCommandsUser");
                detailsCommandsUser.innerHTML = "";
                
                response['article-command'].forEach((element, index) => {

                    // Creation of the row which contain the information
                    const row = document.createElement("row");
                    row.className= "d-flex justify-content-between";
                    row.innerHTML = element;
                    const link = document.createElement("a");
                    link.innerHTML = "Voir";
                    link.href = "https://teillier.needemand.com/realisations/Projet_Nesti/Nesti-Project-CodeIgniter/public/article/" + response['id-article-command'][index];
                    
                    row.appendChild(link);
                    // Add the article line(s) to the divList
                    detailsCommandsUser.appendChild(row);
                   
                })

                document.querySelector("#idCommandUserSelected").innerHTML = "ID n°" + idCommand;
            }
        });
    });

    /**
     * Ajax Request to get the articles from the orderLines according to the order
     * @param int orderId
     * @returns mixed
     */
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

        let response = await fetch(ROOT + 'users/edit', myInit);

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