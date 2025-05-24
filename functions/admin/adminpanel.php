<?php  

namespace data;

require_once('/functions/database.php');
use PDO;
use PDOException;
use Database;



class adminPanel extends Database {
 
    //funkcia ktora vytvara button ktory otvara stranku "EDIT" kde možeme vymeniť text člankov
    public function showEditButton(){
        echo '<div style="text-align: center; margin-top: 20px;">',
        '<form action="http://127.0.0.1/edsa-project/admin.php" method="" style="margin-top: 5px;">',
            '<button type="submit" class="btn btn-danger" style="font-size: 13px;">Edit feedback</button>',
        '</form>',
    '</div>';
    }


    public function getFeedback() {
        try {
            
            // vytvorenie aj poslanie prikazu "SELECT" ktory vypiše otazky aj odpovede k nim
            $sql = "SELECT * FROM feedback";
            $stmt = $this->conn->prepare($sql); 
            $stmt->execute();

            // konvertovanie vystupu prikazu SELECT z tabuľky otazok do array v PHP
            $results = $stmt->fetchAll();

            // vytvorenie prvkov v akordeone aj použivanie udajov z DB
            foreach ($results as $row) {
              echo "<tr data-id='{$row['id']}'>
                    <td >{$row['id']}</td>
                    <td>{$row['feedback_name']}</td>
                    <td>{$row['feedback_text']}</td>
                    <td>{$row['client_link']}</td>
                    <td>{$row['client_role']}</td>
                    <td>{$row['img_filename']}</td>
                    <td><button class='btn btn-sm btn-primary edit-btn'>Edit</button></td>
                </tr>
                <tr class='edit-panel d-none'>
                    <td colspan='7'>
                    <form class='edit-form'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <div class='row g-2'>
                        <div class='row g-2'>
                    <div class='col'><input type='text' name='feedback_name' class='form-control' value='{$row['feedback_name']}'></div>
                    <div class='col'><input type='text' name='feedback_text' class='form-control' value='{$row['feedback_text']}'></div>
                    <div class='col'><input type='text' name='client_link' class='form-control' value='{$row['client_link']}'></div>
                    <div class='col'><input type='text' name='client_role' class='form-control' value='{$row['client_role']}'></div>
                    <div class='col'><input type='text' name='img_filename' class='form-control' value='{$row['img_filename']}'></div>
                    <div class='col'><button type='submit' class='btn btn-success'>Save</button></div>
                    <div class='col'><button type='submit' onclick='deleteFeedback(".$row["id"].")' class='btn btn-danger'>Delete</button></div>
                         </div>
                        </div>
                    </form>
                    </td>
                </tr>";
            }
        } catch (PDOException $e) {
            echo "Chyba pri načítaní dát: " . $e->getMessage();
        }

        echo "<div style='margin-bottom: 25px;'><form style='margin:25px' class='add-form'>
                        <div class='row g-2'>
                        <div class='row g-2'>    
                    <div class='col'><input type='text' name='feedback_name' class='form-control' placeholder='Name'></div>
                    <div class='col'><input type='text' name='feedback_text' class='form-control' placeholder='Text'></div>
                    <div class='col'><input type='text' name='client_link' class='form-control' placeholder='Button Link'></div>
                    <div class='col'><input type='text' name='client_role' class='form-control' placeholder='Role'></div>
                    <div class='col'><input type='text' name='img_filename' class='form-control' placeholder='Image Source(link)'></div>
                    <div class='col'><button type='submit' class='btn btn-success'>Add new</button> </form></div>";
                    
                    
}
    

    public function getUserInfo() {
        try {
            
            // vytvorenie aj poslanie prikazu "SELECT" ktory vypiše otazky aj odpovede k nim
            $sql = "SELECT * FROM user";
            $stmt = $this->conn->prepare($sql); 
            $stmt->execute();

            // konvertovanie vystupu prikazu SELECT z tabuľky otazok do array v PHP
            $results = $stmt->fetchAll();

            // vytvorenie prvkov v akordeone aj použivanie udajov z DB
            foreach ($results as $row) {
               echo '<tbody>',
              ' <tr>',
                ' <td>'.$row["id"].'</td>',
                ' <td>'.$row["login"].'</td>',
                ' <td>'.$row["email"].'</td>',
                 '<td>'.$row["rola"].'</td>',
                 '<td>'.$row["act_status"].'</td>',
                 '<td>',
                '<button class="btn btn-danger btn-sm" onclick="deleteUser('.$row["id"].')">Delete</button>',
                '<br>';
                if ($row["rola"] != "admin") {
                     echo '<button class="btn btn-primary btn-sm" onclick="promoteUser('.$row["id"].')">Promote to admin</button>';
                    }           

             echo '</td>',
              '</tr>',
             '</tbody>';
            }
        } catch (PDOException $e) {
            echo "Chyba pri načítaní dát: " . $e->getMessage();
        }
    }
}
?>