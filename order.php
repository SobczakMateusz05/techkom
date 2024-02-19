<?php
    session_start();
    require_once "connect.php";
    require_once "function.php";
    if(empty($_POST["send"])){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/order.css">
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
            <?php
            $sql="SELECT max(number) as max from orders";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $number=$row["max"]+1;

            $name=$_POST["imie"];
            $subname=$_POST["nazwisko"];
            $tel=$_POST["tel"];
            $mail=$_POST["mail"];
            $street=$_POST["ulica"];
            $home_number=$_POST["adres"];
            $city=$_POST["miasto"];
            $delivery=$_POST["delivery"];
            $pay=$_POST["pay"];
            $date=date('Y-m-d', time());
            $userid=$_SESSION["user"];

            $sql="SELECT * from cart";
            $result=$conn->query($sql);
            while($row=$result->fetch_assoc()){
                $id=$row["id"];
                $amount=$row["amount"];
                $sql2="INSERT INTO orders(number,
                product,
                amount,
                date,
                name,
                subname,
                tel,
                mail,
                miasto,
                home_number,
                street,
                payment,
                delivery,
                userid
                ) values(
                    '$number',
                    '$id',
                    '$amount',
                    '$date',
                    '$name',
                    '$subname',
                    '$tel',
                    '$mail',
                    '$city',
                    '$home_number',
                    '$street',
                    '$pay',
                    '$delivery',
                    '$userid')";
                $result2=$conn->query($sql2);
            }
            $result=$conn->query($sql);
            while($row=$result->fetch_assoc()){
                $id=$row["id"];
                $sql2="SELECT popularity from produkty where id=$id";
                $result2=$conn->query($sql2);
                $row2=$result2->fetch_assoc();
                $popularity=$row2["popularity"]+$row["amount"];
                $sql3="UPDATE produkty set popularity=$popularity where id=$id";
                $result3=$conn->query($sql3);

            }
            $sql="DELETE from cart";
            $result=$conn->query($sql);
            ?>
            <h1>
                Zamówienie nr.
                <?php
                    echo $number;
                ?>
                złożono pomyślnie
            </h1>
            <img src="img/check_mark2.gif">
            <h2>Dane klienta</h2>
            <div>
                <h3>Imię: <?php echo $name; ?></h3>
                <h3>Nazwisko: <?php echo $subname; ?></h3>
                <h3>Numer telefonu: <?php echo $tel; ?></h3>
                <h3>Adres e-mail: <?php echo $mail; ?></h3>
            </div>
            <h2>Dostawa</h2>
            <div>
                <h3>Rodzaj dostawy: 
                    <?php
                    $sql="SELECT name from delivery where id=$delivery";
                    $result=$conn->query($sql);
                    $row=$result->fetch_assoc();
                    echo $row["name"];
                    ?>
                </h3>
                <h3>Miasto: <?php echo $city; ?></h3>
                <h3>Ulica: <?php echo $street; ?></h3>
                <h3>Adres: <?php echo $home_number; ?></h3>
            </div>
            <h2>Szczegóły zamównienia</h2>
            <div>
                <h3>Data: <?php echo $date; ?></h3>
                <h3>Łączna kwota:
                    <?php
                        $sum=0;
                        $sql = "SELECT p.price as price , o.amount as amount, d.cost as del from ((orders as o join delivery as d on d.id=o.delivery) join produkty as p on o.product = p.id) where o.number=$number";
                        $result = $conn -> query($sql);
                        while($row=$result->fetch_assoc()){
                            $sum+=$row["price"]*$row["amount"];
                        }
                        $result = $conn -> query($sql);
                        $row=$result->fetch_assoc();
                        @$sum+=$row["del"];
                        echo $sum;
                    ?>
                zł</h3>
                <h3>Forma płatności: 
                <?php
                    $sql="SELECT method from payments where id=$pay";
                    $result=$conn->query($sql);
                    $row=$result->fetch_assoc();
                    echo $row["method"];
                    ?>
                </h3>
            </div>
            <a href="index.php">Powrót do sklepu</a>
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