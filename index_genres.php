<?php
    ob_start();
    $pdo = new PDO("mysql:host=193.124.177.57;dbname=db526480", "u526480umgh", "lZGtq9KXFkmmwr2tkzTr");
    $info = [];  
    $sql = 'SELECT * FROM Genres_Knigi';
    $q = $pdo->query($sql);
    $info = $q->fetchAll(PDO::FETCH_ASSOC); 
    if (!empty($_COOKIE['sid'])) {session_id($_COOKIE['sid']);}
    session_start();
    require_once 'classes/Auth.class.php';
    require_once 'stayt.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Жанры</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Caveat:wght@700&family=Lato:wght@400;700;900&family=Pacifico&family=Play&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="header__logo">
                    <ul>
                        <li class="logo"><a href="index.html">
                        Читаем<span>Вместе</span></a></li>
                        <li class="logo__logo"><a href="index.html">
                            Электронная библиотека</a></li>
                    </ul>
                </div>
                <div class = "header__aut">
                <?php if (Auth\User::isAuthorized()): ?>
                    <p class="privet">Привет, <?php echo "<span class='name'>".$arr['names']."</span>!";?></p>
                    <form novalidate="novalidate" class="form-signin-2 ajax" method="post" action="ajax.php">
                        <input type="hidden" name="act" value="logout">
                        <input type="submit" class="vyxod" value="Выйти" />
                    </form>
                <?php else: ?>
                    <a href="" class = "header__autt"> Вход</a>
                    <form class="form-signin ajax" method="post" action="ajax.php">
                    <p class="ogl">Авторизация</p>
                    <div class="main-error alert alert-error hide"></div>
                    <span class="testex">Введите E-mail</span><br />
                    <input name="username" type="text" class="input-block-level"><br />
                    <span class="testex">Введите пароль</span><br />
                    <input name="password" type="password" class="input-block-level"><br />
                    <input type="checkbox" name="remember-me" style="display:none" checked>
                    <input type="hidden" name="act" value="login">
                    <input type="submit" class="button"  value="Войти">
                    </form>
                    <a href="registr.php"> Регистрация </a>
                    <ul><li>Здраствуйте Читатель!</li></ul>
                    <?php endif; ?>
                </div>
                <div class="header__poisk"></div>
            </div>
        </div>
    </header>
    <section class="section__menu">
        <div class="container">
            <div class="section__inner">
                <nav class="section__nav">
                    <ul>
                        <li><a href="index.html">Главная страница</a></li>
                        <li><a href="index_genres.php">Жанры</a>
                        </li>
                        <li><a href="index_avtor.php">Авторы</a></li>
                        <?php if (Auth\User::isAuthorized()): ?>
                        <li><a href="users_kab.html">Личный кабинет</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <section class="Genres">
        <div class="container">
            <div class="knigi__inner">
                <div class="Genres_Text">
                    <form action="" method="POST">
                        <?php  foreach($info as $d): ?>
                        <input  name="<?php $i++; echo $i; ?>" type="submit" value="<?php  echo $d['Genre'];?>"/>
                            <?php 
                            if (isset($_POST[$i]))  
                                {
                                    $sortir = $d['Genre'];
                                };?>
                        <?php 
                        endforeach;
                        if($sortir != null){
                            include "genr.php";
                        }
                        ?>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>
    <footer>
    <div class = "container">
        <div class="footer-distributed">
            <div class="footer-right">
            <a href="https://vk.com/public213478821" style="background-image: url('/icons/VK-Icon_icon-icons.com_52860.png'); "></a>
            <a href="https://github.com/DaniilKalabkin/WebSite" style="background-image: url('/icons/github_git_hub_logo_icon_132878.png');"></a>
            </div>
        <div class="footer-left">
            <p class="footer-links">
                <a class="link-1" href="index.html">Главная страница</a>
                <a href="index_info.html">Информация о сайте</a>
                <a href="index_kontakt.html">Контакты</a>
            </p>
        <p>КИТП &copy; 2022</p>
            </div>
        </div>
    </div>
</footer>
    
        </body>
</html>