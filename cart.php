<?php
    require_once "connect.php";
    require_once "function.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/stylecart.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
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
                    <li class="usluga disable disable-selection"><a href="#">Zamówienia</a></li>
                    <li class="usluga disable disable-selection"><a href="#">Serwis</a></li>
                    <li class="usluga disable disable-selection"><a href="opinion.php">Opinie</a></li>
                    <li class="usluga disable disable-selection"><a href="#">Reklamacja</a></li>
                </ul>
            </ul>
            <ul class="lista">
                <li class="disable-selection liststylenone" onclick="list('actual')"> Aktualności</li>
                <ul class="lista">
                    <li class="actual disable disable-selection"><a href="#">Promocje</a></li>
                    <li class="actual disable disable-selection"><a href="#">Nasz sklep</a></li>
                    <li class="actual disable disable-selection"><a href="#">Benchmark</a></li>
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
                    <h2>
                        Koszyk
                    </h2>
                    <div class="cart">
                    <?php
                        $sql = "SELECT p.name, p.id, p.image, p.price, c.amount from cart as c join produkty as p on c.id=p.id";
                        if($result=$conn->query($sql)){
                            $row=$result->fetch_assoc();
                            $sum=0;
                            if(@$row["id"]>=1){
                                cartitem($row["image"], $row["name"], $row["price"], $row["amount"], $row["id"]);
                                $sum+=$row["price"]*$row["amount"];
                                while($row=$result->fetch_assoc()){
                                    cartitem($row["image"], $row["name"], $row["price"], $row["amount"], $row["id"]);
                                    $sum+=$row["price"]*$row["amount"];
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
                            <div class="padding"><input type="radio" name="delivery" required>Kurier DPD - 22,50zł </div>
                            <div class="padding"><input type="radio" name="delivery" required>Kurier DPD - ł </div>
                            <div class="padding"><input type="radio" name="delivery" required>Kurier DPD - 22,50zł </div>
                        </div>
                        <h3>Adres dostawy:</h3>
                        <div class="max">
                            <h4>Imię:</h4>
                            <input type="text" required name="imie" placeholder="Wprowadź imię">
                            <h4>Nazwisko:</h4>
                            <input type="text" required name="nazwisko"placeholder="Wprowadź nazwisko">
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
                            <div class="padding"><input type="radio" name="pay" required>Kurier DPD - 22,50zł </div>
                            <div class="padding"><input type="radio" name="pay" required>Kurier DPD - 22,50zł </div>
                            <div class="padding"><input type="radio" name="pay" required>Kurier DPD - 22,50zł </div>
                        </div>
                        <input type="submit" value="Zamów i przejdź do podumowania">
                    </form>
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