import React from "react";

/**
 * Composant React pour afficher un message.
 *
 * Props:
 *   - userId: l'ID de l'utilisateur connecté.
 *   - message: le message à afficher.
 *
 * Le composant utilise le nom de l'utilisateur qui a envoyé le message et
 * le timestamp de la création du message.
 *
 * Si l'ID de l'utilisateur connecté correspond à l'ID de l'utilisateur qui a
 * envoyé le message, le message est aligné à droite.
 *
 * Sinon, le message est aligné à gauche.
 */
const Message = ({ userId, message }) => {
    return (
        <div className={`row ${
        userId === message.user_id ? "justify-content-end" : ""
        }`}>
            <div className="col-md-6">
        <small className="text-muted">
                    <strong>{message.user.name} | </strong>
                </small>
                <small className="text-muted float-right">
                    {message.time}
                </small>
                <div className={`alert alert-${
                userId === message.user_id ? "primary" : "secondary"
                }`} role="alert">
                    {message.text}
                </div>
            </div>
        </div>
    );
};

export default Message;