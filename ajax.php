<?php

// Vérifier si la requête est une requête POST
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit;
}

// Récupérer les données de la requête
$action = $_POST['action'];
$data = $_POST['data'];

// Traiter la requête
switch ($action) {
    case 'getContactList':
        // Récupérer la liste des contacts
        $contact = getContactList();

        // Envoi la réponse
        echo json_encode($contact);
        break;
    // ajax.php
$action = $_POST['action'];

// ...

case 'getContact':
    $contactId = $data['contactId'];
    $contact = getContactById($contactId);
    echo json_encode($contact);
    break;

case 'addContact':
    addContact($data);
    echo json_encode(['success' => true]);
    break;

case 'updateContact':
    updateContact($data);
    echo json_encode(['success' => true]);
    break;

        // Mettre à jour le contact
        updateContact($data);

        // Envoi la réponse
        echo json_encode(['success' => true]);
        break;
    default:
        // Action non valide
        echo json_encode(['success' => false]);
        break;
}

// Fonction pour récupérer la liste des contacts
function getContactList() {
    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=contact', 'babs', 'passer');

    // Exécution de la requête
    $query = $db->query('SELECT * FROM contact');

    // Récupération des résultats
    $contact = $query->fetchAll();

    // Retour des résultats
    return $contact;
}

// Fonction pour récupérer le contact par ID
function getContactById($contactId) {
    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=contact', 'babs', 'passer');

    // Exécution de la requête
    $query = $db->prepare('SELECT * FROM contact WHERE id = ?');
    $query->execute([$contactId]);

    // Récupération du résultat
    $contact = $query->fetch();

    // Retour du résultat
    return $contact;
}

// Fonction pour ajouter un contact
function addContact($data) {
    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=contact', 'babs', 'passer');

    // Préparation de la requête
    $query = $db->prepare('INSERT INTO contact (nom, prenom, email, telephone, categorie) VALUES (?, ?, ?, ?, ?)');

    // Éxecution de la requête
    $query->execute([
        $data['nom'],
        $data['prenom'],
        $data['email'],
        $data['telephone'],
        $data['categorie'],
    ]);
}
// Fonction pour mettre à jour un contact
function updateContact($data) {
    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=contact', 'babs', 'passer');

    // Préparation de la requête
    $query = $db->prepare('UPDATE contact SET nom = ?, prenom = ?, email = ?, telephone = ?, categorie = ? WHERE id = ?');

    // Éxecution de la requête
    $query->execute([
        $data['nom'],
        $data['prenom'],
        $data['email'],
        $data['telephone'],
        $data['categorie'],
        $data['id'],
    ]);
}
