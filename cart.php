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
    <link rel="stylesheet" href="style/cart.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <title>Sklep internetowy</title>
    <script src="script.js"></script>
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LcchnApAAAAAIvWz1qZKS1y798KNZxHieP0mQ9J"></script>
    <script>
      function onClick(e) {
        e.preventDefault();
        grecaptcha.enterprise.ready(async () => {
          const token = await grecaptcha.enterprise.execute('6LcchnApAAAAAIvWz1qZKS1y798KNZxHieP0mQ9J', {action: 'LOGIN'});
        });
      }
    </script>
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
                <a href="products.php" >Produkty</a>
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
            <div class="right-top">
                <h3 class="disable-selection">
                    TechKom > Ten Sklep > Koszyk
                </h3>
            </div>
            <div class="right-bottom">
                    <h2
                    <?php
                    if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                    }
                    else{
                        echo 'class="disable"';
                    }
                    ?>
                    >
                        Koszyk
                    </h2>
                    <div class="cart
                    <?php
                    if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                    }
                    else{
                        echo 'disable';
                    }
                    ?>
                    ">
                    <?php
                    if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                        $id=$_SESSION["user"];
                        $sql = "SELECT p.name, p.id, p.image, p.price, c.amount from cart as c join produkty as p on c.id=p.id where userid=$id";
                        if($result=$conn->query($sql)){
                            $row=$result->fetch_assoc();
                            $sum=0;
                            if(@$row["id"]>=1){
                                cartitem($row["image"], $row["name"], $row["price"], $row["amount"], $row["id"]);
                                $prod=$row["id"];
                                    $sql7="SELECT new_price from promotion where prod_id=$prod";
                                    $result7=$conn->query($sql7);
                                    if(mysqli_num_rows($result7)==0){
                                        $price =$row["price"];
                                    }
                                    else{
                                        $row7=$result7->fetch_assoc();
                                        $price=$row7["new_price"];
                                    }

                                    $sum+=$price*$row["amount"];
                                    while($row=$result->fetch_assoc()){
                                    cartitem($row["image"], $row["name"], $row["price"], $row["amount"], $row["id"]);
                                    $prod=$row["id"];
                                    $sql7="SELECT new_price from promotion where prod_id=$prod";
                                    $result7=$conn->query($sql7);
                                    if(mysqli_num_rows($result7)==0){
                                        $price =$row["price"];
                                    }
                                    else{
                                        $row7=$result7->fetch_assoc();
                                        $price=$row7["new_price"];                               
                                    }

                                    $sum+=$price*$row["amount"];
                                }
                                echo '<div class="sum"><h3>Łączna kwota: '.$sum.' zł</h3></div>';
                                $set=53;
                            }
                            else{
                                echo '<h3 class="empty">TWÓJ KOSZYK JEST PUSTY</h3>';
                            }
                        }
                        else{
                            echo '<h3 class="empty">WYSTĄPIŁ BŁĄD SKONTAKTUJ SIĘ Z ADMINISTRATOREM</h3>';
                        }
                    }
                    ?> 

                    </div>
                    <form method="POST" action="order.php" class=" 
                    <?php 
                    if(isset($set)){
                        echo "order";
                    }
                    else{
                        echo "disable" ;
                    }
                    ?>
                    ">
                        <h2>Rodzaj i adres dostawy</h2>
                        <h3>Wybierz rodzaj dostawy:</h3>
                        <div>
                            <?php
                            $sql= "SELECT id, name, image, cost from delivery";
                            if($result=$conn->query($sql)){
                                while($row=$result->fetch_assoc()){
                                    echo '<div class="padding"><input type="radio" name="delivery" required value="'. $row['id'].'">';
                                    echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['image']).'" />';
                                    echo $row["name"] . " - " . $row["cost"] ." zł </div>";
                                }
                            }
                            ?>
                        </div>
                        <h3>Adres dostawy:</h3>
                        <div class="max">
                            <h4>Imię:</h4>
                            <input type="text" required name="imie" placeholder="Wprowadź imię">
                            <h4>Nazwisko:</h4>
                            <input type="text" required name="nazwisko"placeholder="Wprowadź nazwisko">
                            <h4>Numer telefonu(format:123456789):</h4>
                            <input type="tel" required name="tel" pattern="[0-9]{9}" placeholder="Wprowadź numer telefonu">
                            <h4>Adres e-mail:</h4>
                            <input type="mail" required name="mail" placeholder="Wprowadź adres e-mail"
                            <?php
                                if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                                    $sql="SELECT mail from user where id=$id";
                                    $result=$conn->query($sql);
                                    $row=$result->fetch_assoc();
                                    echo 'value="'.$row["mail"].'"';
                                }
                            ?>
                            >
                            <h4>Ulica:</h4>
                            <input type="text" required name="ulica" placeholder="Wprowadź ulice">
                            <h4>Numer domu:</h4>
                            <input type="text" required name="adres" placeholder="Wprowadź numer domu/mieszkania/paczkomatu">
                            <h4>Miasto:</h4>
                            <input type="text" required name="miasto" placeholder="Wprowadź miasto">
                        </div>
                        <h2>Forma Płatności</h2>
                        <h3>Wybierz formę płatności:</h3>
                        <div>
                            <?php
                                $sql="SELECT id, image, method from payments";
                                if($result=$conn->query($sql)){
                                    while($row=$result->fetch_assoc()){
                                        echo '<div class="padding"><input type="radio" name="pay" required value="'. $row['id'].'">';
                                        echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['image']).'" />';
                                        echo $row["method"] . "</div>";
                                    }
                                }
                            ?>
                        </div>
                        <input type="submit" value="Zamów i przejdź do podumowania" name="send">
                    </form>
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