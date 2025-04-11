<?php 
namespace database;

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/functions/config.php');

use PDO;
use PDOException;

class feedbackManager {
    public $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $config = DATABASE;

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

    public function generateFeedback() {
        try {
            
            // vytvorenie aj poslanie prikazu "SELECT" ktory vypiše otazky aj odpovede k nim
            $sql = "SELECT * FROM feedback";
            $stmt = $this->conn->prepare($sql); 
            $stmt->execute();

            // konvertovanie vystupu prikazu SELECT z tabuľky otazok do array v PHP
            $results = $stmt->fetchAll();

            // vytvorenie prvkov v akordeone aj použivanie udajov z DB
            foreach ($results as $row) {
                echo '<div class="client_container layout_padding2-top">';
                echo '<div class="client-id">';
                echo '<div class="img-box">';
                echo '<img src="images/quotes/'.$row["img_filename"].'" alt="" />';
                echo '</div>';
                echo '<div class="name">';
                echo '<img src="images/quote.png" alt="" />';
                echo '<h6>';
                echo $row["feedback_name"];
                echo '</h6>';
                echo '<p>';
                echo $row["client_role"];
                echo '</p>';
                echo '</div>';
                echo '</div>';
                echo '<div class="client-detail">';
                echo '<p>';
                echo $row["feedback_text"];
                echo '</p>';
                echo '</div>';
                echo '<div class="d-flex justify-content-end">';
                echo '<a href="'. $row["client_link"] .'">';
                echo 'Read More';
                echo '</a>';
                echo '</div>';
                echo '</div>';
                echo '<br>';
            }
        } catch (PDOException $e) {
            echo "Chyba pri načítaní dát: " . $e->getMessage();
        }
    }
}
?>