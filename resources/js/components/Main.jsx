import React from 'react';
import ReactDOM from 'react-dom/client';
import '../../css/app.css';
import ChatBox from "./ChatBox.jsx";

// Vérifie si l'élément HTML "main" existe dans le DOM
if (document.getElementById('main')) {
    // URL de base du serveur
    const rootUrl = "http://127.0.0.1:8000";

    // Crée le rendu racine du composant React dans l'élément HTML "main"
    ReactDOM.createRoot(document.getElementById('main')).render(
        // Active le mode strict de React pour détecter les erreurs de code
        // plus facilement
        <React.StrictMode>
            {/* Affiche le composant ChatBox dans le DOM. */}
            <ChatBox rootUrl={rootUrl} />
        </React.StrictMode>
    );
}
