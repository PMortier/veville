<section class="p-3 bg-dark text-white">
    <h2>Dashboard | <?= $title; ?></h2>
</section>
<section class="container">
    <h3 class="p-3 mb-2">Liste des membres</h3>
    <table class="table align-middle table-bordered">
        <thead>
            <!-- 
            <tr>
            php
                $nomDeColonne=array('ID Membre','Pseudo',etc.);
                foreach($nomDeColonne as $nom) {
                    echo '<th class>'.$nom.'</th>';
                }
            fin php
            </tr>
            -->
            <tr>
                <th class="text-center table-dark border-white">ID Membre</th>
                <th class="text-center table-dark border-white">Pseudo</th>
                <th class="text-center table-dark border-white">Nom</th>
                <th class="text-center table-dark border-white">Prenom</th>
                <th class="text-center table-dark border-white">Email</th>
                <th class="text-center table-dark border-white">Civilité</th>
                <th class="text-center table-dark border-white">Statut</th>
                <th class="text-center table-dark border-white">Date d'enregistrement</th>
                <th class="text-center table-dark border-white">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allMembre as $value) : ?>
                <tr>
                    <td class="text-center"><?= $value['id_membre'] ?></td>
                    <td class="text-center"><?= $value['pseudo'] ?></td>
                    <td class="text-center"><?= $value['nom'] ?></td>
                    <td class="text-center"><?= $value['prenom'] ?></td>
                    <td class="text-center"><?= $value['email'] ?></td>
                    <td class="text-center"><?= $value['civilite'] ?></td>
                    <td class="text-center"><?= $value['statut'] ?></td>
                    <td class="text-center"><?= $value['date_enregistrement'] ?></td>
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
    <h4 class="p-3 mb-2">Créer un nouveau membre</h4>
    <form method="post" action="" class="row p-3">
        <div class="col">
            <p>
                <label for="pseudo" class="">Pseudo</label><br />
            <div class="input-group">
                <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    </svg></div>
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" maxlenght="20" required class="form-control" />
            </div>
            </p>
            <p>
                <label for="mdp" class="">Mot de passe</label><br />
            <div class="input-group">
                <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                        <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg></div>
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" maxlenght="60" required class="form-control" />
            </div>
            </p>
            <p>
                <label for="nom" class="">Nom</label><br />
            <div class="input-group">
                <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                    </svg></div>
                <input type="text" name="nom" id="nom" placeholder="Votre nom" maxlenght="20" required class="form-control" />
            </div>
            </p>
            <p>
                <label for="prenom" class="">Prénom</label><br />
            <div class="input-group">
                <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                    </svg></div>
                <input type="text" name="prenom" id="prenom" placeholder="Votre prénom" maxlenght="20" required class="form-control" />
            </div>
            </p>
        </div>
        <div class="col">
            <p>
                <label for="email" class="">Email</label><br />
            <div class="input-group">
                <div class="input-group-text">@</div>
                <input type="email" name="email" id="email" placeholder="Votre email" maxlenght="50" required class="form-control" />
            </div>
            </p>
            <p>
                <label for="civilite" class="mb-3">Civilité</label><br />
                <select name="civilite" id="civilite" class="form-select mb-3">
                    <option value="m">Homme</option>
                    <option value="f">Femme</option>
                </select>
            </p>
            <p>
                <label for="statut" class="mb-3">Statut</label><br />
                <select name="statut" id="statut" class="form-select mb-3">
                    <option value="1">Membre</option>
                    <option value="0">Admin</option>
                </select>
                <!-- Statut / select (admin / membre) -->
            </p>
        </div>
        <div class="text-center p-3 mb-2">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</section>