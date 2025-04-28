<?php  

namespace data;

require_once(__ROOT__.'/functions/database.php');
use PDO;
use PDOException;
use Database;



class adminPanel extends Database {
 
    //funkcia ktora vytvara button ktory otvara stranku "EDIT" kde možeme vymeniť text člankov
    public function showEditButton(){
        echo '<div style="text-align: center; margin-top: 20px;">',
        '<form action="index.php" method="" style="margin-top: 5px;">',
            '<button type="submit" class="btn btn-danger" style="font-size: 13px;">Edit feedback</button>',
        '</form>',
    '</div>';
    }
}
?>