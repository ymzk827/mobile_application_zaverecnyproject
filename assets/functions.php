
<?php

    function setResponses($dir){
        
    $files = glob($dir . "/*.png");    
    $json = file_get_contents("assets/data.json");    
    $data = json_decode($json, true);
    $names = $data["client_name"];
    $quotes = $data["client_response"];
    $links = $data["client_link"];
    $roles = $data["client_role"];


    foreach ($files as $file) {        
        echo '<div class="client_container layout_padding2-top">';
        echo '<div class="client-id">';
        echo '<div class="img-box">';
        echo '<img src="'. $file .'" alt="" />';
        echo '</div>';
        echo '<div class="name">';
        echo '<img src="images/quote.png" alt="" />';
        echo '<h6>';
        echo $names[basename($file)];
        echo '</h6>';
        echo '<p>';
        echo $roles[basename($file)];
        echo '</p>';
        echo '</div>';
        echo '</div>';
        echo '<div class="client-detail">';
        echo '<p>';
        echo $quotes[basename($file)];
        echo '</p>';
        echo '</div>';
        echo '<div class="d-flex justify-content-end">';
        echo '<a href="'. $links[basename($file)] .'">';
        echo 'Read More';
        echo '</a>';
        echo '</div>';
        echo '</div>';
        echo '<br>';
    }

}

?>
