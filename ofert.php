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
                <h2>Dodano produkt do koszyka</h2>
                <div class="flex">
                    <a href="#" class="button2" onclick=
                    <?php
                        echo '"category('."'".$_GET["category"]."'" .')"';
                    ?>
                    >
                    Kontunnuj zakupy</a>
                    <a href="cart.php" class="button2">Przejdź do koszyka</a>
                </div>
            </div>
            <div class="right-top">
                <h3 class="disable-selection">
                    TechKom > Ten Sklep > Produkty > 
                    <?php
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
                            echo '<h3 class="disable-selection button" onclick="list('."'filtr'".')">Filtrowanie</h3>
                            <img src="img/matrixpills.png">';
                        }
                        ?>
                        <form   method="POST" action="ofert.php?category=<?php echo $_GET["category"];?>">
                            <select name="sort" onchange="this.form.submit()" class="button">
                                <option>Wybierz typ sortowania...</option>
                                <option value="1"
                                <?php
                                if(isset($_POST["sort"])){
                                    if($_POST["sort"]=="1"){
                                        echo 'selected="selected"';
                                    }
                                }
                                ?>
                                >Od najniższej ceny</option>
                                <option value="2"
                                <?php
                                if(isset($_POST["sort"])){
                                    if($_POST["sort"]=="2"){
                                        echo 'selected="selected"';
                                    }
                                }
                                ?>
                                >Od najwyższej ceny</option>
                            </select>
                            <noscript><input type="submit" name="submit" value="sort"></noscript>
                        </form>
                    </div>
                    <div class="filtr disable">
                        <h3> FILTRY</h3>
                        <form method="POST" action="ofert.php?category=<?php echo $_GET["category"];?>" class="filtrform">
                            <h4>Procesor: 
                                <select name="proc">
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
                                                echo "<option value=". '"' . $row["procesor"]. '">'. $row["procesor"] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </h4>
                            <h4>Pamięć RAM: 
                                <select name="ram">
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
                                                echo "<option value=". '"' . $row["ram"]. '">'. $row["ram"] . " GB </option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </h4>
                                <input type="submit" name="submit" value="Filtruj">
                        </form>
                    </div>
                    <?php
                    $category=$_GET["category"];
                    $sql = " SELECT *, p.id FROM produkty as p JOIN type as t ON p.type = t.id WHERE t.nazwa='$category'";

                    if(isset($_POST["submit"])){
                        $ram=$_POST["ram"];
                        $proc=$_POST["proc"];
                        if($ram!=0&&$proc!=0){
                            $sql = " SELECT *, p.id FROM produkty as p JOIN type as t ON p.type = t.id WHERE t.nazwa='$category' and p.ram='$ram' and p.procesor='$proc'";
                        }
                        if($ram!=0&&$proc==0){
                            $sql = " SELECT *, p.id FROM produkty as p JOIN type as t ON p.type = t.id WHERE t.nazwa='$category' and p.ram='$ram'";
                        }
                        if($ram==0&&$proc!=0){
                            $sql = " SELECT *, p.id FROM produkty as p JOIN type as t ON p.type = t.id WHERE t.nazwa='$category' and p.procesor='$proc'";
                        }
                        
                    }
                    if(isset($_POST["sort"])){
                        if($_POST["sort"]==1){
                            $sql = " SELECT *, p.id FROM produkty as p JOIN type as t ON p.type = t.id WHERE t.nazwa='$category' ORDER BY p.price ASC";
                        }
                        if($_POST["sort"]==2){
                            $sql = " SELECT *, p.id FROM produkty as p JOIN type as t ON p.type = t.id WHERE t.nazwa='$category' ORDER BY p.price DESC";
                        }
                    }
                    
                    if($result = $conn->query($sql)){
                        if(mysqli_num_rows($result)!=0){
                            $num_row=mysqli_num_rows($result)*2;
                            while($row=$result->fetch_assoc()) 
		                    {
                                echo '<div class="popular-post"> <img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['image']).'" />';
                                echo '<div class="in"> <div> <h2>'. $row["name"] . '</h2> <p>'. $row["description"]. '</p> <h2>'. $row["price"] .' zł</h2> </div>';
                                echo '<div class="addbasket disable-selection"> <a href="#" onclick="operation('.$row["id"].','."'add'".')"';
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
                    $sql = " SELECT * FROM produkty ORDER BY id DESC LIMIT $num_row";
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