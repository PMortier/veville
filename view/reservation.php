<section class="p-3 bg-success text-white">
    <h2>Merci pour votre réservation <?php if (isset($_SESSION['membre'])) echo $_SESSION['membre']['prenom']; ?> !</h2>
</section>
<section>
    <h3 class="p-3 mb-2">Les détails de votre commande</h3>
</section>
<section>
    <table class="container mb-5">
        <tbody>
            <?php foreach ($viewReservation as $value) : ?>
                <tr>
                    <td>N° de commande</td>
                    <td><?= $value['id_commande'] ?></td>
                </tr>
                <tr>
                    <td>Date de commande</td>
                    <td><?= $value['date_enregistrement'] ?></td>
                </tr>
                <tr>
                    <td>Réalisée par</td>
                    <td><?= $value['prenom'] ?> <?= $value['nom'] ?></br><?= $value['email'] ?></td>
                </tr>
                <tr>
                    <td>Récapitulatif</td>
                    <td><?= $value['titre'] ?></br><?= $value['description'] ?></br>Départ : <?= $value['date_heure_depart'] ?></br>Fin de location : <?= $value['date_heure_fin'] ?></td>
                </tr>
                <tr>
                    <td>Montant total</td>
                    <td><?= $value['prix_total'] ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>