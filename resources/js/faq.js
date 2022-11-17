// FAQ Script

window.addEventListener("DOMContentLoaded", event => {
    console.debug("faq.js - DOMContentLoaded");
});

const saveFAQ = ({ formId }) => {
    console.debug("calling SaveFAQ!");

    const form = document.querySelector(formId);
    if (!form) {
        console.debug("`%s` form not found", formId);

        return false;
    }

    fetch(form.action, {
        body: new FormData(form),
        method: "POST",
        mode: "cors",
        cache: "no-cache"
    }).then(response => {
        return response.json();
    }).then(response => {
        if (response.done) {
            if(response.insert) insertTable({ faq: response.faq, message: response.message });
            else if(response.update) updateTable({ faq: response.faq, message: response.message });
        }
    }).catch(err => {
        console.error(err);
    });

    return false;
};

const insertTable = ({ faq, message }) => {
    // Récupération de la table
    // SI la table n'existe pas alors on sort de la fonction
    // Si la table existe alors il faut cacher le #faq-empty (display none)
    // Créer le TR avec un ID
    // Créer les TD question, answer, rank et action
    // Ajouter les informations dans les TD
    // Créer lien éditions et Suppression
    // Insérer les TD dans le TR, TR dans Table > TBODY
};

const updateTable = ({ faq, message }) => {
    const table = document.querySelector('#faq-table');
    if(!table) {
        console.debug("FAQ Table not found!");

        return;
    }

    // METTRE à jour la table
};

const showModal = ({ id, url }) => {
    // Afficher un BS Modal avec un formulaire d'édition
    // Récupérer les informations du FAQ via un fetch
    // Une fois les données reçues, remplir les inputs
};

const updateFaq = (formId) => {
    saveFAQ(formId);
    // Cacher le BS Modal
};
