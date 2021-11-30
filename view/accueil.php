<section class="bandeau">
    <img src="daniele-buso-unsplash.jpg" alt="image-bmw-série3" class="img-fluid">
    <div class="accueil">
        <h1>Bienvenue à bord</h1>
        <p>Location de voiture 24h/24 et 7j/7</p>
    </div>
    <div class="d-flex justify-content-center formulaire">
        <form method="post" action="">
            <div class="row">
                <div class="col">
                    <label for="agences" class="form-label col-form-label-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                        </svg> Adresse de départ</label>
                    <select name="id_agence" id="agences" required class="form-select-sm form-control-plaintext">
                        <?php $selected = isset($_POST['id_agence']) ? $_POST['id_agence'] : ""  ?>
                        <option>[Choix de la ville]</option>
                        <?php foreach ($allAgence as $value) : ?>
                            <option value="<?= $value['id_agence'] ?>" <?php if ($selected == $value['id_agence']) echo "selected" ?>><?= $value['ville'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <label for="date_heure_depart" class="form-label col-form-label-sm mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                        </svg> Début de location</label>
                    <input type="datetime-local" name="date_heure_depart" id="date_heure_depart" value="<?php echo date('Y-m-j\TH:i') ?>" min="<?php echo date('Y-m-j\TH:i') ?>" class="form-control form-select-sm form-control-plaintext" required />
                </div>
                <div class="col">
                    <label for="date_heure_fin" class="form-label col-form-label-sm mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                        </svg> Fin de location</label>
                    <input type="datetime-local" name="date_heure_fin" id="date_heure_fin" value="<?php echo date('Y-m-j\TH:i') ?>" min="<?php echo date('Y-m-j\TH:i') ?>" class="form-control form-select-sm form-control-plaintext" required />
                </div>
                <div class="col-4">
                    <input type="hidden" name="available-vehicule">
                    <button type="submit" class="btn btn-success my-2">Afficher les véhicules disponibles</button>
                </div>
            </div>
        </form>
    </div>
</section>
<section class="container-fluid">

</section>
<section>
    <div class="d-flex justify-content-around m-3">
        <p><?php echo $countAvailableVehicule ?> résultats</p>
        <form method="post" onchange="submit();">
            <select name="price-filter" id="price-filter" class="form-select-sm form-control-plaintext">
                <?php $selected = isset($_POST['price-filter']) ? $_POST['price-filter'] : ""  ?>
                <option>[Filtrer par prix]</option>
                <option value="ASC" <?php if ($selected == "ASC") echo "selected" ?>>Prix croissant</option>
                <option value="DESC" <?php if ($selected == "DESC") echo "selected" ?>>Prix décroissant</option>
            </select>
        </form>
    </div>
    <table class="container mb-5">
        <tbody>
            <?php foreach ($availableVehicule as $value) : ?>
                <tr>
                    <td class="text-center"><img src="<?= $value['photo'] ?>" width="200" /></td>
                    <td class="p-3"><?= "<h2 class='fs-5'>" . $value['titre'] . "</h2>" . "<p class='fs-6'>" . $value['description'] . "<br/>" . $value['prix_total'] . "€ - Agence de " . $value['ville'] . "<p/>" ?>
                        <a href="?route=reservation&id_vehicule=<?= $value['id_vehicule']; ?>&id_agence=<?= $value['id_agence']; ?>&date_heure_depart=<?= $value['date_heure_depart']; ?>&date_heure_fin=<?= $value['date_heure_fin']; ?>&id_membre=<?= $_SESSION['membre']['id_membre']; ?>&prix_total=<?= $value['prix_total']; ?>" class="btn btn-success mb-1">Réserver et Payer</a>
                        
                        <!-- ATTENTION AU NIVEAU DE MON "GET" ICI J'INJECTE LES DATES DE MA COMMANDE TEST DEJA ENREGISTREE (CF ERREUR DANS MON SELECT dans ma méthode availableVehicule()) ET NON LES DATES ENTREES DANS MON FORMULAIRE : DONC A CORRIGER !!!!! -->

                        <!-- ATTENTION AUSSI AU FORMAT DES DATES : AVEC LE DATETIME-LOCAL QUAND ILS SONT ENVOYE DANS VIA UN GET IL FAUT LES REFORMATER Note : Attention si les données sont envoyées avec la méthode HTTP GET, les deux points (:) devront être échappés pour être intégrés dans les paramètres de l'URL. Avec l'exemple précédent, cela signifie qu'on enverra partydate=2017-06-01T08%3A30. -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>