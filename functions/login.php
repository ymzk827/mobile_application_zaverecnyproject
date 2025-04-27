<?php 
namespace data;

require_once('database.php');

use PDO;
use PDOException;
use Database;


class userManager extends Database {
    public $conn;

    public function __construct() {
        $this->connect();
    }


    private function connect() {
        global $config;

        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        try {
            $this->conn = new PDO(
                'mysql:host='.$config['HOST'].';dbname='.$config['DBNAME'].';port='.$config['PORT'],

                $config['USER_NAME'],
                $config['PASSWORD'],
                $options
            );
        } catch (PDOException $e) {
            die("Chyba pripojenia: " . $e->getMessage());
        }
    }

    public function register($login, $email, $heslo, $rola = 'user'){  
        try{
            $hashed_password = password_hash($heslo, PASSWORD_BCRYPT);
            $sql = 'SELECT * from user WHERE (login = ? or email = ?) LIMIT 1';
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(1, $login);
            $statement->bindParam(2, $email);
            $statement->execute();
            $existingUser = $statement->fetch();

            if($existingUser){
                throw new \Exception("User already exists.");
            }

            $sql = 'INSERT INTO user (login, email, heslo, rola) VALUES (?, ?, ?, ?)';
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(1, $login);
            $statement->bindParam(2, $email);
            $statement->bindParam(3, $hashed_password);
            $statement->bindParam(4, $rola);  
            $statement->execute();
            echo '<script>alert("Register succeful");</script>';
            echo '<script type="text/javascript">',
                    'window.location.replace("http://127.0.0.1/edsa-project/");',
                '</script>';

            
        } catch (Exception $e){
            echo "Chyba pri vkladani dát do DB: " . $e->getMessage();
        } finally {
            $this->conn = null;
        }
    }

    public function login($email, $heslo){  
            $hashed_password = password_hash($heslo, PASSWORD_BCRYPT);
            $sql = 'SELECT * from user WHERE login = ?';
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(1, $email);
            $statement->execute();
            $user = $statement->fetch();

            if(!$user){
                throw new \Exception("User doesnt exist");
            }

            $storedPass = $user['heslo'];

            if(!password_verify($heslo, $storedPass)){
                throw new \Exception ("Wrong password");
            }

            session_start();
            $_SESSION['user_id'] = $user["id"];
            $_SESSION['login'] = $user["login"];
            $_SESSION['rola'] = $user["rola"];
            echo '<script type="text/javascript">',
                    'window.location.replace("http://127.0.0.1/edsa-project/");',
                '</script>';

        } 


}

?>