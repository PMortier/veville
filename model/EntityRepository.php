<?php
namespace model;

ini_set("display_errors",1);

class EntityRepository
{
    private $db;

    public function getDb()
    {
        if(!$this->db)
        {
            try 
            {
                $xml = simplexml_load_file('app/config.xml');
                try
                {
                    $this->db = new \PDO("mysql:host=" . $xml->host . ";dbname=" . $xml->db, $xml->user, $xml->password,array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING, \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                } 
                catch (\Exception $e) 
                {
                    echo "problème de connexion avec la BDD : " . $e->getMessage();
                }
            } 
            catch (\Exception $e)
            {
                echo "probleme fichier config xml manquant : " . $e->getMessage();
            }
        }
        return $this->db;
    }

    /* public function getAllVehicule() 
    {
        $req = $this->getDb()->query('SELECT v.id_vehicule, a.ville, v.titre, v.marque, v.modele, v.description, v.photo, v.prix_journalier FROM vehicule v, agences a WHERE v.id_agence = a.id_agence');
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    } */

    /* public function countAllVehicule()
    {
        $req = $this->getDb()->query('SELECT COUNT(*) AS nb_vehicule FROM vehicule');
        $result = $req->fetch(\PDO::FETCH_ASSOC);
        return $result['nb_vehicule'];
    } */

    public function getFilterVehicule($values)
    {
        $req = $this->getDb()->query("SELECT v.id_vehicule, a.ville, v.titre, v.marque, v.modele, v.description, v.photo, v.prix_journalier FROM vehicule v, agences a WHERE v.id_agence = a.id_agence AND a.id_agence = '$values[id_agence]'");
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public $count;

    public function getAvailableVehicule($values)  // ATTENTION : PB AU NIVEAU DE MON SELECT (cf. dates commande)
    {
        // var_dump($values); // je récupère un tableau avec id_agence / date_heure_depart / date_heure_fin
        // Je reçois les dates au format 2021-07-22T23:15
        // Pour les comparer, elles doivent être au bon format AAAA-MM-JJ HH:MM

        $date_heure_depart = date_create($values['date_heure_depart']);
        $date_heure_fin = date_create($values['date_heure_fin']);
        $interval = date_diff($date_heure_depart, $date_heure_fin);
        /* echo "< pre >"; echo print_r($interval); echo "< pre >"; */
        $nb_jour_location = $interval->days;
        /* var_dump($nb_jour_location); */


        $req = $this->getDb()->query(
           "SELECT v.id_vehicule, v.id_agence, a.ville, v.titre, v.marque, v.modele, v.description, v.photo, /* v.prix_journalier, */ (v.prix_journalier * $nb_jour_location) AS prix_total/*, c.date_heure_depart, c.date_heure_fin */  
           FROM vehicule v, agences a, commande c 
           WHERE a.id_agence = '$values[id_agence]'
           AND v.id_agence = a.id_agence"
           );

        $this->count = $req->rowCount();

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        /* var_dump($result); */
        /* Il ne me renvoit pas les bonnes dates. Un problème au niveau de mon SELECT car je récupère les dates de la commande test déjà enregistrée et je les renvoie dans mon GET qui sert en finaliser la réservation !!!!! */
        // ATTENTION AUSSI CAR JE DOIS GERER MON FORMAT DE DATE A CAUSE DE MON DATETIME-local (car DATETIME pas pris en charge sur mon navigateur)
        return $result;
        
    }


    public function postVehicule($values) 
    {
        $req = $this->getDb()->prepare("INSERT INTO vehicule (id_agence,titre,marque,modele,description,photo,prix_journalier) VALUES (:id_agence,:titre,:marque,:modele,:description,:photo,:prix_journalier)");
        $req->bindParam(':id_agence', $values['id_agence'], \PDO::PARAM_INT);
        $req->bindParam(':titre', $values['titre'], \PDO::PARAM_STR);
        $req->bindParam(':marque', $values['marque'], \PDO::PARAM_STR);
        $req->bindParam(':modele', $values['modele'], \PDO::PARAM_STR);
        $req->bindParam(':description', $values['description'], \PDO::PARAM_STR);
        $req->bindParam(':photo', $values['photo'], \PDO::PARAM_STR);
        $req->bindParam(':prix_journalier', $values['prix_journalier'], \PDO::PARAM_INT);
        $req->execute(); 
    }

    public function deleteVehicule()
    {
        // supprimer un véhicule à partir du bouton Delete (methode $_GET)
    }

    public function editVehicule()
    {
        // sur une page dédiée (via methode $_GET) :
        // editer un formulaire contenant en placeholder les données concernant le véhicule à modifier
        // puis renvoyer la methode postVehicule
    }


    public function getAllAgence()
    {
        $req = $this->getDb()->query('SELECT * FROM agences');
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function postAgence($values) 
    {
        $req = $this->getDb()->prepare("INSERT INTO agences (titre,description,photo,adresse,ville,cp) VALUES (:titre,:description,:photo,:adresse,:ville,:cp)");
        $req->bindParam(':titre',$values['titre'],\PDO::PARAM_STR);
        $req->bindParam(':description',$values['description'],\PDO::PARAM_STR);
        $req->bindParam(':photo',$values['photo'],\PDO::PARAM_STR);
        $req->bindParam(':adresse',$values['adresse'],\PDO::PARAM_STR);
        $req->bindParam(':ville',$values['ville'],\PDO::PARAM_STR);
        $req->bindParam(':cp',$values['cp'],\PDO::PARAM_INT);
        $req->execute();
    }


    public function deleteAgence()
    {
        // supprimer une agence à partir du bouton Delete (methode $_GET)
    }

    public function editAgence()
    {
        // sur une page dédiée (via methode $_GET) :
        // editer un formulaire contenant en placeholder les données concernant l'agence à modifier
        // puis renvoyer la methode postAgence
    }

    public function getAllMembre() 
    {
        $req = $this->getDb()->query(
            "SELECT id_membre,pseudo,nom,prenom,email, 
                (CASE civilite
                    WHEN 'm' THEN 'Homme' 
                    WHEN 'f' THEN 'Femme' 
                    END) AS civilite, 
                (CASE statut 
                    WHEN 0 THEN 'Admin' 
                    WHEN 1 THEN 'Membre' 
                    END) AS statut,
                DATE_FORMAT(date_enregistrement,'%d/%m/%Y %H:%i') AS date_enregistrement
                FROM membre
            ");
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function postMembre($values)
    {
        $req = $this->getDb()->prepare("INSERT INTO membre (pseudo,mdp,nom,prenom,email,civilite,statut,date_enregistrement) VALUES (:pseudo,:mdp,:nom,:prenom,:email,:civilite,:statut,NOW())");
        $req->bindParam(':pseudo', $values['pseudo'], \PDO::PARAM_STR);
        $req->bindParam(':mdp', $values['mdp'], \PDO::PARAM_STR);
        $req->bindParam(':nom', $values['nom'], \PDO::PARAM_STR);
        $req->bindParam(':prenom', $values['prenom'], \PDO::PARAM_STR);
        $req->bindParam(':email', $values['email'], \PDO::PARAM_STR);
        $req->bindParam(':civilite', $values['civilite'], \PDO::PARAM_STR);
        $req->bindParam(':statut', $values['statut'], \PDO::PARAM_INT);   
        $req->execute();
    }

    public function deleteMembre()
    {
        // supprimer un membre à partir du bouton Delete (methode $_GET)
    }

    public function editMembre()
    {
        // sur une page dédiée (via methode $_GET) :
        // editer un formulaire contenant en placeholder les données concernant le membre à modifier
        // puis renvoyer la methode postMembre
    }

    public function getFilterCommande($values)
    {
        $req = $this->getDb()->query("SELECT c.id_commande, m.statut, m.prenom, m.nom, m.email, v.id_vehicule, v.titre, a.id_agence, a.ville, DATE_FORMAT(c.date_heure_depart,'%d/%m/%Y - %Hh%i') AS date_heure_depart, DATE_FORMAT(c.date_heure_fin,'%d/%m/%Y - %Hh%i') AS date_heure_fin, c.prix_total, DATE_FORMAT(c.date_enregistrement,'%d/%m/%Y - %Hh%i') AS date_enregistrement FROM commande c, membre m, vehicule v, agences a WHERE a.id_agence = '$values[id_agence]' AND c.id_membre = m.id_membre AND c.id_vehicule = v.id_vehicule AND c.id_agence = a.id_agence ");
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /* private $id_commande; */ // FAIRE UNE VARIABLE ID_COMMANDE POUR ENSUITE VOIR LA RESERVATION ????

    public function reservation($id_vehicule, $id_membre, $id_agence, $date_heure_depart, $date_heure_fin, $prix_total)
    {
        // faire un insert into dans commande !
        var_dump($id_vehicule, $id_membre, $id_agence, $date_heure_depart, $date_heure_fin, $prix_total);
        $req = $this->getDb()->prepare("INSERT INTO commande (id_membre,id_vehicule,id_agence,date_heure_depart,date_heure_fin, prix_total, date_enregistrement) VALUES ($id_membre,$id_vehicule,$id_agence,$date_heure_depart,$date_heure_fin,$prix_total,NOW())");
        $req->execute();

    }

    public function viewReservation($id_vehicule, $id_membre, $id_agence, $date_heure_depart, $date_heure_fin, $prix_total)
    {
        // afficher les détails de la commande !
        $req = $this->getDb()->query("SELECT c.id_commande, c.date_enregistrement, m.nom, m.prenom, m.email, v.titre, v.description, c.date_heure_depart, c.date_heure_fin, c.prix_total FROM commande c, agences a, vehicule v, membre m WHERE c.id_membre = $id_membre AND c.id_vehicule=$id_vehicule AND c.id_agence=$id_agence AND c.date_heure_depart = $date_heure_depart AND c.date_heure_fin = $date_heure_fin AND c.prix_total = $prix_total");
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;

    }


    public function deleteCommande()
    {
        // supprimer une commande à partir du bouton Delete (methode $_GET)
    }

    public function editCommande()
    {
        // sur une page dédiée (via methode $_GET) :
        // editer un formulaire contenant en placeholder les données concernant la commande à modifier
        // puis renvoyer la methode reservation ? (à vérifier)
    }


    public function signUp($values) //$value = $_POST
    {
        $req = $this->getDb()->query("SELECT * FROM membre WHERE pseudo = '$values[pseudo]' ");
        
        if($req->rowCount() >= 1)
        {
            /* var_dump($req); */
            return false;
        } else 
        {
        //possible de rajouter des conditions au mot de passe ici avant le hashage et l'insertion
        $mdp = password_hash($values['mdp'], PASSWORD_DEFAULT);

        $req = $this->getDb()->prepare("INSERT INTO membre (pseudo,mdp,nom,prenom,email,civilite,statut,date_enregistrement) VALUES (:pseudo,:mdp,:nom,:prenom,:email,:civilite,1,NOW())");
        $req->bindParam(':pseudo', $values['pseudo'], \PDO::PARAM_STR);
        $req->bindParam(':mdp', $mdp, \PDO::PARAM_STR);
        $req->bindParam(':nom', $values['nom'], \PDO::PARAM_STR);
        $req->bindParam(':prenom', $values['prenom'], \PDO::PARAM_STR);
        $req->bindParam(':email', $values['email'], \PDO::PARAM_STR);
        $req->bindParam(':civilite', $values['civilite'], \PDO::PARAM_STR); 
        $req->execute();
        }
    }


    public function sign($values)
    {
        $pseudo= trim($values['pseudo']); // trim supprime les espaces en début et fin de chaîne
        $mdp= trim($values['mdp']);

        // le ? dans la requête SQL est un placeholder qui bloque toutes les injections SQL dans le formulaire
        $req = $this->getDb()->prepare("SELECT * FROM membre WHERE pseudo = ? ");
        $req->execute([$pseudo]);

        $user = $req->fetch(\PDO::FETCH_ASSOC);

        /* 
        le fetch() quand on a besoin que d'une seule colonne

        le FETCH_ASSOC renvoie la valeur d'un tableau sans indexation
        exemple sans FETCH_ASSOC :
        [0] => prenom
        [prenom] => prenom
        [1] => nom
        [nom] => nom
        exemple avec FETCH_ASSOC :
        [prenom] => prenom
        [nom] => nom
        */ 

        // on vérifie si le tableau est comptable 
        // et si il est comptable, si le nombre de ligne est supérieur à 0
        // ce qui signifie qu'un utilisateur a été trouvé
        if(is_countable($user) && count($user) > 0)
        {
            // on vérifie si le mdp saisie correspond à celui en base de données
            if(password_verify($mdp, $user['mdp']))
            {
                foreach ($user as $key => $value) // $value = $user
                {
                    $_SESSION['membre'][$key] = $value; // génère une session membre avec toutes les données de l'utilisateur qui veut se connecter
                }
            } else {
                echo "password ne correspond pas!";
            } 
        } else {
            var_dump($user);
        }
    }

}

?>

