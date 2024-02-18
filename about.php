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
    <link rel="stylesheet" href="style/about.css">
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
                <a href="about.php" class="active">O nas</a>
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
                    TechKom > O nas
                </h3>
            </div>
            <div class="right-bottom">
                <div class="right-left">
                    <h2>
                        Historia firmy:
                    </h2>
                    <div class="popular-post">
                        <p>
                            W 1549 roku, na ziemiach dzisiejszej Nigerii, narodziła się historia, która miała zmienić oblicze technologiczne Afryki. Jej architektem był Chamberlin Stephan Azebaze Mboving, wizjoner z głębokim przekonaniem, że technologia może być kluczem do rozwoju społeczności i gospodarki. W czasach, gdy większość Afryki pozostawała w stadium rozwoju prymitywnych form technologicznych, Mboving widział potencjał w wykorzystaniu nowoczesnych technologii do poprawy jakości życia ludzi.

                            Początki firmy były skromne. Mboving, mający jedynie niewielkie środki oraz wsparcie lokalnej społeczności, rozpoczął pracę nad prostymi urządzeniami technologicznymi, takimi jak narzędzia rolnicze czy systemy nawadniające. Jego pasja i determinacja szybko przyciągnęły uwagę inwestorów, którzy zaczęli wspierać jego przedsięwzięcie.
                            
                            Wraz z rozwojem firmy techkom, Mboving poszerzał jej działalność na kolejne obszary technologiczne. Początkowo skupiał się głównie na produkcji hardware'u, ale w miarę postępu technologicznego firma zaczęła również inwestować w oprogramowanie, sztuczną inteligencję i internet rzeczy. Z każdym krokiem firma ewoluowała, dostarczając innowacyjne rozwiązania, które miały zmieniać życie ludzi na lepsze.
                            
                            W ciągu kolejnych wieków, firma techkom stała się jednym z czołowych graczy na afrykańskim rynku technologicznym, przynosząc innowacyjne rozwiązania, które wpływały na życie milionów ludzi. Od systemów zarządzania wodą po platformy e-commerce, firma Mbovinga zrewolucjonizowała sposób, w jaki Afryka korzysta z technologii.
                            
                            W 2024 roku, Uwuwewewe Onyetenyevwe Ugwemuhwem Osas został mianowany prezesem zarządu firmy techkom, kontynuując dziedzictwo Mbovinga i jego misję poprawy warunków życia afrykańskich społeczności poprzez technologię. Pod jego przywództwem, firma skupia się na rozwijaniu cyfrowej infrastruktury, promowaniu innowacyjności technologicznej oraz zapewnianiu dostępu do Internetu dla wszystkich mieszkańców Nigerii.
                            
                            Dzięki zaangażowaniu Osasa i jego zespołu, firma techkom nadal odgrywa kluczową rolę w kształtowaniu przyszłości Nigerii i całego kontynentu afrykańskiego poprzez wykorzystanie potencjału technologicznego do budowy lepszej i bardziej zrównoważonej przyszłości.
                            
                            Firma techkom nie tylko dostarcza urządzenia techniczne, ale także przyczynia się do rozwoju lokalnej społeczności poprzez inwestowanie w edukację technologiczną i promowanie przedsiębiorczości. Dzięki programom szkoleniowym i inicjatywom społecznym, firma staje się centrum innowacji i rozwoju w Nigerii, wspierając młodych przedsiębiorców i przyczyniając się do tworzenia nowych miejsc pracy.
                            
                            Oferta produktowa firmy techkom obejmuje szeroki zakres urządzeń techniki komputerowej, począwszy od prostych laptopów po zaawansowane systemy informatyczne dla firm i instytucji. Dzięki ciągłemu rozwojowi i innowacjom, firma techkom zachowuje swoją pozycję jako lider na rynku, dostarczając produkty najwyższej jakości, które spełniają potrzeby nawet najbardziej wymagających klientów.
                            
                            Pod przywództwem Uwuwewewe Onyetenyevwe Ugwemuhwem Osasa, firma techkom kontynuuje swoją misję przyczyniania się do rozwoju Nigerii poprzez technologię. Jego wizja obejmuje dalszy rozwój cyfrowej infrastruktury, promowanie przedsiębiorczości technologicznej i zwiększenie dostępu do Internetu dla wszystkich mieszkańców Nigerii.
                            
                            Dzięki zaangażowaniu i determinacji całego zespołu, firma techkom nadal pozostaje pionierem i liderem na rynku technologicznym w Afryce, zmieniając życie milionów ludzi i inspirując kolejne pokolenia do podążania za swoimi marzeniami. Jej historia jest świadectwem potęgi ludzkiej wizji i możliwości technologii w kształtowaniu przyszłości społeczeństwa.
                        </p>
                    </div>
                </div>
                <div class="right-right">
                    
                    <h2>
                        Założyciel:
                    </h2>
                    <div class="suggest-post">
                        <h2>Imię założyciela:</h2>
                        <h2>Chamberlin Stéphane Azebaze Mboving</h2>
                    </div>
                    <div class="suggest-post">
                        <img src="img/tworca.png" alt="tworca">
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