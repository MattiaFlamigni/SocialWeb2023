<?php

session_start();

class DatabaseHelper {
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function checkUsernameAvailability($username) {
        $stmt = $this->db->prepare("SELECT username FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $available = ($stmt->num_rows === 0);
        $stmt->close();
        return $available;
    }

    public function registraUtente($username, $password, $email, $nome, $cognome){
        $stmtCheck = $this->db->prepare("SELECT username FROM utenti WHERE username = ?");
        $stmtCheck->bind_param("s", $username);
        $stmtCheck->execute();
        $stmtCheck->store_result();
        if ($stmtCheck->num_rows > 0) {
            $stmtCheck->close();
            return false;
        }
        $stmtCheck->close();
        $stmt = $this->db->prepare("INSERT INTO utenti (username, password, mail, nome, cognome) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            return false;
        } 
        $stmt->bind_param("sssss", $username, $password, $email, $nome, $cognome);  
        if ($stmt->execute() === false) {
            return false;
        }
        $lastInsertedId = $stmt->insert_id;
        $stmt->close();
        return $lastInsertedId;
    }

    public function userExists($username) {
        $stmt = $this->db->prepare("SELECT * FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();  
        if ($result->num_rows == 0) {
            return false;
        }
        return true;
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT password FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();  
        if ($result->num_rows == 0) {
            return false;
        }
        $user = $result->fetch_assoc();
        $passwordHash = $user["password"];
        if ($passwordHash == $password) {         
            $cookieValue = $username;
            setcookie("user", $cookieValue, time() + (86400 * 1), "/");
            return true;
        } else {

            return false;
        }
    }
    
    public function getPostsByUser($username){
        $stmt = $this->db->prepare("SELECT id, descrizione FROM immagini WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $posts = array();
        while($row = $result->fetch_assoc()){
            // TODO: usa la classe Post (vedi db/post.php) così da restituire gli oggetti di tale classe invece degli ID delle immagini
            $posts[] = $row;
        }
        return $posts;
    }

    public function getUserByUsername($username){
        $stmt = $this->db->prepare("SELECT nome, cognome FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();  
        if ($result->num_rows == 0) {
            return false;
        }
        $user = $result->fetch_assoc(); 
        return $user;
    }

    // fetch posts liked by a user from the server as URLs
    public function fetchLikedPosts($username) {
        $stmt = $this->db->prepare('SELECT immagini.id, immagini.username, immagini.descrizione, immagini.data, utenti.immagine_profilo FROM immagini JOIN likes ON likes.ID_immagine = immagini.id JOIN utenti ON immagini.username = utenti.username WHERE likes.username = ?;');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id, $user, $desc, $date, $propicID);
        $posts = [];
        while ($stmt->fetch()) {
            $posts[] = new Post(image_url($id), $user, propic_url($propicID), $desc, $date);
        }
        return $posts;
    }

    public function uploadPost($imageID, $description, $date, $username) {
        $stmt = $this->db->prepare('INSERT INTO immagini (id, descrizione, data, username) VALUES (?, ?, ?, ?);');
        $stmt->bind_param('ssss', $imageID, $description, $date, $username);
        $stmt->execute();
    }

    public function searchQuery($userInput) {
        $userInputWithWildcards = '%' . $userInput . '%';
        $stmt = $this->db->prepare("SELECT username, nome, cognome, immagine_profilo FROM utenti WHERE username LIKE ? AND username != ?");
        $stmt->bind_param("ss", $userInputWithWildcards, $_SESSION["username"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $searchResults = array();
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
        $stmt->close();
        return $searchResults;
    }

        public function fetchHomePosts($username){
            $stmt = $this->db->prepare("SELECT id, username, descrizione, data FROM immagini WHERE username in (SELECT username_seguito FROM segue WHERE username_utente = ?) ORDER BY data");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result(); 
            $posts = array();
            while($row = $result->fetch_assoc()){
                $posts[] = $row;
            }
            return $posts;
        }

    public function followUser($username, $userToFollow) {
        $stmt = $this->db->prepare("INSERT INTO segue (username_utente, username_seguito) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $userToFollow);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {  
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


    public function getNumPosts($username) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM immagini WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {  
            return 0;
        }
        $row = $result->fetch_assoc();
        return $row["COUNT(*)"];
    }

    public function getNumFollowing($username) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM segue WHERE username_utente = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {   
            return 0;
        }
        $row = $result->fetch_assoc();
        return $row["COUNT(*)"];
    }

    public function getNumFollowers($username) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM segue WHERE username_seguito = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {   
            return 0;
        }
        $row = $result->fetch_assoc();
        return $row["COUNT(*)"];
    }

    public function getNumLikeToPost($id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM likes WHERE ID_immagine = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {   
            return 0;
        }
        $row = $result->fetch_assoc();
        return $row["COUNT(*)"];
    }


    public function getMailFromUser($username) {
        $stmt = $this->db->prepare("SELECT mail FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {   
            return 0;
        }
        $row = $result->fetch_assoc();
        return $row["mail"];
    }

    public function getNomeByUsername($username) {
        $stmt = $this->db->prepare("SELECT nome FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {   
            return 0;
        }
        $row = $result->fetch_assoc();
        return $row["nome"];
    }

    public function getFollowing($username) {
        $stmt = $this->db->prepare("SELECT username_seguito FROM segue WHERE username_utente = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $following = array();
        while($row = $result->fetch_assoc()){
            $following[] = $row;
        }
        return $following;
    }

    public function getFollowers() {
        $stmt = $this->db->prepare("SELECT username_utente FROM segue WHERE username_seguito = ?");
        $stmt->bind_param("s", $_SESSION["username"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $followers = array();
        while($row = $result->fetch_assoc()){
            $followers[] = $row;
        }
        return $followers;
    }

    public function resetPassword($username, $newPassword){
        $stmt = $this->db->prepare("UPDATE utenti SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $newPassword, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result ) {  
            return false;
        }
        return true;    
    }

    public function recoverUser($mail, $password){
        $stmt = $this->db->prepare("SELECT username FROM utenti WHERE mail = ? AND password = ?");
        $stmt->bind_param("ss", $mail, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            return false;
        }
        $row = $result->fetch_assoc();
        return $row["username"];     
    }


    public function checkOldPassword($username, $oldPassword){
        $stmt = $this->db->prepare("SELECT password FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            return false;
        }
        $row = $result->fetch_assoc();
        if($row["password"] == $oldPassword){
            return true;
        } else {
            return false;
        }    
    }

    public function isLiked($username, $post) {
        $stmt = $this->db->prepare("SELECT * FROM likes WHERE username= ? AND ID_Immagine = ?");
        $stmt->bind_param("ss", $username, $post);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            return false;
        }
        return true;
    }

    public function likePost($username, $post) {
        $stmt = $this->db->prepare("INSERT INTO likes (username, ID_Immagine) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $post);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            return true;
        }
        return false;
    }

    public function removeLike($username, $post) {
        $stmt = $this->db->prepare("DELETE FROM likes WHERE username = ? AND ID_Immagine = ?");
        $stmt->bind_param("ss", $username, $post);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            return true;
        }
        return false;
    }

    public function getNomeByPost($post) {
        $stmt = $this->db->prepare("SELECT UTENTI.nome FROM UTENTI JOIN IMMAGINI ON UTENTI.username = IMMAGINI.username WHERE IMMAGINI.ID = ?");
        $stmt->bind_param("s", $post);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            return 0;
        }
        $row = $result->fetch_assoc();
        return $row["nome"];
    }

    public function getUsernameByPost($post) {
        $stmt = $this->db->prepare("SELECT username FROM immagini WHERE ID = ?");
        $stmt->bind_param("s", $post);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            return 0;
        }
        $row = $result->fetch_assoc();
        return $row["username"];
    }

    public function listComments($post) {
        $stmt = $this->db->prepare("SELECT testo, username FROM commenti WHERE ID_Immagine = ?");
        $stmt->bind_param("s", $post);
        $stmt->execute();
        $result = $stmt->get_result();    
            $comments = array();
            while($row = $result->fetch_assoc()){
                $comments[] = $row;
            }
            return $comments;
    }

    public function addComment($text, $username, $post) {
        $stmt = $this->db->prepare("INSERT INTO commenti (testo, username, ID_Immagine) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $text, $username, $post);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            return true;
        }
        return false;
    }

    public function inserisciCommento($commento, $id){
        try {
            $stmt = $this->db->prepare("INSERT INTO commenti (username, testo, ID_immagine) VALUES (?, ?, ?)");
            $username = $_SESSION['username'];
            $stmt->bind_param('ssi', $username, $commento, $id);
            $stmt->execute();  
            return true;
        } catch (PDOException $e) {
            error_log('Errore durante l\'inserimento del commento: ' . $e->getMessage());
            return false;
        }
    }


    public function getMailFromImage($id){
        $stmt = $this->db->prepare("SELECT mail from utenti where utenti.username=(select username from immagini where id = ?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            return 0;
        }
        $row = $result->fetch_assoc();
        return $row["mail"];
    }

    public function getProPic($username) {
        $stmt = $this->db->prepare("SELECT immagine_profilo FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($id);

        if ($stmt->fetch()) {
            return $id;
        } else {
            return "user";
        }
    }

    public function uploadProPic($id, $username) {
        $stmt = $this->db->prepare('UPDATE utenti SET immagine_profilo = ? WHERE username = ?');
        $stmt->bind_param('is', $id, $username);
        $stmt->execute();
    }
}

?>