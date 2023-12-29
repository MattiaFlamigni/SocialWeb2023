<?php

class DatabaseHelper {
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function checkUsernameAvailability($username) {
        // Verifica se l'username esiste già
        $stmt = $this->db->prepare("SELECT username FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        $available = ($stmt->num_rows === 0);
        $stmt->close();

        return $available;
    }


    public function registraUtente($username, $password, $email, $nome, $cognome){
        // Verifica se l'utente esiste già
        $stmtCheck = $this->db->prepare("SELECT username FROM utenti WHERE username = ?");
        $stmtCheck->bind_param("s", $username);
        $stmtCheck->execute();
        $stmtCheck->store_result();
    
        if ($stmtCheck->num_rows > 0) {
            // L'utente è già registrato
            $stmtCheck->close();
            return false;
        }
    
        $stmtCheck->close();
    
        // Procedi con l'inserimento se l'utente non esiste già
        $stmt = $this->db->prepare("INSERT INTO utenti (username, password, mail, nome, cognome) VALUES (?, ?, ?, ?, ?)");
    
        if ($stmt === false) {
            // Gestire l'errore di preparazione della query
            return false;
        }
    
        $stmt->bind_param("sssss", $username, $password, $email, $nome, $cognome);
    
        if ($stmt->execute() === false) {
            // Gestire l'errore durante l'esecuzione della query
            return false;
        }
    
        // Ottieni l'ID dell'utente appena inserito
        $lastInsertedId = $stmt->insert_id;
    
        // Chiudi la query preparata
        $stmt->close();
    
        // Restituisci l'ID dell'utente appena inserito
        return $lastInsertedId;
    }



    public function login($username, $password){
        $stmt = $this->db->prepare("SELECT password FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();  


        if ($result->num_rows == 0) {
            // L'utente non esiste
            return false;
        }


        // Ottiengo la password dell'utente dal risultato della query
        $user = $result->fetch_assoc();
        $passwordHash = $user["password"];

        // Verifico se la password è corretta
        if($passwordHash == $password){
            // Password corretta
            return true;
        } else {
            // Password errata
            return false;
        }

    }
    
    













}




?>