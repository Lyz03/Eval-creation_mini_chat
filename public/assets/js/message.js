const newMessage = document.querySelector('#new_message');
const messagesContainer = document.querySelector('.messages');
let lastId = 0;
if(newMessage) {
    // add a new message
    newMessage.addEventListener('click', () => {
        const xhr = new XMLHttpRequest();
        xhr.responseType = 'json';

        const body = {
            content: document.querySelector('#message').value
        };

        document.querySelector('#message').value = '';

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

   window.setInterval(displayMessage, 2000);

}

// get all messages to display them
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

        response.forEach(value => {

            if (lastId < value.id) {
                console.log(lastId)
                lastId = value.id;
                //container
                let div = document.createElement('div');

                if (value.sent)
                    div.className = 'sent';
                else
                    div.className = 'received';

                // username
                let span = document.createElement('span');
                span.innerText = value.username;

                // background color
                let div2 = document.createElement('div');

                // content
                let p = document.createElement('p');
                p.innerText = value.content;

                // time
                let span2 = document.createElement('span');
                span2.innerText = value.dateTime;

                messagesContainer.appendChild(div);
                div.appendChild(span);
                div.appendChild(div2);
                div2.appendChild(p);
                div.appendChild(span2);
            }
        })
    }

    xhr.send();
}