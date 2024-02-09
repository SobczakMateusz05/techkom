<?php
require_once "connect.php";
require_once "function.php";
if($_GET["operation"]=="add"){
    $prod=$_GET["prod"];
    $sql = "INSERT INTO cart(id, amount) values($prod, 1)";
    $result=$conn->query($sql);
    $sql = " SELECT nazwa FROM produkty as p JOIN type as t ON p.type = t.id WHERE p.id=$prod";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $category=$row["nazwa"];
    header("Location:ofert.php?category=$category&add=yes");
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
?>