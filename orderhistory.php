<?php
    session_start();
    require_once "connect.php";
    require_once "function.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/orderhistory.css">
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
                <a href="products.php">Produkty</a>
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
                    <li class="usluga disable disable-selection"><a href="#">Serwis</a></li>
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
           <div class="right-top">
            <h3 class="disable-selection">
                TechKom > Ten Sklep > Usługi > Zamówienia
            </h3>
           </div>
           <div class="bottom-right
            <?php
                if(isset($_GET["number"])){
                    echo " disable";
                }
                else{

                }     
            ?>
           ">
           
                <div class="right-left">
                <div class="outlog
                <?php
                    if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                        echo " disable";
                    }
                    else{
                        
                    }
                    ?>
                ">
                <h1>Nie jesteś zalogowany!</h1>
                <a href="login.php" class="button">Zaloguj się</a>
            </div>
                    <?php
                    if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                        $id=$_SESSION["user"];
                        $sql="SELECT o.number, o.date, d.cost from (orders as o join produkty as p on p.id=product) join delivery as d on o.delivery = d.id where userid=$id group by number order by number desc";
                        $result=$conn->query($sql);
                        echo "<h1>Historia twoich zamówień</h1>";
                        $num_row=mysqli_num_rows($result);
                        if($num_row==0){
                            echo '<h2 class="center"style="color: red; margin-top:25px;"> Nie znaleziono żadnych zamówień</h2>';
                        }
                        else{
                            while($row=$result->fetch_assoc()){
                                $number=$row["number"];
                                echo '<div class="post" onclick="history('.$row["number"].')"><img src="img/order.png"><h2>Zamówienie nr. '.$number.'</h2><h2>Kwota: ';
                                $sql2="SELECT o.price, o.amount from orders as o join produkty as p on p.id=product WHERE number=$number";
                                $result2=$conn->query($sql2);
                                $sum=0;
                                while($row2=$result2->fetch_assoc()){
                                   $sum+=$row2["price"]*$row2["amount"];
                                }
                                $sum+=$row["cost"];
                                echo "$sum zł</h2><h5>Data: ". $row["date"] ."</h5></div>";
                            }
                        }
                    }
                    ?>
                </div>
                <div class="right-right">
                    <img src="img/addR.png">
                </div>
            </div>
            <div class="right-bottom
            <?php
                if(isset($_GET["number"])){
                }
                else{
                    echo "disable";
                }
            ?>

            ">
                <?php
                if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                if(isset($_GET["number"])){
                    $number=$_GET["number"];
                }
                ?>
                <h1>Zamówienie nr. 
                    <?php 
                    if(isset($_GET["number"])){
                        echo $number; 
                    }
                    ?></h1>
                <div class="cart">
                <?php
                    if(isset($_GET["number"])){
                        $sql = "SELECT p.name, p.image, p.price, o.amount, d.cost, o.delivery from (orders as o join produkty as p on o.product=p.id) join delivery as d on d.id=o.delivery where number=$number and userid=$id";
                        if($result=$conn->query($sql)){
                            $sum=0;
                            while($row=$result->fetch_assoc()){
                                historyitem($row["image"], $row["name"], $row["price"], $row["amount"]);
                                $sum+=$row["price"]*$row["amount"];
                                $cost=$row["cost"];
                                $delivery=$row["delivery"];
                            }
                        $sql= "SELECT image, name from delivery where id=$delivery";
                        $result=$conn->query($sql); 
                        $row=$result->fetch_assoc();

                        echo '<div class="element"><div class="product"><img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row["image"]).'" /><h3>';
                        echo $row["name"]. '</h3></div><div class="options"><h3 class="price">'. $cost. ' zł';
                        echo '</h3></div></div>';
                        @$sum+=$cost;
                        echo '<div class="sum"><h3>Łączna kwota: '.$sum.' zł</h3></div>';  
                        }
                    }
                }
                ?>
                </div>
                <div class="personal">
                    <h1
                    <?php
                        if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){

                        }
                        else{
                            echo 'class="disable"';
                        }
                    ?>
                    >
                        Pozostałe dane do zamównienia:
                    </h1>
                    <ul>
                        <?php
                        if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                        if(isset($_GET["number"])){
                        $sql="SELECT name, subname, tel, mail, miasto, home_number, street, p.method, date FROM orders join payments as p on p.id=orders.payment  WHERE number=$number and userid=$id";
                        $result=$conn->query($sql); 
                        $row=$result->fetch_assoc();
                        echo "<li>Imię: ". $row["name"] ."</li>";
                        echo "<li>Nazwisko: ". $row["subname"] ."</li>";
                        echo "<li>Numer telefonu: ". $row["tel"] ."</li>";
                        echo "<li>Adres e-mail: ". $row["mail"] ."</li>";
                        echo "<li>Miasto: ". $row["miasto"] ."</li>";
                        echo "<li>Ulica: ". $row["home_number"] ."</li>";
                        echo "<li>Numer domu/paczkomatu: ". $row["street"] ."</li>";
                        echo "<li>Rodaj płatnośći: ". $row["method"] ."</li>";
                        echo "<li>Data zamównienia: ". $row["date"] ."</li>";
                        }
                        }
                        ?>
                        
                    </ul>
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