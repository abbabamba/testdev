<?php

class Contact {

    private $id;
    private $nom;
    private $prenom;
    private $categorie;
    private $telephone;
    private $email;
    private $adresse;

    public function __construct($id, $nom, $prenom, $categorie, $telephone, $email, $adresse) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->categorie = $categorie;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->adresse = $adresse;
    }

    // Getters and setters...

    public static function getContactList() {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM contact";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $contacts = [];
        while ($row = $stmt->fetch()) {
            $contacts[] = new Contact($row['id'], $row['nom'], $row['prenom'], $row['categorie'], $row['telephone'], $row['email'], $row['adresse']);
        }

        return $contacts;
    }

    public static function getContactById($id) {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM contact WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch();

        if ($row === false) {
            return null;
        }

        return new Contact($row['id'], $row['nom'], $row['prenom'], $row['categorie'], $row['telephone'], $row['email'], $row['adresse']);
    }
}

class Database {
    private static $pdo;

    private function __construct() {}

    public static function getConnection() {
        if (!self::$pdo) {
            // Remplacez ces valeurs par vos identifiants de base de données réels
            $host = 'localhost';
            $dbname = 'contact';
            $username = 'babs';
            $password = 'passer';

            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        }

        return self::$pdo;
    }
}
