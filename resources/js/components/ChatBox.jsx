import React, { useEffect, useRef, useState } from "react";
import Message from "./Message.jsx";
import MessageInput from "./MessageInput.jsx";
import { all } from "axios";

const ChatBox = ({ rootUrl }) => {
    const userData = document.getElementById('main')
        .getAttribute('data-user');
    const allUsersData = document.getElementById('main').getAttribute('data-all-users');

    const user = JSON.parse(userData);
    const allUsers = JSON.parse(allUsersData);
    // `App.Models.User.${user.id}`;
    const webSocketChannel = `channel_for_everyone`;

    const [messages, setMessages] = useState([]);
    const scroll = useRef();

    const scrollToBottom = () => {
        scroll.current.scrollIntoView({ behavior: "smooth" });
    };

    const connectWebSocket = () => {
        window.Echo.private(webSocketChannel)
            .listen('GotMessage', async (e) => {
                // e.message
                await getMessages();
            });
    }

    const getMessages = async () => {
        try {
            const m = await axios.get(`${rootUrl}/messages`);
            setMessages(m.data);
            setTimeout(scrollToBottom, 0);
        } catch (err) {
            console.log(err.message);
        }
    };

    useEffect(() => {
        getMessages();
        connectWebSocket();

        return () => {
            window.Echo.leave(webSocketChannel);
        }
    }, []);

    function renderAllUsers() {
        return allUsers?.map((u) => {
            if (u.id === user.id) {
                return null;
            }
            return (
                <a href="">
                    <div key={u.id}>
                        <p>{u.name}</p>
                    </div>
                </a>
            );
        })
    }

    return (
        <div className="d-flex w-100 justify-content-center">
            <div className="w-25 card">
                <div className="card-header">Users</div>
                <div className="card-body">
                    {renderAllUsers()}
                </div>
                <div className="card-footer">
                    <a href="" className=""><p>{user.name}</p></a>
                </div>
            </div>
            <div className="row w-75">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Chat Box</div>
                        <div className="card-body"
                            style={{height: "500px", overflowY: "auto"}}>
                            {
                                messages?.map((message) => (
                                    <Message key={message.id}
                                            userId={user.id}
                                            message={message}
                                    />
                                ))
                            }
                            <span ref={scroll}></span>
                        </div>
                        <div className="card-footer">
                            <MessageInput rootUrl={rootUrl} />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    );
};

export default ChatBox;