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
    <link rel="stylesheet" href="style/opinion.css">
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
                    <li class="usluga disable disable-selection"><a href="ofert.php?category=serwis">Serwis</a></li>
                    <li class="usluga disable disable-selection"><a href="opinion.php">Opinie</a></li>
                    <li class="usluga disable disable-selection"><a href="reclamation.php">Reklamacja</a></li>
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
            <div class="right-top">
                <h3 class="disable-selection">
                    TechKom > Ten Sklep > Usługi > Opinie
                </h3>
                <?php
                if(empty($_GET["opinion"])){
                    echo '<a href="opinion.php?opinion=add">Dodaj opinie</a>';
                }

                ?>
            </div>
            <div class="right-bottom
            <?php
                if(isset($_GET["opinion"])){
                    echo 'disable';
                }
            ?>
            ">
                <h2>
                    Opinie
                </h2>
                <h4>Średnia opnii:
                    <?php
                    $sql="SELECT ROUND(Avg(rating), 2) as avg from rewiews";
                    $result=$conn->query($sql);
                    $row=$result->fetch_assoc();
                    echo $row["avg"];
                    ?>
                / 5</h4>
                <?php
                    $sql = " SELECT * FROM rewiews";
                    if($result = $conn->query($sql)){
                        while($row=$result->fetch_assoc()) 
                        {
                            echo '<div class="opinion"> <div class="topop"><h2></h2><h2>'. $row['username']. '</h2><h2>'; 
                            echo $row["rating"]. '/ 5</h2></div> <h3>';
                            echo  $row['review']. '</h3> <h5> Data dodania: '. $row['date']. ' </h5> </div>';
                        }
                    }
                    else{
                        echo "Nie znaleziono żadnych opinii";
                    }
                ?>
            </div>
            <div class="right-bottom2
            <?php
                if(empty($_GET["opinion"])){
                    echo 'disable';
                }
            ?>
            ">
            <form method="POST" action="opinion.php?opinion=added" class="
                <?php
                    if(isset($_POST["send"])){
                        echo "disable";
                    }
                ?>
                ">
                    <h1>Dodaj opinie</h1>
                    <h3>Twoja nazwa:</h2>
                    <input type="text" name="nick" required placeholder="Wprowadź nazwę użytkownika" 
                    <?php 
                    if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                        $id=$_SESSION["user"];
                        $sql = "SELECT name from user where id=$id";
                        $result=$conn->query($sql);
                        $row=$result->fetch_assoc();
                        echo 'value= " ' . $row["name"] . '"'; 
                    }
                    ?>>
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