import React, { useEffect, useRef, useState } from "react";
import Message from "./Message.jsx";
import MessageInput from "./MessageInput.jsx";
import { all } from "axios";


const ChatBox = ({ rootUrl }) => {
    // Récupère les informations de l'utilisateur actuel en JSON
    // et les stocke dans la variable user.
    const userData = document.getElementById('main')
        .getAttribute('data-user');
    const allUsersData = document.getElementById('main').getAttribute('data-all-users');

    // Récupère les informations de l'utilisateur actuel en JSON
    const user = JSON.parse(userData);

    // Récupère tous les utilisateurs sauf l'utilisateur actuel
    // et les stocke dans la variable allUsers.
    const allUsers = JSON.parse(allUsersData).filter(u => u.id !== user.id);

    // Stocke l'id du destinataire courant dans l'état recipientId.
    const [recipientId, setRecipientId] = useState(allUsers[0].id);

    // Crée le nom du canal WebSocket privé de l'utilisateur actuel.
    // Ce canal est utilisé pour recevoir les messages entre l'utilisateur actuel et
    // les autres utilisateurs.
    const webSocketChannel = `App.Models.User.${user.id}.${recipientId}`;
    const webSocketChannel2 = `App.Models.User.${recipientId}.${user.id}`;

    // Stocke les messages entre l'utilisateur actuel et le destinataire courant
    // dans l'état messages.

    const [messages, setMessages] = useState([]);

    // Stocke une référence vers le bouton "Send" dans la constante scroll.
    // Ce bouton est utilisé pour scroller automatiquement vers le bas de la page
    // lorsque l'utilisateur actuel reçoit un message.
    const scroll = useRef();

    const [userListDisplay, setUserListDisplay] = useState(false);

    /**
     * Fait défiler la page jusqu'au bouton "Send" pour que l'utilisateur actuel
     * voie le message qu'il vient d'envoyer.
     * 
     * @since 1.0.0
     */
    const scrollToBottom = () => {
        scroll.current.scrollIntoView({ behavior: "smooth" });
    };


    /**
     * Fonction qui se connecte au canal WebSocket privé de l'utilisateur actuel.
     * Lorsqu'un message est reçu sur ce canal, la fonction {@link getMessages} est appelée.
     * Cela signifie que lorsque l'utilisateur actuel reçoit un message, il le reçoit en direct.
     */
    const connectWebSocket = () => {
        window.Echo.private(webSocketChannel).listen('GotMessage', async (e) => {
            // e.message est le message qui a été envoyé, mais on ne l'utilise pas ici.
            // Au lieu de cela, on appelle la fonction getMessages pour récupérer les messages
            // entre l'utilisateur actuel et le destinataire courant.
            await getMessages();
        });
        
        window.Echo.private(webSocketChannel2).listen('GotMessage', async (e) => {
            // e.message est le message qui a été envoyé, mais on ne l'utilise pas ici.
            // Au lieu de cela, on appelle la fonction getMessages pour récupérer les messages
            // entre l'utilisateur actuel et le destinataire courant.
            await getMessages();
        });
    }

    /**
     * Récupère les messages entre l'utilisateur actuel et le destinataire courant.
     * Les messages sont filtrés pour ne garder que les messages entre
     * l'utilisateur actuel et le destinataire courant.
     * @returns {Promise<void>}
     */
    const getMessages = async () => {
        try {
            const response = await axios.get(`${rootUrl}/messages`);
            const filtered = response.data.filter(m => m.user_id === user.id && m.recipient_id === recipientId || m.user_id === recipientId && m.recipient_id === user.id);
            setMessages(filtered);
            setTimeout(scrollToBottom, 0);
        } catch (err) {
            console.log(err.message);
        }
    };

    useEffect(() => {
        // Récupère les messages entre l'utilisateur actuel et le destinataire courant
        // et connecte le websocket pour écouter les évenements 'GotMessage'
        // qui sont déclenchés pour chaque message envoyé ou reçu par l'utilisateur
        getMessages();
        connectWebSocket();
        // Dès que l'utilisateur change de destinataire, on quitte le canal websocket
        // pour ne plus recevoir les mises à jour des messages du précédent destinataire
        return () => {
            window.Echo.leave(webSocketChannel);
        }
    }, []);

    /**
     * Fonction qui est appelée lorsque l'utilisateur clique sur un utilisateur
     * dans la liste des utilisateurs.
     * Cette fonction met à jour l'id du destinataire courant.
     * @param {number} userId L'id de l'utilisateur sur lequel on a cliqué.
     */
    function handleUserClick(userId) {
        setRecipientId(userId);
        getMessages();
    }

    function handleUserListToggle(){
        setUserListDisplay(!userListDisplay);
    }

    return (
        <div className="row show-grid position-relative">
            <div className={`col-lg-3 col-lg-push-8 col-md-4 col-md-push-0 col-sm-4 col-sm-push-8 ${userListDisplay ? 'user-list-display-active': 'user-list-display-none'}`}>
                <div className="col">
                    <div className="card">
                        {/* Affiche la liste des utilisateurs */}
                        <div className="card-header"><span className="text-muted btn btn-outline-secondary user-list-button " onClick={handleUserListToggle}>List</span>Utilisateurs</div>
                        <div className="card-body p-0" style={{height: "490px", overflowY: "auto"}}>
                            {allUsers?.map((u) => (
                                <div className={`p-2 ${recipientId === u.id ? "bg-primary text-light" : "bg-light user"} d-flex align-items-center gap-1`} key={u.id} onClick={() => handleUserClick(u.id)} style={{cursor: "pointer"}}>
                                    <img className="image rounded-circle user-img-small" src={`storage/images/${u.image}`} alt={`profile_image_user_${u.name}`} />
                                    <p className="m-0">{u.name}</p>
                                </div>
                            ))}
                            <span ref={scroll}></span>
                        </div>
                        {/* Affiche l'utilisateur actuel */}
                        <div className="card-footer d-flex align-items-center gap-1">
                            <img className="image rounded-circle user-img-small m-0" src={`storage/images/${user.image}`} alt={`profile_image_user_${user.name}`} />
                            <a href="/dashboard" className="card-link text-decoration-none color-dark" key={user.id}><p className="m-0">{user.name}</p></a>
                        </div>
                    </div>
                </div>
            </div>
            <div className="col-lg-8 col-lg-pull-4 col-md-8 col-md-pull-0 col-sm-8 col-sm-pull-4">
                <div className="col-md-8">
                    <div className="card">
                        {/* En-tête de la boîte de conversation */}
                        <div className="card-header"><span className="text-muted btn btn-outline-secondary user-list-button " onClick={handleUserListToggle}>List</span> Boîte de conversation</div>
                        {/* Corps de la boîte de conversation */}
                        <div className="card-body"
                            style={{height: "500px", overflowY: "auto"}}>
                            {/* Affiche les messages reçus */}
                            {
                                messages?.map((message) => (
                                    <Message key={message.id}
                                            userId={user.id}
                                            message={message}
                                    />
                                ))
                            }
                            {/* Affiche le bouton de scroll en bas de page */}
                            <span ref={scroll}></span>
                        </div>
                        {/* Pied de page de la boîte de conversation */}
                        <div className="card-footer">
                            {/* Composant pour saisir un message */}
                            <MessageInput rootUrl={rootUrl} recipientId={recipientId}/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ChatBox;
