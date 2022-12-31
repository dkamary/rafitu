/*

Name    : Responsive HTML5 Chat

Responsive HTML5 Chat helps you to create useful chatbox on your website easly.
You can change skin and sizes. You can read the installation and support documentation
before you begin. If you do not find the answer, do not hesitate to send a message to me.

Owner   : Vatanay Ozbeyli
Web     : www.vatanay.com
Support : hi@vatanay.com

*/

@php
    $user = Auth::user();
    $userId = $user ? $user->id : 'null';
    $userName = $user ? $user->firstname : 'null';
@endphp

(function($, window, document){
    $(function(){

        $('#discussion-toggle').click(e => {
            e.preventDefault();
            $('.chat-container').toggleClass('show');
        });

        function showLatestMessage(element) {
            $('.responsive-html5-chat').find('.messages').scrollTop($('.responsive-html5-chat .messages')[0].scrollHeight);
        }

        function getConversation(element, token) {
            $.ajax({
                type: 'get',
                url: '{{ route("message_conversation") }}',
                data: { token: token },
                beforeSend: () => {
                    $(element + ' div.messages .message').each(msg => {
                        console.info(msg);
                        msg.remove();
                    });
                }
            }).done(response => {
                if(response.conversation) {
                    response.conversation.forEach(msg => {
                        responsiveChatPush(
                            element,
                            msg.sender == null ? 'Rafitu' : userName,
                            msg.sender == null ? 'you' : 'me',
                            msg.date_sent,
                            msg.content,
                            msg.id
                        );
                    });
                }
            })
            .fail(xhr => {
                alert(xhr.status + ' - ' + xhr.statusText);
            })
            .always(() => {
                showLatestMessage(element);
            });
        }

        function updateConversation(element, token) {
            console.debug("Update conversation!");

            if(!token) {
                console.debug("abort! No token!");
                return;
            }

            console.debug("Requesting!");

            $.ajax({
                type: 'get',
                url: '{{ route("message_last") }}',
                data: { token: token }
            }).done(response => {

                if(response.message.id > 0 && response.message.sender == null && response.message.content.length > 0) {
                    console.debug("RAFITU message is the last");
                    const msg = response.message;

                    if(document.querySelector('#message-' + msg.id)) {
                        console.debug("MSG Déjà présent");
                        return;
                    }

                    responsiveChatPush(
                        element,
                        !msg.sender ? 'Rafitu' : userName,
                        !msg.sender ? 'you' : 'me',
                        msg.date_sent,
                        msg.content,
                        msg.id
                    );
                } else {
                    console.debug("Client message is the last or No new message");
                }
            })
            .fail(xhr => {
                alert(xhr.status + ' - ' + xhr.statusText);
            })
            .always(() => {
                showLatestMessage(element);
            });
        }

        function responsiveChat(element) {
            $(element).html('<form class="chat"><span></span><div class="messages"></div><div class="d-flex p-2 w-100 justify-content-between align-items-center bg-rafitu"><input type="text" class="" placeholder="Votre message"><button type="submit" class=""><i class="fa fa-paper-plane" aria-hidden="true"></i></button></div></form>');

            if(localStorage.getItem('message_token')) {
                getConversation(element, localStorage.getItem('message_token'));
            } else {
                showLatestMessage(element);
            }

            $(element + ' input[type="text"]').keypress(function (event) {
                if (event.which == 13) {
                    event.preventDefault();
                    $(element + ' button[type="submit"]').click();
                }
            });
            $(element + ' button[type="submit"]').click(function (event) {
                event.preventDefault();
                var message = $(element + ' input[type="text"]').val();
                if ($(element + ' input[type="text"]').val()) {

                    $.ajax({
                        type: 'post',
                        url: '{{ route("message_send") }}',
                        data: {
                            token: localStorage.getItem('message_token'),
                            message: message.trim(),
                            user_id: null,
                            client_id: userId,
                            sender: userId
                        },
                        beforeSend: () => {
                            $(element + ' > span').addClass("spinner");
                        }
                    }).done(response => {
                        if(response.done) {
                            localStorage.setItem('message_token', response.message.token);
                        }

                        $(element + ' div.messages').append(
                            '<div class="message" id="message-' + response.message.id + '"><div class="myMessage"><p>' +
                            message +
                            "</p><date>" +
                            response.message.date_sent +
                            "</date></div></div>"
                        );
                    }).fail(xhr => {
                        alert(xhr.status + ' - ' + xhr.statusText);
                    }).always(() => {
                        $(element + ' > span').removeClass("spinner");
                        $(element + ' input[type="text"]').val("");
                    });
                }
                showLatestMessage(element);
            });

            setInterval(() => {
                updateConversation(element, localStorage.getItem('message_token'));
            }, 3000);
        }

        function responsiveChatPush(element, sender, origin, date, message, id) {
            var originClass;
            if (origin == 'me') {
                originClass = 'myMessage';
            } else {
                originClass = 'fromThem';
            }
            $(element + ' .messages').append('<div class="message" id="message-' + id + '"><div class="' + originClass + '"><p>' + message + '</p><date><b>' + sender + '</b> ' + date + '</date></div></div>');
        }

        /* Activating chatbox on element */
        responsiveChat('.responsive-html5-chat');

        /* Let's push some dummy data */
        // responsiveChatPush('.chat', 'Kate', 'me', '08.03.2017 14:30:7', 'It looks beautiful!');
        // responsiveChatPush('.chat', 'John Doe', 'you', '08.03.2016 14:31:22', 'It looks like the iPhone message box.');
        // responsiveChatPush('.chat', 'Kate', 'me', '08.03.2016 14:33:32', 'Yep, is this design responsive?');
        // responsiveChatPush('.chat', 'Kate', 'me', '08.03.2016 14:36:4', 'By the way when I hover on my message it shows date.');
        responsiveChatPush('.chat', '{{ isset($driver) ? $driver->firstname : "Rafitu" }}', 'you', '{{ date("d/m/Y H:i:s") }}', 'Que pouvons-nous faire pour vous ?', 0);

        /* DEMO */
        if (parent == top) {
            $("a.article").show();
        }
    });
}(window.jQuery, window, window.document));

var userId = {{ $userId }};
var userName = '{{ $userName }}';
