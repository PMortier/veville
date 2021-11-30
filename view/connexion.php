    <!-- MODAL SIGN -->
    <!-- Modal -->
    <div class="modal fade" id="sign" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Se connecter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <input type="text" name="pseudo" placeholder="Votre pseudo" class="form-control mb-3" required>
                        <input type="password" name="mdp" placeholder="Votre mot de passe" class="form-control mb-3" required>
                        <input type="hidden" name="sign"> <!-- pour indiquer que l'on envoi des données avec sign_up pour le if($_POST['sign_up']) dans le controller-->
                        <div class="text-center mb-2">
                            <button type="submit" class="btn btn-primary w-100">Connexion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL SIGN -->