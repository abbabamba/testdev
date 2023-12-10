

// scripts.js
function getContactById(contactId, callback) {
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        data: { action: 'getContact', data: { contactId: contactId } },
        success: function (data) {
            callback(JSON.parse(data));
        }
    });
}

function addContact(data) {
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        data: { action: 'addContact', data: data },
        success: function (data) {
            loadContactList();
        }
    });
}

function updateContact(data) {
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        data: { action: 'updateContact', data: data },
        success: function (data) {
            loadContactList();
        }
    });
}



// Fonction pour charger la liste des contacts depuis la base de données
function loadContactList() {
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        data: { action: 'getContactList' },
        success: function (data) {
            // Appeler la fonction pour mettre à jour l'interface utilisateur
            updateContactList(JSON.parse(data));
        }
    });
}

// Fonction pour mettre à jour l'interface utilisateur avec la liste des contacts
function updateContactList(contacts) {
    var html = "<ul>";
    
    // Construire la liste des contacts
    contacts.forEach(function (contact) {
        html += "<li>" + contact.nom + " " + contact.prenom + " - " + contact.categorie + "</li>";
    });
    
    html += "</ul>";
    
    // Mettre à jour l'élément HTML avec la nouvelle liste des contacts
    $('#contactList').html(html);
}

// Appeler la fonction pour charger la liste des contacts lors du chargement de la page
$(document).ready(function () {
    loadContactList();
});

    
  