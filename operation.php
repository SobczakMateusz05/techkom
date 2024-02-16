<?php
session_start();
require_once "connect.php";
require_once "function.php";

if($_GET["operation"]=="add"){
    $prod=$_GET["prod"];
    $sql = "SELECT * from cart where id=$prod";
    $result=$conn -> query($sql);
    $num_row=mysqli_num_rows($result);
    if($num_row==0){
        $sql = "INSERT INTO cart(id, amount) values($prod, 1)";
        $result=$conn->query($sql);
        $sql = " SELECT nazwa FROM produkty as p JOIN type as t ON p.type = t.id WHERE p.id=$prod";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        $category=$row["nazwa"];
        header("Location:ofert.php?category=$category&add=yes");
    }
    else{
        $sql ="SELECT amount from cart";
        $result=$conn->query($sql);
        $row = $result -> fetch_assoc();
        if($row['amount']<5){
            $amount = $row['amount']+1;
            $sql = "UPDATE cart SET amount = $amount";
            $result = $conn->query($sql);
            $sql = " SELECT nazwa FROM produkty as p JOIN type as t ON p.type = t.id WHERE p.id=$prod";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $category=$row["nazwa"];
            header("Location:ofert.php?category=$category&add=yes");
        }
        else{
            $sql = " SELECT nazwa FROM produkty as p JOIN type as t ON p.type = t.id WHERE p.id=$prod";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $category=$row["nazwa"];
            header("Location:ofert.php?category=$category&add=no");
        }
    }
    
}

if($_GET["operation"]=="addindex"){
    $prod=$_GET["prod"];
    $sql = "SELECT * from cart where id=$prod";
    $result=$conn -> query($sql);
    $num_row=mysqli_num_rows($result);
    if($num_row==0){
        $sql = "INSERT INTO cart(id, amount) values($prod, 1)";
        if($result=$conn->query($sql)){
            header("Location:index.php?add=yes");
        }
    }
    else{
        $sql ="SELECT amount from cart";
        $result=$conn->query($sql);
        $row = $result -> fetch_assoc();
        if($row['amount']<5){
            $amount = $row['amount']+1;
            $sql = "UPDATE cart SET amount = $amount";
            $result = $conn->query($sql);
            header("Location:index.php?add=yes");
        }
        else{
            header("Location:index.php?add=no");
        }
        
    }
}

if($_GET["operation"]=="addspec"){
    $prod=$_GET["prod"];
    $sql = "SELECT * from cart where id=$prod";
    $result=$conn -> query($sql);
    $num_row=mysqli_num_rows($result);
    if($num_row==0){
        $sql = "INSERT INTO cart(id, amount) values($prod, 1)";
        if($result=$conn->query($sql)){
            header("Location:spec.php?prod=$prod&add=yes");
        }
    }
    else{
        $sql ="SELECT amount from cart";
        $result=$conn->query($sql);
        $row = $result -> fetch_assoc();
        if($row['amount']<5){
            $amount = $row['amount']+1;
            $sql = "UPDATE cart SET amount = $amount";
            $result = $conn->query($sql);
            header("Location:spec.php?prod=$prod&add=yes");
        }
        else{
            header("Location:spec.php?prod=$prod&add=no");
        }
    }
}



if($_GET["operation"]=="del"){
    $prod=$_GET["prod"];
    $sql = "DELETE FROM cart where id=$prod";
    $result=$conn->query($sql);
    header("Location:cart.php");
}

if($_GET["operation"]=="amount"){
    $amount=$_POST["amount"];
    $prod=$_GET["prod"];
    $sql = "UPDATE cart SET amount=$amount where id=$prod";
    $result=$conn->query($sql);
    header("Location:cart.php");
}

if($_GET["operation"]=="logout"){
    $_SESSION["user"]="";
    header('Location:index.php');
}

if((empty($_GET["operation"]))){
    header('Location:index.php');
}
?>