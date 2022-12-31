{{-- Messagerie.js --}}

<script id="messagerie-script">
    window.addEventListener("DOMContentLoaded", event => {
        handleStartChat();
    });

    const createChatContainer = () => {
        const container = document.createElement('div');
        container.id = 'chat-container';

    };

    const createChat = ({ message }) => {

        let chatContainer = document.querySelector('#chat-container');
        if(!chatContainer) {
            chatContainer = null;
        }

        const container = document.createElement('div');
        container.id = '#conversation-' + message.token;

        return container;
    };

    const handleStartChat = () => {
        console.info('Handle Start Chat!');

        const form = document.querySelector("#chat-start-form");
        if(!form) {
            console.debg("No Start Chat form in this page!!!");

            return;
        }

        form.addEventListener("submit", e => {
            e.preventDefault();
            formData = new FormData(form);

            console.debug({ formData });

            fetch('{{ route('message_send') }}', {
                method: 'post',
                body: formData,
            })
            .then(response => response.json())
            .then(jsonResponse => {
                console.debug(jsonResponse);
                if(!jsonResponse) {
                    console.warn("No response!!!");

                    return;
                }

                if(!jsonResponse.done) {
                    alert(jsonResponse.message);

                    return;
                }

                // Ajouter le nouveau message
                addNewMessage({ message: jsonResponse.message });
            })
            // .catch(err => {
            //     console.error({ err });
            // });
        })
    };

    const addNewMessage = ({ message }) => {
        let container = document.querySelector('#conversation-' + message.token);
        if(!container) {
            console.warn("Impossible de sélectionner le container de conversation `%`", ('#conversation-' + message.token));

            container = createChat({ message })

            return;
        }

        const msgText = document.createElement('div');
        msgText.classList.add('message__text');
        msgText.innerText = message.content;

        const msgBallon = document.createElement('div');
        msgBallon.classList.add('message__ballon');
        msgBallon.appendChild(msgText);

        const msg = document.createElement('div');
        msg.classList.add('message__container');
        msg.appendChild(msgBallon);

        container.appendChild(msg);
    }
</script>
