<?php 
Function products($conn){
    $sql="SELECT nazwa from type";
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
    echo '<div class="element"><div class="product"><img src="data:image/jpg;charset=utf8;base64,'.base64_encode($image).'" /><h3>';
    echo $name. '</h3></div><div class="options"><h3 class="price">'. $price. ' zł';
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