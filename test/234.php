<?php
    require_once "connect.php";
    $sql = "SELECT image FROM produkty WHERE id=1";

    if($result = $conn->query($sql)){
        $row=$result->fetch_assoc();
        echo '<img class="item_image" src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['image']).'" />';
    }
    else{
        echo "<img alt=". '"zdjecie produktu"'. ">";
    }
?>