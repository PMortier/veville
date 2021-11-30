<section class="p-3 bg-dark text-white">
    <h2>Dashboard | <?= $title; ?></h2>
</section>
<section class="container">
    <h3 class="p-3 mb-2">Liste des agences</h3>
    <table class="table align-middle table-bordered">
        <thead>
            <tr>
                <th class="text-center table-dark border-white">Agence</th>
                <th class="text-center table-dark border-white">Titre</th>
                <th class="text-center table-dark border-white">Adresse</th>
                <th class="text-center table-dark border-white">Ville</th>
                <th class="text-center table-dark border-white">CP</th>
                <th class="text-center table-dark border-white">Description</th>
                <th class="text-center table-dark border-white">Photo</th>
                <th class="text-center table-dark border-white">Actions</th>
            </tr>
        </thead>
        <tboby>
            <?php foreach ($allAgence as $value) : ?>
                <tr>
                    <td class="text-center"><?= $value['id_agence'] ?></td>
                    <td class="text-center"><?= $value['titre'] ?></td>
                    <td class="text-center"><?= $value['adresse'] ?></td>
                    <td class="text-center"><?= $value['ville'] ?></td>
                    <td class="text-center"><?= $value['cp'] ?></td>
                    <td class="text-center"><?= $value['description'] ?></td>
                    <td class="text-center"><img src="<?= $value['photo'] ?>" width="150" height="100" /></td>
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
        </tboby>
    </table>
</section>
<section class="container">
    <h4 class="p-3 mb-2">Créer une nouvelle agence</h4>
    <form method="post" action="" class="row p-3">
        <div class="col">
            <p>
                <label for="titre" class="form-label">Titre</label><br />
                <input type="text" name="titre" id="titre" placeholder="Titre de l'agence" maxlenght="200" required class="form-control" />
            </p>
            <p>
                <label for="description" class="form-label">Description</label><br />
                <textarea name="description" id="description" cols="50" rows="4" placeholder="Description de votre agence" maxlength="250" required class="form-control"></textarea>
            </p>
            <p>
                <label for="photo" class="form-label">Photo</label>
                <input type="text" name="photo" id="photo" placeholder="Inscrire l'url de l'image" required class="form-control" />
            </p>
        </div>
        <div class="col">
            <p>
                <label for="adresse" class="form-label">Adresse</label><br />
                <input type="text" name="adresse" id="adresse" placeholder="Adresse" maxlenght="50" required class="form-control" />
            </p>
            <p>
                <label for="ville" class="form-label">Ville</label><br />
                <input type="text" name="ville" id="ville" placeholder="Ville" maxlenght="50" required class="form-control" />
            </p>
            <p>
                <label for="cp" class="form-label">Code postal</label><br />
                <input type="text" name="cp" id="cp" placeholder="Code postal" maxlenght="5" required class="form-control" />
            </p>
        </div>
        <div class="text-center p-3 mb-2">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</section>