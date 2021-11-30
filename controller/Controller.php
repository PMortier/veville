<?php
namespace controller;

ini_set("display_errors", 1);

class Controller
{
    private $dbEntityRepository;

    public function __construct()
    {
        session_start(); // ouvre une session avec un fichier temporaire
        $this->dbEntityRepository = new \model\EntityRepository;
    }

    public function handleRequest() {
        $route = isset($_GET['route']) ? $_GET['route'] : [];
        
        // Vérification s'il y a un $_POST pour le sign_up (attention mettre une balise input type="hidden" avec name="sign_up" dans le formulaire)
        if(isset($_POST['sign_up'])) $this->signUp($_POST);
        if(isset($_POST['sign'])) $this->sign($_POST);
        // ATTENTION : par sécurité, faire la même chose pour tous les post !!!!!
        // --------------------------------------------------------

        try 
        {
            if($route == "vehicule") {
                /* $this->getVehicule(); */
                if(isset($_POST['agence-filter']))
                // idem que plus bas, voir si c'est possible et si pertinent de ne pas initialiser la page avec un argument dans la methode
                {
                    $this->getVehicule($_POST);
                } else 
                {
                    $init = array('id_agence' => "1");
                    $this->getVehicule($init);
                }
                if(isset($_POST['post-vehicule'])) $this->postVehicule($_POST);
                // envoi de $_POST dans la methode postVehicule
            } else if($route == "agence") {
                $this->getAgence();
                if($_POST) $this->postAgence($_POST);
            } else if($route == "membre") {
                $this->getMembre();
                if($_POST) $this->postMembre($_POST);
            } else if($route == "commande") {
                if($_POST) {
                    $this->getCommande($_POST); // Faire le filtre commande 
                } else {
                    $init = array('id_agence'=>"1");
                    $this->getCommande($init);
                }
                    
            } else if($route == 'index' or $route == []) {
                if(isset($_POST['available-vehicule'])) // voir si c'est possible de faire l'inverse : d'abord déclarer !isset($_POST) en envoyant getAccueil sans le $_POST et si isset($_POST) envoyer la fonction getAccueil($_POST) avec le $_POST
                // Cela me permettrait de ne pas devoir réinitialiser avec un $init
                {
                    $this-> getAccueil($_POST);
                 } else {
                    $init = array('id_agence'=>'0','date_heure_depart'=>date('Y-m-j\TH:i'),'date_heure_fin'=>date('Y-m-j\TH:i'));
                    $this-> getAccueil($init);
                }

            } else if ($route == 'logout') {
                $this->logout();
            } else if ($route == 'reservation') {
                $id_vehicule = $_GET['id_vehicule'];
                $id_membre = $_GET['id_membre'];
                $id_agence = $_GET['id_agence'];
                $date_heure_depart = $_GET['date_heure_depart'];
                $date_heure_fin = $_GET['date_heure_fin'];
                $prix_total = $_GET['prix_total'];
                $this->reservation($id_vehicule, $id_membre, $id_agence, $date_heure_depart, $date_heure_fin, $prix_total);
            }
        } 
        catch (\Exception $e) 
        {
            echo "Application error" . $e->getMessage();
        }
    }

    // INSCRIPTION / CONNEXION / DECONNEXION

    public function signUp($values) 
    {
        $this->dbEntityRepository->signUp($values);
    }

    public function sign($values)
    {
        $this->dbEntityRepository->sign($values);
    }

    public function logout() 
    {
        session_destroy();
        header('Location: http://localhost:8888/veville-back/');
    }

    // --------------------------


    public function getVehicule($values)
    {
        // affichage de la page véhicule avec tableau généré
        $this->render('layout.php', 'vehicule.php', [
            'title' => "Gestion des véhicules",
            'allVehicule' => $this->dbEntityRepository->getFilterVehicule($values),
            'allAgence' => $this->dbEntityRepository->getAllAgence() // Pour select Agence dans formulaire !
        ]);
    }

    public function postVehicule($values)
    {
        $this->dbEntityRepository->postVehicule($values);
    }

    public function getAgence()
    {
        // affichage de la page agence avec tableau généré
        $this->render('layout.php', 'agence.php', [
            'title' => "Gestion des agences",
            'allAgence' => $this->dbEntityRepository->getAllAgence()
        ]);
    }

    public function postAgence($values) 
    {
        $this->dbEntityRepository->postAgence($values);
    }
 
   public function getMembre()
    {
        // affichage de la page membre avec tableau généré
        $this->render('layout.php','membre.php',[
            'title' => "Gestion des membres",
            'allMembre' => $this->dbEntityRepository->getAllMembre()
        ]);
    }

    public function postMembre($values)
    {
        $this->dbEntityRepository->postMembre($values);
    }

    public function getCommande($values)
    {
        $this->render('layout.php', 'commande.php', [
            'title' => "Gestion des commandes",
            'filterCommande' => $this->dbEntityRepository->getFilterCommande($values),
            'allAgence' => $this->dbEntityRepository->getAllAgence()
        ]);
    }

    public function getAccueil($values)
    {
        $this->render('layout.php', 'accueil.php', [
            'allAgence' => $this->dbEntityRepository->getAllAgence(),
            /* 'allVehicule' => $this->dbEntityRepository->getAllVehicule(), */
            /* 'countAllVehicule' => $this->dbEntityRepository->countAllVehicule(), */
            'availableVehicule' => $this->dbEntityRepository->getAvailableVehicule($values),
            'countAvailableVehicule' => $this->dbEntityRepository->count
        ]);
    }


    public function reservation($id_vehicule, $id_membre, $id_agence, $date_heure_depart, $date_heure_fin, $prix_total)
    {
        $this->render('layout.php', 'reservation.php', [
            'reservation' => $this->dbEntityRepository->reservation($id_vehicule, $id_membre, $id_agence, $date_heure_depart, $date_heure_fin, $prix_total),
            'viewReservation' => $this->dbEntityRepository->viewReservation($id_vehicule, $id_membre, $id_agence, $date_heure_depart, $date_heure_fin, $prix_total)
        ]);
        
    }




    public function render($layout,$template,$parameters=[]){
        // permettent d'extraire chaque indice d un array sous forme de variable
        extract($parameters); // $parameters['employes] --> $employes (title , data)

        ob_start();
        // mise en tampon, on commence a garder en mémoire des données.

        // require_once " view/vehicule.php
        require_once "view/$template";
        // cette inclusion est stockée directement dans la variable $content

        // $content = le fichier vehicule.php
        $content = ob_get_clean();
        // on stock la mise en mémoire, c'est à dire que l'on stock dans la variable 
        // $content, le template lui-même, c'est à dire le résultat du require

        ob_start(); // temporise la sortie d'affichage

        // require_once "view/layout.php
        require_once "view/$layout";

        // on inclue le layout qui est le gabarit de base (header/nav/footer )
        return ob_end_flush();
      //  libère l'affichage et fait tout apparaitre sur le navigateur / Envoi les données de la mise en mémoire, mise en tampon de sortie.
    }

}


