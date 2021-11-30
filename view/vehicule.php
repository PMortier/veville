<section class="p-3 bg-dark text-white">
    <h2>Dashboard | <?= $title; ?></h2>
</section>
<section>
    <form method="post" action="">
        <div class="row">
            <div class="col-3 my-3 ms-3 me-0">
                <select name="id_agence" id="agences" required class="form-select">
                    <option selected>Choisissez une agence</option>
                    <?php foreach ($allAgence as $value) : ?>
                    <option value=" <?= $value['id_agence'] ?>">Agence de <?= $value['ville'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-1 mt-3">
                <input type="hidden" name="agence-filter">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </div>
    </form>
</section>
<section class="container">
    <h3 class="p-3 mb-2">Liste des véhicules</h3>
    <table class="table align-middle table-bordered">
        <thead>
            <tr>
                <th class="text-center table-dark border-white">Véhicule</th>
                <th class="text-center table-dark border-white">Agence</th>
                <th class="text-center table-dark border-white">Titre</th>
                <th class="text-center table-dark border-white">Marque</th>
                <th class="text-center table-dark border-white">Modèle</th>
                <th class="text-center table-dark border-white">Description</th>
                <th class="text-center table-dark border-white">Photo</th>
                <th class="text-center table-dark border-white">Prix</th>
                <th class="text-center table-dark border-white">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allVehicule as $value) : ?>
                <tr>
                    <td class="text-center"><?= $value['id_vehicule'] ?></td>
                    <td class="text-center"><?= $value['ville'] ?></td>
                    <td class="text-center"><?= $value['titre'] ?></td>
                    <td class="text-center"><?= $value['marque'] ?></td>
                    <td class="text-center"><?= $value['modele'] ?></td>
                    <td class="text-center"><?= $value['description'] ?></td>
                    <td class="text-center"><img src="<?= $value['photo'] ?>" width="200" /></td>
                    <td class="text-center"><?= $value['prix_journalier'] ?> €</td>
                    <td class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<section class="container">
    <h4 class="p-3 mb-2">Créer un nouveau véhicule</h4>
    <form method="post" action="" class="row p-3">
        <div class="col">
            <label for="agences" class="form-label">Agence</label><br />
            <select name="id_agence" id="agences" class="form-select mb-3">
                <?php foreach ($allAgence as $value) : ?>
                    <option value="<?= $value['id_agence'] ?>"><?= $value['titre'] ?></option>
                <?php endforeach; ?>
            </select>
            <p class="mb-3">
                <label for="titre" class="form-label">Titre</label><br />
                <input type="text" name="titre" id="titre" placeholder="Titre de l'annonce" maxlenght="200" required class="form-control" />
            </p>
            <p class="mb-3">
                <label for="marque" class="form-label">Marque</label><br />
                <input type="text" name="marque" id="marque" placeholder="Marque" maxlenght="50" required class="form-control" />
            </p>
            <p class="mb-3">
                <label for="modele" class="form-label">Modèle</label><br />
                <input type="text" name="modele" id="modele" placeholder="Modèle" maxlenght="50" required class="form-control" />
            </p>
            <p class="mb-3">
                <label for="prix_journalier" class="form-label">Prix</label><br />
                <input type="text" name="prix_journalier" id="prix_journalier" placeholder="Prix journalier" required class="form-control" />
            </p>
        </div>
        <div class="col">
            <p class="mb-3">
                <label for="photo" class="form-label">Photo</label><br />
                <input type="text" name="photo" id="photo" placeholder="Inscrire l'url de l'image" required class="form-control" />
            </p>
            <p class="mb-3">
                <label for="description" class="form-label">Description</label><br />
                <textarea name="description" id="description" cols="30" rows="8" placeholder="Description de votre véhicule" maxlength="250" required class="form-control"></textarea>
            </p>
        </div>
        <div class="text-center p-3 mb-2">
            <input type="hidden" name="post-vehicule">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</section>