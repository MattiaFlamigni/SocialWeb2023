<?php

session_start();
include ("post.php");
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



    /*public function login($username, $password){
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
            // TODO: Genera un cookie una volta che l'utente ha fatto il login e chiamalo "user".
            //       L'ideale sarebbe di assegnare ad ogni utente un codice random univoco gestito sul server
            //       e mettere quello come valore del cookie (molto più sicuro), ma per semplicità potremmo
            //       semplicemente mettere l'username dell'utente.
            return true;
        } else {
            // Password errata
            return false;
        }

    }*/



    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT password FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 0) {
            // L'utente non esiste
            return false;
        }
    
        // Ottengo la password dell'utente dal risultato della query
        $user = $result->fetch_assoc();
        $passwordHash = $user["password"];
    
        // Verifico se la password è corretta
        if ($passwordHash == $password) {
            // Password corretta
    
            
            $cookieValue = $username;
    
            // Imposta il cookie con una durata di 1 giorno 
            setcookie("user", $cookieValue, time() + (86400 * 1), "/");
    
            return true;
        } else {
            // Password errata
            return false;
        }
    }
    
    


    public function getPostsByUser($username){
        $stmt = $this->db->prepare("SELECT id FROM immagini WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result(); 

        $posts = array();
        while($row = $result->fetch_assoc()){
            // TODO: usa la classe Post (vedi db/post.php) così da restituire gli oggetti di tale classe invece degli ID delle immagini
            $posts[] = $row;
        }

        //ritorno id delle immagini
        return $posts;
    }

    public function getUserByUsername($username){
        $stmt = $this->db->prepare("SELECT nome, cognome FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();  

        if ($result->num_rows == 0) {
            // L'utente non esiste
            return false;
        }

        $user = $result->fetch_assoc();

        
        return $user;
    }

    // fetch posts liked by a user from the server as URLs
    public function fetchLikedPosts($username) {
        $stmt = $this->db->prepare("SELECT id, username, descrizione, data FROM immagini JOIN like ON like.id = immagini.id WHERE like.username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($id, $user, $desc, $date);

        $posts = [];
        while ($stmt->fetch()) {
            // TODO: add user picture instead of "#"
            $posts[] = new Post(image_url($id), $user, "#", $desc, $date);
        }

        return $posts;
    }



    public function searchQuery($userInput) {
            
        
            // Aggiungi i wildcards % agli input dell'utente
            $userInputWithWildcards = '%' . $userInput . '%';

            // Prepara la query
            $stmt = $this->db->prepare("SELECT username, nome, cognome FROM utenti WHERE username LIKE ? AND username != ?");
            $stmt->bind_param("ss", $userInputWithWildcards, $_SESSION["username"]);
            $stmt->execute();
        
            // Ottieni il risultato della query
            $result = $stmt->get_result();
        
            // Array per immagazzinare i risultati
            $searchResults = array();
        
            // Loop attraverso i risultati e aggiungili all'array
            while ($row = $result->fetch_assoc()) {
                $searchResults[] = $row;
            }
        
            // Chiudi la connessione e il risultato della query
            $stmt->close();


            return $searchResults;
        }








    public function followUser($username, $userToFollow) {
        $stmt = $this->db->prepare("INSERT INTO segue (username_utente, username_seguito) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $userToFollow);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
    
            return false;
        }

        return true;


    }


    public function isFollowing($username, $userToFollow) {
        $stmt = $this->db->prepare("SELECT * FROM segue WHERE username_utente = ? AND username_seguito = ?");
        $stmt->bind_param("ss", $username, $userToFollow);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
    
            return false;
        }

        return true;
    }


    public function unfollowUser($username, $userToFollow) {
        $stmt = $this->db->prepare("DELETE FROM segue WHERE username_utente = ? AND username_seguito = ?");
        $stmt->bind_param("ss", $username, $userToFollow);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
    
            return false;
        }

        return true;
    }




}




?>