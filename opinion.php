<?php
    require_once "connect.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styleopi.css">
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
                <a href="products.html" class="active">Produkty</a>
            </li>
            <li>
                
            </li>
            <li>
                <a href="about.html">O nas</a>
            </li>
            <li>
                
            </li>
            <li>
                <a href="contact.html">Kontakt</a>
            </li>
            <li>
                <form method="POST" action="index.php">
                    <input type="text" name="search" class="searcher" placeholder="Wyszukaj produkt...">
                    <input type="submit" value="Wyszukaj">
                </form>
            </li>
            <li>
                <a href="#">
                    <img src="img/basket.png">
                </a>
            </li>
        </ul>
 
    </header>
    <main>
        <div class="left">
            <h2 class="shop disable-selection">Ten Sklep</h2>
            <ul class="lista" > 
                <li class="disable-selection liststylenone" onclick="products()"> Produkty</li>
                <ul class="lista">
                    <li class="products disable disable-selection"><a href="laptop.php">Laptopy</a></li>
                    <li class="products disable disable-selection"><a href="pc.php">Komputery</a></li>
                    <li class="products disable disable-selection"><a href="#">Akcesoria</a></li>
                    <li class="products disable disable-selection"><a href="#">Telefony</a></li>
                    <li class="products disable disable-selection"><a href="#">Routery</a></li>
                    <li class="products disable disable-selection"><a href="#">Konsole</a></li>
                </ul>
            </ul>
            <ul class="lista">
                <li class="disable-selection liststylenone" onclick="usluga()"> Usługi</li>
                <ul class="lista">
                    <li class="usluga disable disable-selection"><a href="#">Zamówienia</a></li>
                    <li class="usluga disable disable-selection"><a href="#">Serwis</a></li>
                    <li class="usluga disable disable-selection"><a href="opinion.php">Opinie</a></li>
                    <li class="usluga disable disable-selection"><a href="#">Reklamacja</a></li>
                </ul>
            </ul>
            <ul class="lista">
                <li class="disable-selection liststylenone" onclick="actual()"> Aktualności</li>
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
                    TechKom > Ten Sklep > Usługi > Opinie
                </h3>
            </div>
            <div class="right-bottom">
                <h2>
                    Opinie
                </h2>
                <?php
                    $sql = " SELECT * FROM rewiews";
                    if($result = $conn->query($sql)){
                        while($row=$result->fetch_assoc()) 
                        {
                            echo '<div class="opinion"> <h2>'. $row['username']. '</h2> <h3>'. $row['review']. '</h3> <h5>'. $row['date']. '</h5> </div>';
                        }
                    }
                    else{
                        echo "Nie znaleziono żadnych opinii";
                    }
                ?>
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