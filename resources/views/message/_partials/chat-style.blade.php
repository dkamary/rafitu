{{-- Chat style --}}

<style id="chat-styles">
    form.chat * {
        transition: all .5s;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    form.chat {
        margin: 0;
        cursor: default;
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        top: 0;
        -webkit-touch-callout: none;
        /* iOS Safari */
        -webkit-user-select: none;
        /* Chrome/Safari/Opera */
        -khtml-user-select: none;
        /* Konqueror */
        -moz-user-select: none;
        /* Firefox */
        -ms-user-select: none;
        /* IE/Edge */
        user-select: none;
    }

    form.chat span.spinner {
        -moz-animation: loading-bar 1s 1;
        -webkit-animation: loading-bar 1s 1;
        animation: loading-bar 1s 1;
        display: block;
        height: 2px;
        background-color: #00e34d;
        transition: width 0.2s;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        z-index: 10004
    }

    form.chat .messages {
        display: block;
        overflow-x: hidden;
        overflow-y: scroll;
        position: relative;
        height: 90%;
        width: 100%;
        padding: 2% 3%;
        border-bottom: 1px solid #ecf0f1;
    }

    form.chat ::-webkit-scrollbar {
        width: 3px;
        height: 1px;
        transition: all .5s;
        z-index: 100010;
    }

    form.chat ::-webkit-scrollbar-track {
        background-color: white;
    }

    form.chat ::-webkit-scrollbar-thumb {
        background-color: #bec4c8;
        border-radius: 3px;
    }

    form.chat .message {
        display: block;
        width: 98%;
        padding: 0.5%;
    }

    form.chat .message p {
        margin: 0;
    }

    form.chat .myMessage,
    form.chat .fromThem {
        max-width: 50%;
        word-wrap: break-word;
        margin-bottom: 20px;
    }

    form.chat .message:hover .myMessage {
        -webkit-transform: translateX(-130px);
        transform: translateX(-130px);
    }

    form.chat .message:hover .fromThem {
        -webkit-transform: translateX(130px);
        transform: translateX(130px);
    }

    form.chat .message:hover date {
        opacity: 1;
    }

    form.chat .myMessage,
    .fromThem {
        position: relative;
        padding: 10px 20px;
        color: white;
        border-radius: 25px;
        clear: both;
        font: 400 15px 'Open Sans', sans-serif;
    }

    form.chat .myMessage {
        background: #4c6dff;
        color: white;
        float: right;
        clear: both;
        border-bottom-right-radius: 20px 0px\9;
    }

    form.chat .myMessage:before {
        content: "";
        position: absolute;
        z-index: 10001;
        bottom: -2px;
        right: -8px;
        height: 19px;
        border-right: 20px solid #4c6dff;
        border-bottom-left-radius: 16px 14px;
        -webkit-transform: translate(0, -2px);
        transform: translate(0, -2px);
        border-bottom-left-radius: 15px 0px\9;
        transform: translate(-1px, -2px)\9;
    }

    form.chat .myMessage:after {
        content: "";
        position: absolute;
        z-index: 10001;
        bottom: -2px;
        right: -42px;
        width: 12px;
        height: 20px;
        background: white;
        border-bottom-left-radius: 10px;
        -webkit-transform: translate(-30px, -2px);
        transform: translate(-30px, -2px);
    }

    form.chat .fromThem {
        background: #E5E5EA;
        color: black;
        float: left;
        clear: both;
        border-bottom-left-radius: 30px 0px\9;
    }

    form.chat .fromThem:before {
        content: "";
        position: absolute;
        z-index: 10002;
        bottom: -2px;
        left: -7px;
        height: 19px;
        border-left: 20px solid #E5E5EA;
        border-bottom-right-radius: 16px 14px;
        -webkit-transform: translate(0, -2px);
        transform: translate(0, -2px);
        border-bottom-right-radius: 15px 0px\9;
        transform: translate(-1px, -2px)\9;
    }

    form.chat .fromThem:after {
        content: "";
        position: absolute;
        z-index: 10003;
        bottom: -2px;
        left: 4px;
        width: 26px;
        height: 20px;
        background: white;
        border-bottom-right-radius: 10px;
        -webkit-transform: translate(-30px, -2px);
        transform: translate(-30px, -2px);
    }

    form.chat date {
        position: absolute;
        top: 10px;
        font-size: 14px;
        white-space: nowrap;
        vertical-align: middle;
        color: #8b8b90;
        opacity: 0;
        z-index: 10004;
    }

    form.chat .myMessage date {
        left: 105%;
    }

    form.chat .fromThem date {
        right: 105%;
    }

    form.chat input {
        /* font: 400 13px 'Open Sans', sans-serif; */
        border: solid 1px #efefef;
        /* padding: 0 15px;
        height: 10%;
        outline: 0; */
        width: 100%;
    }

    /* form.chat input[type='text'] {
        width: 73%;
        float: left;
    } */

    form.chat input[type='submit'],
    form.chat button[type="submit"] {
        width: 23%;
        background: transparent;
        /* color: #00E34D; */
        color: #ffffff;
        font-weight: 700;
        text-align: right;
        float: right;
        border: none;
    }

    form.chat .myMessage,
    form.chat .fromThem {
        font-size: 12px;
    }

    form.chat .message:hover .myMessage {
        transform: translateY(18px);
        -webkit-transform: translateY(18px);
    }

    form.chat .message:hover .fromThem {
        transform: translateY(18px);
        -webkit-transform: translateY(18px);
    }

    form.chat .myMessage date,
    form.chat .fromThem date {
        top: -20px;
        left: auto;
        right: 0;
        font-size: 12px;
    }

    form.chat .myMessage,
    form.chat .fromThem {
        max-width: 90%;
    }

    @-moz-keyframes loading-bar {
        0% {
            width: 0%;
        }

        90% {
            width: 90%;
        }

        100% {
            width: 100%;
        }
    }

    @-webkit-keyframes loading-bar {
        0% {
            width: 0%;
        }

        90% {
            width: 90%;
        }

        100% {
            width: 100%;
        }
    }

    @keyframes loading-bar {
        0% {
            width: 0%;
        }

        90% {
            width: 90%;
        }

        100% {
            width: 100%;
        }
    }

    /* DEMO */
    .chat-container {
        width: 400px;
        min-width: 300px;
        max-width: 100vw;
        max-height: 100vh;
        height: 5rem;

        margin: 0 auto;
        position: fixed;
        right: 1%;
        bottom: 0%;
        transition: .8s;
        overflow: hidden;
        z-index: 99999;
    }

    .chat-container.show {
        height: 300px;
        min-height: 300px;
        background-color: #ffffff;
        border: solid 2px #cfcfcf;
        border-radius: 5px 5px 0px 0px;
    }

    .chat-container.show .border {
        display: block;
    }

    .chat-container .border {
        position: absolute;
        top: 16%;
        right: 2%;
        left: 2%;
        bottom: 2%;
        overflow: hidden;
        border: none !important;
        display: none;
    }

    a.article {
        position: fixed;
        bottom: 15px;
        left: 15px;
        display: table;
        text-decoration: none;
        color: white;
        background-color: #4c6dff;
        padding: 10px 20px;
        border-radius: 25px;
        font: 400 15px 'Open Sans', sans-serif;
    }

    #discussion-toggle {
        border-radius: 50%;
        text-align: center;
        box-shadow: 0px 0px 5px 5px rgba(255, 255, 255, .3);
        margin-top: 10px;
        transition: .5s;
    }

    #discussion-toggle i.fa {
        font-size: 2rem;
    }

    #discussion-toggle .text {
        display: none;
        opacity: 0;
        transition: .5s;
    }

    .button-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 5px;
        z-index: 100000;
    }

    .chat-container.show #discussion-toggle .text {
        display: inline-block;
        opacity: 1;
    }

    .chat-container.show #discussion-toggle {
        border-radius: 5px 5px 0px 0px;
        box-shadow: unset;
        margin-top: 0px;
        width: 100%;
    }
</style>
