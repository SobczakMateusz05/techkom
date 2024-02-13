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
    <link rel="stylesheet" href="style/addopinion.css">
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
                    TechKom > Ten Sklep > Usługi > Opinie
                </h3>
            </div>
            <div class="right-bottom">
                <form method="POST" action="addopinion.php" class="
                <?php
                    if(isset($_POST["send"])){
                        echo "disable";
                    }
                ?>
                ">
                    <h1>Dodaj opinie</h1>
                    <h3>Twoja nazwa:</h2>
                    <input type="text" name="nick" required placeholder="Wprowadź nazwę użytkownika">
                    <h3>Treść opinii:</h2>
                    <textarea name="opinion" cols="40" rows="5" required></textarea>
                    <h3>Twoja ocena:</h2>
                    <select name="mark" required>
                    <?php
                        scale();
                    ?>
                    </select>
                    <input type="submit" value="Dodaj opinie" name="send">
                </form>
                <div class="
                <?php
                    if(empty($_POST["send"])){
                        echo "disable";
                    }
                    else{
                        $user = $_POST["nick"];
                        $date=date('Y-m-d', time());
                        $opinion=$_POST["opinion"];
                        $rating=$_POST["mark"];

                        $sql= "INSERT INTO rewiews(username,date, review, rating) values ('$user','$date','$opinion','$rating')";
                        $result=$conn->query($sql);
                    }
                ?>
                ">
                    <h1 style="color: green;">Pomyślnie dodano opinie</h1>
                    <img src="img/check_mark.gif">
                    <a href="opinion.php">Wróć do opinii</a>
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