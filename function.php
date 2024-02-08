<?php 
Function products($conn){
    $sql="SELECT nazwa from type";
    if($result=$conn->query($sql)){
        while($row=$result->fetch_assoc()){
            echo '<li class="products disable disable-selection"><a href="#" onclick="category('."'". $row["nazwa"]. "'". ')">'. UCWORDS($row["nazwa"]).'</a></li>';
        }
    }
}
?>