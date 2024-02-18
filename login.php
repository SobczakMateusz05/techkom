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
    <link rel="stylesheet" href="style/login.css">
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
                    echo '<a href="operation.php?operation=logout" class="active"> Wyloguj się</a>';
                }
                else{
                    echo '<a href="login.php" class="active">Zaloguj się</a>';
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
                    TechKom > Ten Sklep > Zaloguj się
                </h3>
            </div>
            <div class="right-bottom">
                <h1>Zaloguj się:</h1>
                    <?php
                
                if(isset($_POST["log"])){
                    $variable=0;
                    require_once "connect.php";
                    if($_POST["login"]!=""){
                        $variable+=1;
                        $login= $_POST["login"];
                    }
                    else{
                        echo '<h4 class="missed"> Nie wprowadziłeś loginu!</h4>';
                        $erloglog=7;
                    }
                    if($_POST["password"]!=""){
                        $variable+=1;
                        $pass=$_POST["password"];
                    }
                    else{
                        echo '<h4 class="missed"> Nie wprowadziłeś hasła!</h4>';
                        $erlogpass=7;
                    }
                    if($variable==2){

                        $sql = "SELECT id from user as u where u.name='$login' and u.password='$pass'";

                        if($result = @$conn->query($sql)){
                            $user_number=$result->num_rows;
                        if($user_number>0){
                            $row=$result->fetch_assoc();
                            $_SESSION['user']=$row['id'];
                            $result->free_result();
                            header("Location: index.php");
                        }
                        else{
                            echo '<h4 class="missed">Błedny login lub/i hasło!</h4>';
                        }
                        }
                        @$conn->close();

                    }

                }
                ?>
                <form method="POST" action="login.php">
                    <?php
                        if(isset($erloglog)){
                            echo '<p class="missed" >';
                        }
                        else{
                            echo "<p>";
                        }
                    ?>
                    Nazwa użytkownia:</p>
                    <input type="text" name="login">
                    <?php
                        if(isset($erlogpass)){
                            echo '<p class="missed" >';
                        }
                        else{
                            echo "<p>";
                        }
                    ?>
                    Hasło:</p>
                    <input type="password" name="password">
                    <div>
                    <input type="submit" value="Zaloguj się" class="button" name="log">
                    </div>
                </form>
                <h1>Zarejestruj się:</h1>
                <?php
            if(isset($_POST["reg"])){
                require_once "connect.php";
            
                $variable=0;
                if($_POST["login"]!=""){

                    $dlugosc =strlen($_POST["login"]);
                    if($dlugosc>50){
                        echo '<h4 class="missed"> Za długa nazwa użytkownika (wiecej niż 50 znaków)!</h4>';
                        $erlog=7;
                    }
                    if($dlugosc<2){
                        echo '<h4 class="missed"> Za krótka nazwa użytkownika (mniej niż 2 znaki)!</h4>';
                        $erlog=7;
                    }
                    if($dlugosc<=50&&$dlugosc>=5){
                        $login= $_POST["login"];
                        $variable+=1;
                    }
                }
                else{
                    $erlog=7;
                }
                if($_POST["mail"]!=""){
                    
                    $dlugosc =strlen($_POST["mail"]);
                    if($dlugosc>50){
                        echo '<h4 class="missed"> Za długi adres e-mail (wiecej niż 100 znaków)!</h4>';
                        $ermail=7;
                    }
                    else{
                        $mail=$_POST["mail"];
                        $variable+=1;
                    }
                }
                else{
                    $ermail=7;
                }
                if($_POST["password"]!=""){
                    $dlugosc =strlen($_POST["password"]);
                    if($dlugosc>50){
                        echo '<h4 class="missed"> Za długie hasło (wiecej niż 150 znaków)!</h4>';
                        $erpass=7;
                    }
                    if($dlugosc<5){
                        echo '<h4 class="missed"> Za krótkaie hasło (mniej niż 7 znaków)!</h4>';
                        $erpass=7;
                    }
                    if($dlugosc<=150&&$dlugosc>=7){
                        $pass= $_POST["password"];
                        $variable+=1;
                    }
                }
                else{
                    $erpass=7;
                }
                if($variable==3){
                    
                    $i=0;
                    $sql="SELECT name from user";

                    if($result = $conn->query($sql)){
                        while($i<$result->num_rows){
                            $row=$result->fetch_assoc();
                            if($row['name']==$login){
                                $operator=1;
                                $i=$result->num_rows;
                                
                            }
                            else{
                                $operator=0;
                                $i+=1;
                            }
                            
                        }
                        $result->free_result();
                    }
    
                    if($operator==0){
                        $sql="INSERT INTO user(name, password, mail) values ('$login', '$pass', '$mail')";

                        if($result = $conn->query($sql)){
                            echo '<h3 class= "green">Pomyślnie założono konto!<h3>';
                        }
                    }
                    else{
                        echo '<h3 class="missed">Nazwa użytkownika jest już zajęta! <h3>';
                    }
                }
               
            }
        ?>
        <form method="POST" action="login.php">
             
            Nazwa użytkownika:</p>
            <input type="text" name="login">
            <?php
                if(isset($ermail)){
                    echo '<p class="missed" >';
                }
                else{
                    echo "<p>";
                }
            ?>
            Adres e-mail:</p>
            <input type="email" name="mail">
            <?php
                if(isset($erpass)){
                    echo '<p class="missed" >';
                }
                else{
                    echo "<p>";
                }
            ?>
            Hasło:</p>
            <input type="password" name="password">
            <div>
            <input type="submit" value="Załóż konto" name="reg" class="button">
            </div>
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