// FAQ Script

window.addEventListener("DOMContentLoaded", event => {
    console.debug("faq.js - DOMContentLoaded");
    const removers = document.querySelectorAll('.faq-delete');
    if(removers) {
        removers.entries(link => {
            link.addEventListener("click", e => {
                if(!confirm("Voulez-vous effacer cette question et sa réponse?")) {
                    e.preventDefault();

                    return false;
                }
            });
        });
    }
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
    window.location.reload();

    return false;

    // Récupération de la table
    const table = document.querySelector('#faq-table');
    // SI la table n'existe pas alors on sort de la fonction
    if(!table) {
        console.debug("La table des FAQ n'a pas été trouvé!!!");
        return false;
    }
    // Si la table existe alors il faut cacher le #faq-empty (display none)
    const emptyRow = document.querySelector("#faq-empty");
    if(emptyRow) {
        emptyRow.style.display = "none";
    }
    // Créer le TR avec un ID
    const tr = document.createElement('tr');
    tr.id = `faq-${faq.id}`;
    // Créer les TD question, answer, rank et action
    const question = document.createElement('td');
    question.id = `question-${faq.id}`;
    question.innerHTML = faq.question;
    tr.appendChild(question);

    const answer = document.createElement('td');
    answer.id = `answer-${faq.id}`;
    answer.innerHTML = faq.answer;
    tr.appendChild(answer);
    // Ajouter les informations dans les TD
    // Créer lien éditions et Suppression
    // Insérer les TD dans le TR, TR dans Table > TBODY
};

const updateTable = ({ faq, message }) => {
    window.location.reload();

    return false;

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
