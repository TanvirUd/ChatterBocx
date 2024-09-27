import React, { useEffect, useRef, useState } from "react";
import Message from "./Message.jsx";
import MessageInput from "./MessageInput.jsx";
import { all } from "axios";

const ChatBox = ({ rootUrl }) => {
    const userData = document.getElementById('main')
        .getAttribute('data-user');
    const allUsersData = document.getElementById('main').getAttribute('data-all-users');

    const user = JSON.parse(userData);
    const allUsers = JSON.parse(allUsersData).filter(u => u.id !== user.id);
    const webSocketChannel = `App.Models.User.${user.id}`;

    const [messages, setMessages] = useState([]);
    const [recipientId, setRecipientId] = useState(allUsers[0].id);
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
            const filtered = m.data.filter(m => m.user_id === user.id && m.recipient_id === recipientId || m.user_id === recipientId && m.recipient_id === user.id);
            setMessages(filtered);
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
    }, [recipientId]);

    function renderAllUsers() {
        return allUsers?.map((u) => {
            if (u.id === user.id) {
                return null;
            }
            return (
                <div key={u.id} onClick={() => handleUserClick(u.id)} style={{cursor: "pointer"}}>
                    <p>{u.name}</p>
                </div>
            );
        })
    }

    function handleUserClick(userId) {
        setRecipientId(userId);
        console.log(recipientId);        
        // getMessages();
    }

    return (
        <div className="d-flex w-100 justify-content-center">
            <div className="w-25 card">
                <div className="card-header">Users</div>
                <div className="card-body">
                    {renderAllUsers()}
                </div>
                <div className="card-footer">
                    <a href="" className="" key={user.id}><p>{user.name}</p></a>
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
                            <MessageInput rootUrl={rootUrl} recipientId={recipientId}/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    );
};

export default ChatBox;