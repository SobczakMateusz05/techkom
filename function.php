<?php 
Function products($conn){
    $sql="SELECT nazwa from type where id!=7 ";
    if($result=$conn->query($sql)){
        while($row=$result->fetch_assoc()){
            echo '<li class="products disable disable-selection"><a href="#" onclick="category('."'". $row["nazwa"]. "'". ')">'. UCWORDS($row["nazwa"]).'</a></li>';
        }
    }
}

Function options($a){
    for ($i=1; $i < 6; $i++) { 
        echo '<option value="'.$i.'"';
    if($a==$i){
        echo 'selected="selected"';
    }
    echo '>'.$i.'</option>';
    } 
}

Function cartitem($image, $name, $price, $amount, $id){
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "techkom";
    $conn = @new mysqli($db_host, $db_user, $db_pass, $db_name);
    echo '<div class="element"><div class="product"><img src="data:image/jpg;charset=utf8;base64,'.base64_encode($image).'" /><h3>';
    echo $name. '</h3></div><div class="options"><h3 class="price">'; 
    $sql="SELECT new_price from promotion where prod_id=$id";
    $result=$conn->query($sql);
    if(mysqli_num_rows($result)==0){
        echo $price;
    }
    else{
        $row=$result->fetch_assoc();
        echo $row["new_price"];
    }
    echo ' zł';
    echo '</h3> <form method="POST" action="operation.php?prod='.$id .'&operation=amount">';
    echo '<select name="amount" class="amount" onchange="this.form.submit()">';
    options($amount);
    echo '</select><noscript><input type="submit" name="submit"></noscript></form>';
    echo '<h3 class="delete disable-selection" onclick="operation('.$id. " ,'del')";
    echo '">USUŃ</h3></div></div>';
}

Function scale(){
    for($i=1; $i<=5; $i+=0.5){
        echo '<option value="'. $i.'">'.$i. "</option>"; 
    }
}

Function historyitem($image, $name, $price, $amount){
    echo '<div class="element"><div class="product"><img src="data:image/jpg;charset=utf8;base64,'.base64_encode($image).'" /><h3>';
    echo $name. '</h3></div><div class="options"><h3 class="price">'. $price. ' zł';
    echo '</h3>';
    echo "<h3> x $amount </h3></div></div>";
}
?>