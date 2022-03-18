const newMessage = document.querySelector('#new_message');

if(newMessage) {
    newMessage.addEventListener('click', () => {
        const xhr = new XMLHttpRequest();
        xhr.responseType = 'json';

        const body = {
            content: document.querySelector('#message').value
        };

        xhr.open('post', '/../api/add-message.php');

        xhr.onload = function() {
            if(xhr.status === 404) {
                alert('Aucun endpoint trouvé !');
            }
            else if(xhr.status === 400) {
                alert('Un paramètre est manquant');
            }
        }

        xhr.send(JSON.stringify(body));
    });

}

function displayMessage() {
    const xhr = new XMLHttpRequest();
    xhr.responseType = 'json';

    xhr.open('GET', '/../api/get-message.php');

    xhr.onload = function() {
        if(xhr.status === 404) {
            alert('Aucun endpoint trouvé !');
            return;
        }
        else if(xhr.status === 400) {
            alert('Un paramètre est manquant');
            return;
        }

        const response = xhr.response;
        console.log(response);
    }

    xhr.send();
}

displayMessage()