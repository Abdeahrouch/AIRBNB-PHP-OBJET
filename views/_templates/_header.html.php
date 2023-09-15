<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php

            use Core\Session\Session;

            echo isset($title_tag) ? $title_tag : "AIRBNB" ?></title>


    <!-- importer le cdn bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- importer le cdn bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!--on link notre css-->
    <link rel="stylesheet" href="/style.css">

    <link rel="icon" href="https://www.pngkit.com/png/detail/60-606032_airbnb-a-icon-vector-logo-airbnb-logo-vector.png" type="image/x-icon">
</head>


<body>




    <?php
    $is_hote = Session::get(Session::USER);
    ?>
    <div>
        <nav class="navbar bg-body-tertiary">
            <form class="container-fluid justify-content-start">
                <?php if ($is_hote) : ?>
                    <a href="/" class="btn btn">Retour à l'accueil</a>
                    <a href="/logout" class="btn btn">Déconnexion</a>
                    <a href="/bien" class="btn btn">Mes biens</a>
                    <a href="/bien" class="btn btn">Ajouter un bien</a>

                <?php else : ?>
                    <a href="/" class="btn btn">Retour à l'accueil</a>
                    <a class="btn btn-outline-success me-2" href="/inscription/">Inscription</a>
                    <a class="btn btn-sm btn-outline-secondary" href="/login/">Se connecter</a>
                <?php endif; ?>
            </form>
        </nav>

    </div>