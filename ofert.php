<?php
session_start();
    require_once "connect.php";
    require_once "function.php";
    if(empty($_GET["category"])){
        header('Location:index.php');
    }
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
            <div class="
                <?php
                    if(isset($_GET["add"])||isset($_GET["log"])){
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
                        if(isset($_GET["add"])&&$_GET["add"]=="no"){
                            echo '<h2 style="color: red;">Maksymalna ilość tego przedmiotu w koszyku!</h2>';
                        }
                        if(isset($_GET["log"])){
                            echo '<h2>Nie jesteś zalogowany </h2>';
                        }
                    ?>
                    <div class="flex">
                        <a href="#" class="button2" onclick=
                        <?php
                            echo '"category('."'".$_GET["category"]."'" .')"';
                        ?>
                        >
                        Kontunnuj zakupy</a>
                        <?php
                            if(isset($_GET["log"])){
                               echo '<a href="login.php" class="button2">Zaloguj się</a>';
                            }
                            else echo '<a href="cart.php" class="button2">Przejdź do koszyka</a>';
                        ?>
                    </div>
                </div>
            </div>
            <div class="right-top">
                <h3 class="disable-selection">
                    TechKom > Ten Sklep > 
                    <?php
                    if($_GET["category"]=="serwis"){
                        echo "Usługi > ";
                    }
                    else{
                        echo "Produkty > ";
                    }
                    echo UCWORDS($_GET["category"]);
                    ?>
                </h3>
            </div>
            <div class="right-bottom">
                <div class="right-left">
                    <h2>
                    <?php
                    echo UCWORDS($_GET["category"]);
                    ?>
                    </h2>
                    <div class="buttons-option">
                        <?php
                        if($_GET["category"]=="komputery"||$_GET["category"]=="laptopy"){
                            echo '<h3 class="disable-selection button" onclick="list('."'filtr'".')">Filtrowanie</h3>';
                        }
                        ?>
                        <form>
                            <select onchange="sort()" class="button" id="mySelect">
                                <option>Wybierz typ sortowania...</option>
                                <option value="1"
                                <?php
                                if(isset($_GET["sort"])){
                                    if($_GET["sort"]=="1"){
                                        echo 'selected="selected"';
                                    }
                                }
                                ?>
                                >Od najniższej ceny</option>
                                <option value="2"
                                <?php
                                if(isset($_GET["sort"])){
                                    if($_GET["sort"]=="2"){
                                        echo 'selected="selected"';
                                    }
                                }
                                ?>
                                >Od najwyższej ceny</option>
                            </select>
                        </form>
                        <div class="button"
                        <?php
                            echo 'onclick="category('. "'" .$_GET["category"]. "'" . ')"';
                        ?>
                        >
                        RESET
                        </div>
                    </div>
                    <div class="filtr disable">
                        <h3> FILTRY</h3>
                        <form class="filtrform">
                            <h4>Procesor: 
                                <select id="proc" onchange="filtr('proc')">
                                    <option value="0"> Wybierz procesor </option>
                                    <?php
                                        $sql="SELECT Distinct procesor FROM produkty WHERE procesor is not null ORDER BY procesor ASC";
                                        if( $_GET["category"]=='komputery'){
                                            $sql="SELECT Distinct procesor FROM produkty as p JOIN type as t ON p.type = t.id WHERE procesor is not null and t.nazwa='komputery' ORDER BY procesor ASC";
                                        }
                                        if($_GET["category"]=='laptopy'){
                                            $sql="SELECT Distinct procesor FROM produkty as p JOIN type as t ON p.type = t.id WHERE procesor is not null and t.nazwa='laptopy' ORDER BY procesor ASC";
                                        }
                                        if($result=$conn->query($sql)){
                                            while($row=$result->fetch_assoc()){
                                                echo "<option value=". '"' . $row["procesor"]. '" ';
                                                if(isset($_GET["proc"])&&$row["procesor"]==$_GET["proc"]){
                                                    echo 'selected="selected"';
                                                }
                                                echo '>'. $row["procesor"] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </h4>
                            <h4>Pamięć RAM: 
                                <select id="ram" onchange="filtr('ram')">
                                <option value="0"> Wybierz ilość pamięci RAM</option>
                                <?php
                                        $sql="SELECT Distinct ram FROM produkty WHERE ram is not null ORDER BY ram ASC";
                                        if( $_GET["category"]=='komputery'){
                                            $sql="SELECT Distinct ram FROM produkty as p JOIN type as t ON p.type = t.id WHERE ram is not null and t.nazwa='komputery' ORDER BY ram ASC";
                                        }
                                        if($_GET["category"]=='laptopy'){
                                            $sql="SELECT Distinct ram FROM produkty as p JOIN type as t ON p.type = t.id WHERE ram is not null and t.nazwa='laptopy' ORDER BY ram ASC";
                                        }
                                        
                                        if($result=$conn->query($sql)){
                                            while($row=$result->fetch_assoc()){
                                                echo "<option value=". '"' . $row["ram"]. '"';
                                                if(isset($_GET["ram"])&&$row["ram"]==$_GET["ram"]){
                                                    echo 'selected="selected"';
                                                }
                                                echo '>'. $row["ram"] . " GB </option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </h4>
                        </form>
                    </div>
                    <?php
                    $category=$_GET["category"];
                    $sql = " SELECT *, p.id , IF(prom.new_price is not null, new_price, price) as price1 FROM produkty as p  left join promotion as prom on p.id=prom.prod_id JOIN type as t ON p.type = t.id WHERE t.nazwa='$category'";

                    if(isset($_GET["ram"])||isset($_GET["proc"])||isset($_GET["ram"])&&isset($_GET["proc"])){
                        if(isset($_GET["ram"])){
                            $ram=$_GET["ram"];
                        }
                        else{
                            $ram=0;
                        }
                        if(isset($_GET["proc"])){
                            $proc=$_GET["proc"];
                        }
                        else{
                            $proc=0;
                        }
                        if($ram!=0&&$proc!=0){
                            $sql = " SELECT *, p.id , IF(prom.new_price is not null, new_price, price) as price1 FROM produkty as p  left join promotion as prom on p.id=prom.prod_id JOIN type as t ON p.type = t.id WHERE t.nazwa='$category' and p.ram='$ram' and p.procesor='$proc'";
                        }
                        if($ram!=0&&$proc==0){
                            $sql = " SELECT *, p.id , IF(prom.new_price is not null, new_price, price) as price1 FROM produkty as p  left join promotion as prom on p.id=prom.prod_id JOIN type as t ON p.type = t.id WHERE t.nazwa='$category' and p.ram='$ram'";
                        }
                        if($ram==0&&$proc!=0){
                            $sql = " SELECT *, p.id , IF(prom.new_price is not null, new_price, price) as price1 FROM produkty as p  left join promotion as prom on p.id=prom.prod_id JOIN type as t ON p.type = t.id WHERE t.nazwa='$category' and p.procesor='$proc'";
                        }
                        //SELECT *, IF(prom.new_price is not null, new_price, price) as price1 from produkty as p left join promotion as prom on p.id=prom.prod_id 
                    }
                    if(isset($_GET["sort"])){
                        if($_GET["sort"]==1){
                            $sortowanie = "ORDER BY price1 ASC";
                            $sql = $sql . $sortowanie;
                        }
                        if($_GET["sort"]==2){
                            $sortowanie= "ORDER BY price1 DESC";
                            $sql = $sql . $sortowanie;
                        }
                    }
                    
                    if($result = $conn->query($sql)){
                        if(mysqli_num_rows($result)!=0){
                            $num_row=mysqli_num_rows($result)*2;
                            while($row=$result->fetch_assoc()) 
		                    {
                                $id=$row["id"];
                                echo '<div class="popular-post" onclick="spec('.$row["id"].')"> <img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['image']).'" />';
                                echo '<div class="in"> <div> <h2>'. $row["name"] . '</h2> <p>'. $row["description"]. '</p>';
                                $sql7="SELECT new_price from promotion where prod_id=$id";
                                $result7=$conn -> query($sql7);
                                $num_row7 = mysqli_num_rows($result7);
                                if($num_row7<1){
                                    echo '<h2>'. $row["price"] .' zł</h2>';
                                }
                                else{
                                    $row7=$result7->fetch_assoc();
                                    echo '<h2 class="overline">'. $row["price"]. ' zł</h2><h2 class="red">'. $row7["new_price"]. ' zł</h2>';
                                }
                                echo '</div><div class="addbasket disable-selection"> <a href="#" onclick="operation('.$row["id"].',';
                                if(isset($_SESSION["user"])&&$_SESSION["user"]!=""){
                                    echo  "'add'";
                                }
                                else{
                                    echo  "'logadd'";
                                }
                                echo '); event.stopPropagation();"';
                                echo '>Dodaj do koszyka</a> </div> </div> </div>';
		                    }
                        }
                        else{
                            $num_row=3;
                            echo "<h2 style=". '"color: red; margin-top:25px;"'."> Nie znaleziono żadnego przedmiotu</h2>";
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
                    $sql = " SELECT p.id, p.name, p.image FROM produkty as p join type as t on t.id=p.type where t.id!=7 ORDER BY p.id DESC LIMIT $num_row";
                    if($result = $conn->query($sql)){
                        while($row=$result->fetch_assoc()) 
		                {
                            echo '<div class="suggest-post" onclick="spec('.$row["id"].')"> <img class="item_image" src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['image']).'" />';
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