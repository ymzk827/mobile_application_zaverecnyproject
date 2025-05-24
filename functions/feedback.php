<?php 
namespace data;

require_once('functions/database.php');

use PDO;
use PDOException;
use Database;


class feedbackManager extends Database {

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
                echo '<img src="'.$row["img_filename"].'" alt="" />';
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