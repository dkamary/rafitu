{{-- Message Style --}}

<style id="message-style">
    .message-container {

    }

    .message-history {
        height: 80%;
    }

    .message-send-form {
        height: 20%;
    }

    .message-wrapper {
        padding: .5rem 1.5rem;
        border-radius: 5px;
        font-size: 1.1rem;
        display: flex;
        justify-content: start;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .message-wrapper .message-user {
        width: 3.5rem;
        height: 3.5rem;
        border: solid thin #848492;
        background-color: #fff;
        position: relative;
        overflow: hidden;
        border-radius: 50%;

    }

    .message-wrapper .message-user .avatar {
        display: block;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fff;
    }

    .message-wrapper .message-user .avatar img {
        width: auto;
        height: 100%;
    }

    .message-wrapper .message-user .state {
        display: block;
        width: 16px;
        height: 16px;
        background: #d13c0b;
        border-radius: 50%;
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
    }

    .message-wrapper .message-user .state.connected {
        background: #06a225;
    }

    .message-wrapper.me {
        justify-content: flex-end;
    }

    .message-wrapper.you {
        justify-content: flex-start;
    }

    .message-wrapper .message-item {
        max-width: 300px;
        min-width: 50px;
        padding: .5rem 1rem;
        border-radius: 1rem;
    }

    .message-wrapper.me .message-item {
        background-color: #4c6dff;
        color: #fff;
        border: solid 1px #3a59e5;
        align-self: flex-end;
    }

    .message-wrapper.you .message-item {
        background-color: #f1f7ff;
        color: #666666;
        border: solid 1px #848492;
        margin-left: 1rem;
    }

    .message-wrapper .message-info {
        font-size: .8rem;
        font-style: italic;
        font-weight: bold;
        width: 100%;
        color: #bdbdbd;
    }

    .message-wrapper.you .message-info {
        /* align-self: flex-start; */
    }

    .message-wrapper.me .message-info {
        text-align: right;
    }
</style>
