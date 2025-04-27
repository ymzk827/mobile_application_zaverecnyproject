<?php 
namespace data;

require_once('database.php');

use PDO;
use PDOException;
use Database;


class Formular extends Database {
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

    public function sendFormular() {
        try {
            $name = $_POST['name'];  // for text input
            $email = $_POST['email'];
            $sprava = $_POST['sprava'];
            $cislo = $_POST['phone'];
            // vytvorenie aj poslanie prikazu "INSERT" ktory uloži udaje z formularu do tabuľe v db
            $sql = "INSERT INTO formular (meno, cislo, email, sprava) 
                VALUES (:meno, :email, :cislo, :sprava)";
            $stmt = $this->conn->prepare($sql); 
            $stmt->execute([
                ':meno' => $name,
                ':email' => $email,
                ':cislo' => $cislo,
                ':sprava' => $sprava
            ]);
            
            echo '<script type="text/javascript">',
                    'window.location.replace("http://127.0.0.1/edsa-project/thankyou.php");',
                '</script>'
                ;
        
        } catch (PDOException $e) {
            echo "Chyba pri ukladaní formulára: " . $e->getMessage();
        }
    }

            // konvertovanie vystupu prikazu SELECT z tabuľky otazok do array v PHP
            
    }

?>