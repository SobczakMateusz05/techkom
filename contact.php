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
    <link rel="stylesheet" href="style/contact.css">
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
                <a href="contact.php" class="active">Kontakt</a>
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
            <div class="right-top">
                <h3 class="disable-selection">
                    TechKom > Kontakt
                </h3>
            </div>
            <div class="right-bottom">
                <div class="right-left">
                    <h2>
                        Lokalizacja
                    </h2>
                    <div class="popular-post">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1434461.8791000696!2d2.357768520378983!3d6.748059667786382!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b936639fd4c1b%3A0x1a51bd59b4c1a68c!2sIt%20Afrika%20International!5e0!3m2!1spl!2spl!4v1706776990360!5m2!1spl!2spl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="right-right">
                    
                    <h2>
                        Kontakt
                    </h2>
                    <div class="suggest-post">
                        <h2>Numer kontaktowy:</h2>
                        <a href="tel:+2348033829632">+234 803 382 9632</a>
                    </div>
                    <div class="suggest-post">
                        <h2>Adres e-mail:</h2>
                        <a href="mailto:nigeriait@gmail.com">nigeriait@gmail.com</a>
                    </div>
                    <div class="suggest-post">
                        <h2>Adres: </h2>
                        <h2>Plot 24 Omole Layout, Allen, Ikeja 101233, Lagos, Nigeria</h2>
                    </div>
                    <div class="suggest-post">
                        <div>
                            <h2> poniedziałek</h2>
                            <h2>wtorek</h2>
                            <h2>środa</h2>
                            <h2>czwartek</h2>
                            <h2>piątek</h2>
                            <h2>sobota</h2>
                            <h2>niedziela</h2>
                        </div>
                        <div>
                            <h2>08:00–17:00</h2>
                            <h2>08:00–17:00</h2>
                            <h2>08:00–17:00</h2>
                            <h2> 08:00–17:00</h2>
                            <h2>10:00–15:00</h2>
                            <h2>Zamknięte</h2>
                            <h2>08:00–17:00</h2>
                        </div>
                        
                    </div>
                    <div class="suggest-post">
                        <h2>Prezes zarządu:</h2>
                        <h2>Uwuwewewe Onyetenyevwe Ugwemuhwem Osas</h2>
                    </div>
                    <div class="suggest-post">
                        <img src="img/prezes.png" alt="prezes">
                    </div>
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