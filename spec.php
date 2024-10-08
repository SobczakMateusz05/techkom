<?php
    session_start();
    require_once "connect.php";
    require_once "function.php";
    if(empty($_GET["prod"])){
        header('Location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/spec.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <title>Sklep internetowy</title>
    <script src="script.js"></script>
</head>
<body>
<header>
        <ul>
            <li>

            </li>
            <li>
                <a href="index.php">Stona Główna</a>
            </li>
            <li>
                
            </li>
            <li>
                <a href="products.php" class="active">Produkty</a>
            </li>
            <li>
                
            </li>
            <li>
                <a href="about.php">O nas</a>
            </li>
            <li>
                
            </li>
            <li>
                <a href="contact.php">Kontakt</a>
            </li>
            <li>
            </li>
            <li>
                <?php
                if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                    echo '<a href="operation.php?operation=logout"> Wyloguj się</a>';
                }
                else{
                    echo '<a href="login.php">Zaloguj się</a>';
                }
                ?>
            </li>
            <li>
                <form method="POST" action="index.php">
                    <input type="text" name="search" class="searcher" placeholder="Wyszukaj produkt... (efekt stylistyczny)">
                    <input type="submit" value="Wyszukaj">
                </form>
            </li>
            <li>
                <a href="cart.php">
                    <img src="img/basket.png">
                </a>
            </li>
        </ul>
    </header>
    <main>
        <div class="left">
            <h2 class="shop disable-selection">Ten Sklep</h2>
            <ul class="lista" > 
                <li class="disable-selection liststylenone" onclick="list('products')"> Produkty</li>
                <ul class="lista">
                    <?php
                        products($conn);
                    ?>
                </ul>
            </ul>
            <ul class="lista">
                <li class="disable-selection liststylenone" onclick="list('usluga')"> Usługi</li>
                <ul class="lista">
                    <li class="usluga disable disable-selection"><a href="orderhistory.php">Zamówienia</a></li>
                    <li class="usluga disable disable-selection"><a href="ofert.php?category=serwis">Serwis</a></li>
                    <li class="usluga disable disable-selection"><a href="opinion.php">Opinie</a></li>
                    <li class="usluga disable disable-selection"><a href="reclamation.php">Reklamacja</a></li>
                </ul>
            </ul>
            <ul class="lista">
                <li class="disable-selection liststylenone" onclick="list('actual')"> Aktualności</li>
                <ul class="lista">
                    <li class="actual disable disable-selection"><a href="promotion.php">Promocje</a></li>
                    <li class="actual disable disable-selection"><a href="about.php">Nasz sklep</a></li>
                    <li class="actual disable disable-selection"><a href="https://www.3dmark.com/">Benchmark</a></li>
                </ul>
            </ul>
        </div>
        <div class="right">
        <div class="
                <?php
                    if(isset($_GET["add"])||isset($_GET["log"])){
                        echo 'added'; 
                    }
                    else{
                        echo 'disable';
                    }
                ?>
            ">
                <div class="border2">
                    <?php
                        if(isset($_GET["add"])&&$_GET["add"]=="yes"){
                            echo '<h2 style="color: green;">Dodano produkt do koszyka!</h2>';
                        }
                        if(isset($_GET["add"])&&$_GET["add"]=="no"){
                            echo '<h2 style="color: red;">Maksymalna ilość tego przedmiotu w koszyku!</h2>';
                        }
                        if(isset($_GET["log"])){
                            echo '<h2>Nie jesteś zalogowany </h2>';
                        }
                    ?>
                    <div class="flex">
                        <a href="#" class="button2" onclick=
                        <?php
                            echo '"spec('."'".$_GET["prod"]."'" .')"';
                        ?>
                        >
                        Kontunnuj zakupy</a>
                        <?php
                            if(isset($_GET["log"])){
                               echo '<a href="login.php" class="button2">Zaloguj się</a>';
                            }
                            else echo '<a href="cart.php" class="button2">Przejdź do koszyka</a>';
                        ?>
                    </div>
                </div>
            </div>
            <div class="right-top">
                <h3 class="disable-selection">
                    TechKom > Ten Sklep > Produkty >
                    <?php
                        $prod=$_GET["prod"];
                        $sql="SELECT p.name, t.nazwa from produkty as p join type as t on p.type=t.id where p.id=$prod";
                        $result=$conn->query($sql);
                        $row=$result->fetch_assoc();
                        $category=$row["nazwa"];
                        $name=$row["name"];
                        echo  UCWORDS($category).  " > ".$name;
                    ?>
                </h3>
            </div>
            <div class="right-bottom">
            <?php
                    if($category=="komputery"||$category=="laptopy"){
                        $sql="SELECT image, description, procesor, ram, gpu , dysk, system, price from produkty where id=$prod";
                        $result=$conn->query($sql);
                        $row=$result->fetch_assoc();
                    }
                    else{
                        $sql="SELECT image, description, price from produkty where id=$prod";
                        $result=$conn->query($sql);
                        $row=$result->fetch_assoc();
                    }
                ?>
                <div class="product">
                    <div class="top-product">
                        <?php
                        echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['image']).'" />'
                        ?>
                        <div class="top-product-right">
                            <div>
                                <h2>
                                    <?php
                                        echo $name;
                                    ?>
                                </h2>
                                <h3>
                                    <?php
                                        echo $row["description"];
                                    ?>
                                </h3>
                                <h2>Cena: 
                                    <?php
                                        $sql7 = "SELECT new_price from promotion where prod_id=$prod";
                                        $result7=$conn->query($sql7);
                                        $num_row7=mysqli_num_rows($result7);
                                        if($num_row7<1){
                                            echo $row["price"];
                                        }
                                        else{
                                            $row7=$result7->fetch_assoc();
                                            echo '<a class="overline">' .$row["price"].'</a><a class="red">'. $row7["new_price"] . "</a>";
                                        }

                                    ?>
                                     zł</h2>
                            </div>
                            <div class="addbasket disable-selection"> 
                                <a href="#" onclick=
                                <?php 
                                echo '"operation('. $prod. ","; 
                                if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                                    echo  "'addspec'";
                                }
                                else{
                                    echo  "'logspec'";
                                }
                                echo')"'; 
                                ?>
                                >Dodaj do koszyka</a> 
                                
                            </div>
                        </div>
                    </div>
                    <?php
                        if($category=="komputery"||$category=="laptopy"){
                            echo '<div class="spec"><h3>Specyfikacja:</h3><div class="text"><p class="width">PROCESOR: </p><p>'. $row["procesor"]. '</p></div>';
                            echo '<div class="text"><p class="width">PAMIĘĆ RAM: </p><p>'. $row["ram"]. ' GB</p></div>';
                            echo '<div class="text"><p class="width">KARTA GRAFICZNA: </p><p>'. $row["gpu"]. '</p></div>';
                            echo '<div class="text"><p class="width">DYSK TWARDY: </p><p>'. $row["dysk"]. '</p></div>';
                            echo '<div class="text"><p class="width">SYSTEM OPERACYJNY: </p><p>'. $row["system"]. '</p></div></div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <h2>
            <MARQUEE>
                Oficjalna strona sklepu interenetowego©
            </MARQUEE>
        </h2>
    </footer>
</body>
</html>