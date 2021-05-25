<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Restaurant numérique de hamburgers, accédez à la carte grâce à votre téléphone, pour déguster nos entrées, plats, desserts sans attendre">
    <title>Restaurant numérique</title>
    <!-- Base -->
    <base href="https://florenceast.sites.3wa.io/dev/florenceastruc/restaurant-numerique/">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="public/images/favicon_package/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="public/images/favicon_package/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon_package/favicon-16x16.png">
    <link rel="manifest" href="public/images/favicon_package/site.webmanifest">
    <link rel="mask-icon" href="public/images/favicon_package/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#b91d47">
    <meta name="theme-color" content="#ffffff">
    <!-- Pictos -->
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet"><!-- CSS -->
    <!-- CSS -->
    <link rel="stylesheet" href="public/css/normalize.css" type="text/css" />
    <link rel="stylesheet" href="public/css/theme.css" type="text/css" />
    <link rel="stylesheet" href="public/css/style.css" type="text/css" />
</head>

<body>
    <div class="container">
        <header>
            <!-- NavBar -->
            <nav class="connexion">
                <div class="toggle">
                    <span class="toggleBtn"></span>
                </div>
                <ul>
                    <?php if(isset($_SESSION['users'])) : ?>
                        <li><a href="logout">Déconnexion</a></li>
                        <li><a href="cartPage"><i class="fas fa-shopping-cart"></i></a></li>
                    <?php else: ?>
                        <li><a href="account">Inscription</a></li>
                        <li><a href="login">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <!-- End NavBar -->
            
            <!-- Logo -->
            <?php if(!isset($_SESSION['users'])): ?>
                <div class="background">
                    <picture>
                        <source media="(max-width: 768px)" srcset="public/images/header-burger-mobile_x2.jpg"/>
                        <img srcset="public/images/header-burger-laptop.jpg 1599w, public/images/header-burger-desktop.jpg 3000w" src="public/images/header-burger-desktop.jpg" sizes="(max-width: 1599px) 100vw, (max-width: 3000px) 100vw" alt="Hamburger"/>
                    </picture>
                </div>
            <?php endif; ?>
            <!-- End Logo -->
            
        </header>
        
        <main class="mainHome">
            <!-- Error404 -->
            <div class="modal errorDirection">
                <h2>Erreur de direction</h2>
                <p>Vous vous êtes égarés!</p>
                <div class="btn">
                    <a href="index.php" class="button">Retour</a>
                </div>
            </div>
            <!-- End Error404 -->
        </main> 
        
        <footer>
            <p>Suivez-nous sur les réseaux</p>
            <div class="pictoFooter">
                <a href="https://fr-fr.facebook.com/"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/?hl=fr"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
            </div>
            <p class="copyright">&copy; Copyright 2021 – tous droits réservés</p>
        </footer>    
    </div>

<!-- JavaScript -->    
<script src="public/js/index.js"></script>

</body>
</html>