<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Véville | Location de véhicules</title>
    <meta name="description" content="">
    <meta name="author" content="Pierre Mortier 2021">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold fs-4" href="?route=index">Véville Location</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php
                            if (!isset($_SESSION['membre'])) echo "<a class='btn btn-primary me-3 my-1' data-bs-toggle='modal' data-bs-target='#sign_up'>S'inscrire</a>"
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (!isset($_SESSION['membre'])) echo "<a class='btn btn-primary me-2 my-1' data-bs-toggle='modal' data-bs-target='#sign'>Se connecter</a>"
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['membre'])) : ?>
                                <a class="btn btn-primary me-2 my-1" href="?route=logout">Déconnexion</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mon compte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contactez-nous</a>
                        </li>

                        <?php if (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 0) : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dashboard
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="?route=agence">Agences</a></li>
                                    <li><a class="dropdown-item" href="?route=vehicule">Véhicules</a></li>
                                    <li><a class="dropdown-item" href="?route=membre">Membres</a></li>
                                    <li><a class="dropdown-item" href="?route=commande">Commandes</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- si session affiché, si pas session pas affiché -->
    <?php
    if (isset($_SESSION['membre'])) {
        echo "<p class='text-center mb-0'>Hello " . $_SESSION['membre']['prenom'] . " !</p>";
    }
    ?>

    <?php require_once './view/inscription.php'; ?>
    <!-- FROM MODAL SIGN-UP -->
    <?php require_once './view/connexion.php'; ?>
    <!-- FROM MODAL SIGN -->

    <main>

        <?= $content; ?>

    </main>
    <footer class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
        <h2 class="fs-5">Véville Location</h2>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link link-light" href="#">Conditions générales de vente</a></li>
                <li class="nav-item"><a class="nav-link link-light" href="#">Mentions légales</a></li>
            </ul>
        </nav>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>