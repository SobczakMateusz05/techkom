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
    <link rel="stylesheet" href="style/reclamation.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <title>Sklep internetowy</title>
    <script src="script.js"></script>
</head>
<body>
<?php
                if(isset($_GET["reclamation"])&&empty($_POST["number"])||isset($_GET["reclamation"])&&empty($_POST["reason"])){
                    header('Location:reclamation.php?choose=1');
                }
                ?>
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
                    TechKom > Ten Sklep > Usługi > Reklamacja
                </h3>
            </div>
            <div class="right-bottom ">
                <div class="right-left3 
                    <?php
                    if(empty($_SESSION["user"])||isset($_GET["choose"])||isset($_GET["reclamation"])){
                        echo "disable";
                    }
                    ?>
                ">
                    <h1>Wybierz opcje</h1>
                    <div class="choose">
                    <a href="reclamation.php?choose=1" class="button">Złóż reklamację</a>
                    <a href="reclamation.php?choose=2" class="button">Historia Reklamacji</a>
                    </div>
                </div>
                <div class="right-left
                <?php
                    if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                        echo " disable";
                    }
                    else{
                        
                    }
                    ?>
                ">
                    <div class="outlog">
                        <h1>Nie jesteś zalogowany!</h1>
                        <a href="login.php" class="button">Zaloguj się</a>
                    </div>
                </div>
                <div class="right-left d
                    <?php
                        if(empty($_SESSION["user"])||$_SESSION["user"]==""||empty($_GET["choose"])){
                            echo "disable";
                        }
                        if(isset($_GET["choose"])&&$_GET["choose"]!=1){
                            echo "disable";
                        }
                    ?>
                ">
                    <form method="POST" action="reclamation.php?reclamation=added">
                        <h1>Formularz reklamacji zamówienia</h1>
                        <h3>Numer zamówienia:</h3>
                        <select name="number">
                            <?php
                                if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                                    $id=$_SESSION["user"];
                                    $sql="SELECT DISTINCT number from orders where userid=$id";
                                    $result=$conn->query($sql);
                                    while($row=$result->fetch_assoc()){
                                        echo "<option>". $row["number"] ."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <h3>Powód reklamacji:</h3>
                        <textarea name="reason" placeholder="Przedstaw powód reklamacji" cols="40" rows="5" required></textarea>
                        <input type="submit" class="button">
                    </form>
                </div>
                <div class="right-left added 
                <?php
                if(isset($_SESSION["user"])&&$_SESSION["user"]!=""&&isset($_GET["reclamation"])){
                    $id=$_SESSION["user"];
                    $number=$_POST["number"];
                    $reason=$_POST["reason"];
                    $date=date('Y-m-d', time());
                    $sql="INSERT INTO reclamation(order_number,reason,date) values('$number','$reason','$date')";
                    $result=$conn->query($sql);
                }
                else{
                    echo "disable";
                }
                ?>
                ">
                    <h1 style="color: green;">Pomyślnie złożono reklamację</h1>
                    <img src="img/check_mark.gif">
                    <a href="index.php">Wróć do sklepu</a>
                </div>
                <div class="right-left2 
                <?php
                    if(empty($_SESSION["user"])||$_SESSION["user"]==""||empty($_GET["choose"])){
                        echo "disable";
                    }
                    if(isset($_GET["choose"])&&$_GET["choose"]!=2){
                        echo "disable";
                    }
                ?>
                ">
                    <h1>Historia twoich reklamacji</h1>
                    <?php
                        if(isset($_SESSION["user"])&&$_SESSION["user"]!=""&&$_GET["choose"]==2){
                            $id=$_SESSION["user"];
                            $sql="SELECT DISTINCT r.id, r.order_number, r.date from reclamation as r join orders as o on r.order_number=o.number where userid=$id";
                            $result=$conn->query($sql);
                            $num_row=mysqli_num_rows($result);
                            if($num_row==0){
                                echo '<h2 class="center"style="color: red; margin-top:25px;"> Nie znaleziono żadnej reklamacji</h2>';
                            }
                            else{
                                while($row=$result->fetch_assoc()){
                                    echo '<div class="post"><img src="img/complaint.png"><h2>Reklamacja nr.'. $row["id"] . '</h2><h2>Zamówienie nr.'.$row["order_number"].'</h2><h5>Data: '.$row["date"].'</h5></div>';
                                }
                            }
                        }
                    ?>
                    
                </div>
                <div class="right-right">
                    <img src="img/addR.png">
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