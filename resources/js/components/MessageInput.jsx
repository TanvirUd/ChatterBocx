import React, { useState } from "react";

const MessageInput = ({ rootUrl, recipientId}) => {
    const [message, setMessage] = useState("");    

    /**
     * Envoie un message à un utilisateur.
     * @param {string} text Le texte du message.
     * @returns {Promise<void>}
     */
    const messageRequest = async (text) => {
        try {
            // Envoie une requête POST à l'URL /message
            // avec l'id du destinataire et le texte du message.
            const response = await axios.post(`${rootUrl}/message`, {
                recipientId: recipientId,
                text,
            });
            // Affiche le message de retour (si il y en a un)
            console.log(response.data);
        } catch (err) {
            // Affiche l'erreur si elle arrive.
            console.log(err.message);
        }
    };

    /**
     * Envoie le message contenu dans l'input
     * Si le message est vide, affiche un message d'erreur.
     * @param {Event} e L'événement de soumission du formulaire.
     */
    const sendMessage = (e) => {
        e.preventDefault();
        if (message.trim() === "") {
            // Affiche un message d'erreur si le champ est vide.
            alert("Please enter a message!");
            return;
        }

        // Envoie la requête pour envoyer le message.
        messageRequest(message);
        // Vide le champ de saisie.
        setMessage("");
    };

    return (
        <div className="input-group">
            <input onChange={(e) => setMessage(e.target.value)}
                   autoComplete="off"
                   type="text"
                   className="form-control"
                   placeholder="Message..."
                   value={message}
            />
            <div className="input-group-append">
                <button onClick={(e) => sendMessage(e)}
                        className="btn btn-primary"
                        type="button">Send</button>
            </div>
        </div>
    );
};

export default MessageInput;