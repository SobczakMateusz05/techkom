<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styleprod.css">
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
                <li class="disable-selection liststylenone" onclick="list('products')"> Produkty</li>
                <ul class="lista">
                    <?php
                        require_once "connect.php";
                        $sql="SELECT nazwa from type";
                        if($result=$conn->query($sql)){
                            while($row=$result->fetch_assoc()){
                                echo '<li class="products disable disable-selection"><a href="#" onclick="category('."'". $row["nazwa"]. "'". ')">'. UCWORDS($row["nazwa"]).'</a></li>';
                            }
                        }
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
                    TechKom > Ten Sklep > Produkty
                </h3>
            </div>
            <div class="right-bottom">

                    <h2>
                        Produkty
                    </h2>
                    <div class="line">
                        <a href="laptop.php" class="suggest-post">
                            <img src="img/piesek.jpg">
                            <h3 class="disable-selection">Laptopy</h3>
                        </a>
                        <a href="pc.php" class="suggest-post">
                            <img src="img/piesek.jpg">
                            <h3 class="disable-selection">Komputery</h3>
                        </a>
                        <a href="#" class="suggest-post">
                            <img src="img/piesek.jpg">
                            <h3 class="disable-selection">Akcesoria</h3>
                        </a>
                    </div>
                    <div class="line">
                        <a href="#" class="suggest-post">
                            <img src="img/piesek.jpg">
                            <h3 class="disable-selection">Telefony</h3>
                        </a>
                        <a href="#" class="suggest-post">
                            <img src="img/piesek.jpg">
                            <h3 class="disable-selection">Routery</h3>
                        </a>
                        <a href="#" class="suggest-post">
                            <img src="img/piesek.jpg">
                            <h3 class="disable-selection">Konsole</h3>
                        </a>
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