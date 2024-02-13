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
    <link rel="stylesheet" href="style/index.css">
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
                <a href="index.php"  class="active">Stona Główna</a>
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
                    <li class="actual disable disable-selection"><a href="about.php">Nasz sklep</a></li>
                    <li class="actual disable disable-selection"><a href="#">Benchmark</a></li>
                </ul>
            </ul>
        </div>
        <div class="right">
            <div class="
            <?php
                if(isset($_GET["add"])){
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
                    else{
                        echo '<h2 style="color: red;">Maksymalna ilość tego przedmiotu w koszyku!</h2>';
                    }
                ?>
                <div class="flex">
                    <a href="index.php" class="button2">Kontunnuj zakupy</a>
                    <a href="cart.php" class="button2">Przejdź do koszyka</a>
                </div>
            </div>
            </div>
            <div class="right-top">
                <h3 class="disable-selection">
                    TechKom > Ten Sklep > Strona Główna
                </h3>
            </div>
            <div class="right-bottom">
                <div class="right-left">
                    <h2>
                        Najpopularniejsze
                    </h2>

                    <?php
                    $sql = " SELECT * FROM produkty ORDER BY popularity desc LIMIT 15";
                    if($result = $conn->query($sql)){
                        while($row=$result->fetch_assoc()) 
		                {
                            echo '<div class="popular-post"> <img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['image']).'" />';
                            echo '<div class="in"> <div> <h2>'. $row["name"] . '</h2> <p>'. $row["description"]. '</p> <h2>'. $row["price"] .' zł</h2> </div>';
                            echo '<div class="addbasket disable-selection"> <a href="#" onclick="operation('.$row["id"].','."'addindex'".')"';
                            echo '>Dodaj do koszyka</a> </div> </div> </div>';
		                }
                    }
                    else{
                        echo "Nie odczytano żadnych danych";
                    }
                    ?>
                </div>
                <div class="right-right">
                    
                    <h2>
                        Najnowsze
                    </h2>
                    <?php
                    $sql = " SELECT * FROM produkty ORDER BY id DESC LIMIT 20";
                    if($result = $conn->query($sql)){
                        while($row=$result->fetch_assoc()) 
		                {
                            echo '<div class="suggest-post"> <img class="item_image" src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['image']).'" />';
                            echo '<div class="in"> <div> <h2>'. $row["name"] . '</h2> </div> </div> </div>';
		                }
                    }
                    else{
                        echo "Nie odczytano żadnych danych";
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