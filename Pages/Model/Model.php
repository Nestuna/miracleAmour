<?php

class Model{

	private $pdo_driver = 'mysql';         
	private $pdo_host = 'remotemysql.com';			 
	private $pdo_dbname = 't84EM39Jzz';    
	private $pdo_login = 't84EM39Jzz';           
	private $pdo_password = 'qYcZYWZUPb';       
	private $bd;

	private static $instance = null;

	private function __construct(){
		try{
			$dsn = $this->pdo_driver.':'.'host='.$this->pdo_host.';dbname='.$this->pdo_dbname;
			$this->bd = new PDO($dsn, $this->pdo_login, $this->pdo_password);
			$this->bd->query('SET NAMES utf8');
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
			die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
		}
	}

	public static function getModel(){
		if (is_null(self::$instance))
			self::$instance = new Model();
		return self::$instance;
	}
	

	public function get_all_usr(){
		try {
			$req = "SELECT * FROM identifiant" ;
			$requete = $this->bd->prepare($req);
			$requete -> execute() ;
			$tab = $requete->fetchAll(PDO::FETCH_NUM) ;
			return $tab;
		  }
		  catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			  }
	}


	public function inscription_identifiant($password , $email){
		try {
			$req = "INSERT INTO identifiant (password,email) VALUES (:p,:e)" ;
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":e" , $email ) ;
			$requete->bindValue( ":p" , $password ) ;
			$requete -> execute() ;
			$id_usr = $this->bd->lastInsertId();
			return $id_usr ; 
		  }
		  catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			  }
	}

	public function inscription_profile_indiv($id_usr , $sexe , $date , $ville , $nom , $prenom){
		try {
			
			//cette requete est static peut etre la rendre dynamique !? 
			$req = "INSERT INTO profile_indiv (id_usr , sexe , date_naissance , ville , nom , prenom) VALUES (:id,:s,:d,:v,:n,:p)" ;
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id" , $id_usr ) ;
			$requete->bindValue( ":s" , $sexe ) ;
			$requete->bindValue( ":d" , $date ) ;
			$requete->bindValue( ":v" , $ville ) ;
			$requete->bindValue( ":n" , $nom) ;
			$requete->bindValue( ":p" , $prenom) ;
			$requete -> execute() ;
			return true ; //ce return peut être changé selon nos besoins 
		  }
		catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			  }
	}
	
	public function login($email,$pwd){
		try {
			$req = "SELECT id_usr FROM identifiant WHERE email=:email AND password=:pwd  "  ;
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":email" , $email ) ;
			$requete->bindValue( ":pwd" , $pwd ) ;
			$requete -> execute() ;
			$tab = $requete->fetch(PDO::FETCH_ASSOC) ;
			return $tab["id_usr"] ; 

			
		}
		catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
		}
	}

	public function usr_pref($id_usr){
		try {


			$req = "SELECT id_musique,id_litterature,id_sport,id_cinema FROM identifiant_musique 
					JOIN identifiant_litterature 
					ON identifiant_musique.id_usr = identifiant_litterature.id_usr 
					JOIN identifiant_sport 
					ON identifiant_litterature.id_usr = identifiant_sport.id_usr 
					JOIN identifiant_cinema
					ON identifiant_cinema.id_usr = identifiant_sport.id_usr 
					WHERE identifiant_cinema.id_usr=:id " ; 
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id" , $id_usr ) ;
			$requete -> execute() ;
			$tab = $requete->fetchAll(PDO::FETCH_ASSOC) ;
			return $tab ; 

			
		}
		catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
		}
	}

	public function usr_recherche($id_cine , $id_litterature,$id_musique,$id_sport,$sexe){
		try {
			$req = "SELECT DISTINCT id_usr FROM identifiant_cinema WHERE id_cinema = :id_cine
						AND id_usr IN (SELECT id_usr FROM identifiant_litterature WHERE id_litterature = :id_litterature)
						AND id_usr IN (SELECT id_usr FROM identifiant_sport WHERE id_sport = :id_sport)
						AND id_usr IN (SELECT id_usr FROM identifiant_musique WHERE id_musique = :id_musique)
						AND id_usr IN (SELECT id_usr FROM profile_indiv WHERE sexe = :sexe )";
			
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id_cine" , $id_cine ) ;
			$requete->bindValue( ":id_litterature" , $id_litterature ) ;
			$requete->bindValue( ":id_musique" , $id_musique ) ;
			$requete->bindValue( ":id_sport" , $id_sport ) ;
			$requete->bindValue( ":sexe" , $sexe) ;
			$requete -> execute() ;
			$tab = $requete->fetchAll(PDO::FETCH_NUM) ;
			return $tab ; 

			
		}
		catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
		}
	}
	
	public function usr_match($id_usr){
		try {
			$tab_pref_usr = $this->usr_pref($id_usr) ; 
			$i = 0 ; 
			$tab_recap = [] ; 
			$req = "SELECT count(*) FROM identifiant" ;
			$requete = $this->bd->prepare($req); 
			$requete -> execute() ;
			$tab = $requete->fetch(PDO::FETCH_NUM) ;
			while($i<$tab[0]){
				$tmp_tab = $this->usr_pref($i) ; 
				$compteur = 0 ;
				if(!empty($tmp_tab) && $i!=$id_usr){
					foreach($tmp_tab as $key => $value){
						if($tab_pref_usr[$key]==$value){
							$compteur = $compteur + 1 ; 
						
						}
					}
					if($compteur>0){
						$tab_recap[$i] = $compteur ; 
					}
				} 
				$i = $i+1 ; 
			}
			arsort($tab_recap) ;
			return $tab_recap ;	
		}
		
	
		catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
		}
	
	}


	public function getSex($id_usr){
		try {
			$req = "SELECT sexe FROM profile_indiv WHERE id_usr=:id" ;
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id" , $id_usr ) ;
			$requete -> execute() ;
			$tab = $requete->fetch(PDO::FETCH_NUM) ;
			return $tab[0];
		  }
		  catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			  }
	}

	public function insertMatch($id_usr1,$id_usr2){
		try {
			$req = "INSERT INTO `relation` (`id_usr1`, `id_usr2`, `match_verif`, `match_global`) VALUES (:id_usr1, :id_usr2,1,NULL)" ; 
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id_usr1" , $id_usr1 ) ;
			$requete->bindValue( ":id_usr2" , $id_usr2) ;
			$requete -> execute() ;
  
		  }
		catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			  }
	
	}

	public function updateMatch($id_usr1,$id_usr2){
		try {
			$req = "UPDATE relation SET match_global=1 WHERE id_usr1=:id_usr1 AND id_usr2=:id_usr2"; 
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id_usr1" , $id_usr1 ) ;
			$requete->bindValue( ":id_usr2" , $id_usr2) ;
			$requete -> execute() ;
			return ;
		  }
		catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			  }
	
	}

	public function getOrientation($id_usr){
		try {
			$req = "SELECT orientation_sexe FROM profile_indiv WHERE id_usr=:id" ;
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id" , $id_usr ) ;
			$requete -> execute() ;
			$tab = $requete->fetch(PDO::FETCH_NUM) ;
			return $tab[0];
		  }
		  catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			  }
	}

	


	public function match($id_usr1,$id_usr2){
		try {
			$req = "SELECT `match_verif` FROM relation WHERE id_usr1=:id1 AND id_usr2=:id2" ;
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id1" , $id_usr1 ) ;
			$requete->bindValue( ":id2" , $id_usr2 ) ;
			$requete -> execute() ;
			$tab = $requete->fetch(PDO::FETCH_ASSOC) ;
			var_dump($tab["match_verif"]) ; 
			if(empty($tab['match_verif'])){
				 
				$this->insertMatch($id_usr2,$id_usr1) ; 
			}
			else{
				 
				$this->updateMatch($id_usr1,$id_usr2) ; 
			}
			
		  }
		  catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			  }
	}

	public function recupMatch($id_usr){
		try {
			$req = "SELECT `id_usr2` FROM relation WHERE id_usr1=:id1" ;
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id1" , $id_usr ) ;
			$requete -> execute() ;
			$tab[0] = $requete->fetchAll(PDO::FETCH_NUM) ;

			$req = "SELECT `id_usr1` FROM relation WHERE id_usr2=:id1" ;
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id1" , $id_usr ) ;
			$requete -> execute() ;
			$tab[1] = $requete->fetchAll(PDO::FETCH_NUM) ;

			return $tab ; 
			
		  }
		  catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			  }
	}

	public function getLastMessage($id_usr1,$id_usr2){
		try {
			$req = "SELECT id_message , `date` ,`message` , id_envoyeur FROM chat WHERE id_envoyeur=:id1 AND id_receveur=:id2 ORDER BY `date` DESC" ;
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id1" , $id_usr1 ) ;
			$requete->bindValue( ":id2" , $id_usr2 ) ;
			$requete -> execute() ;
			$tab = $requete->fetch(PDO::FETCH_ASSOC) ;
			
			 

			$req = "SELECT id_message , `date` ,`message` , id_envoyeur FROM chat WHERE id_envoyeur=:id2 AND id_receveur=:id1 ORDER BY `date` DESC" ;
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":id1" , $id_usr1 ) ;
			$requete->bindValue( ":id2" , $id_usr2 ) ;
			$requete -> execute() ;
			$tab2 = $requete->fetch(PDO::FETCH_ASSOC) ; 

			
			$date1 = new DateTime($tab['date']) ; 
			$date2 = new DateTime($tab2['date']) ; 


			if($date1<$date2){
				return $tab2 ; 
			}
			else{
				return $tab ; 
			}

			
			
		  }
		  catch(PDOException $e) {
				  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			  }
	}



	//Méthode pour insérer dans la table chat
	public function insert_chat($id_usr, $id_receveur, $message){
		try {
			date_default_timezone_set('Europe/Paris');
			$req = "INSERT INTO chat (id_envoyeur, id_receveur, `message`, `date` ) VALUES (:envoyeur, :receveur, :message1, :date1)" ; // le id_message s'auto-incrémente
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":envoyeur" , $id_usr ) ;
			$requete->bindValue( ":receveur" , $id_receveur) ;
			$requete->bindValue( ":message1" , $message ) ;
			$requete->bindValue( ":date1" , date('y-m-d H:i:s')) ;
			$requete -> execute() ;
			return  ; 
			}
		catch(PDOException $e) {
					die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
				}
	}
	
	
	//Méthode pour récupérer l'id_usr du destinataire (pas hyper sécure si on a des utilisateurs qui ont le même prénom et nom).
	public function getId_receveur ($nom, $prenom){
			try {
			$req = "SELECT id_usr FROM profile_ind WHERE nom=:nom AND prenom = :prenom"  ;
			$requete = $this->bd->prepare($req);
			$requete->bindValue( ":nom" , $nom ) ;
			$requete->bindValue( ":prenom" , $prenom ) ;
			$requete -> execute() ;
			$tab = $requete->fetch(PDO::FETCH_NUM) ;
			return $tab[0] ; 	
		}
		catch(PDOException $e) {
					die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
		}
	}
		
		
		//Méthode pour retourner les 10 derniers messages du chat entre les deux participants
		public function getMessages($user, $receveur, $nb_messages){
				try {
				$req = "SELECT `message` , `date` , id_envoyeur , id_message FROM chat WHERE id_envoyeur=:utilisateur 
						AND id_receveur = :destinataire 
						OR 	(id_envoyeur=:utilisateur1 
						AND id_receveur = :destinataire1) 
						ORDER BY `date` "  ;

				$requete = $this->bd->prepare($req);
				$requete->bindValue( ":utilisateur" , $user ) ;
				$requete->bindValue( ":destinataire" , $receveur ) ;
				$requete->bindValue( ":utilisateur1" , $receveur ) ;
				$requete->bindValue( ":destinataire1" , $user ) ;
				/*$requete->bindValue( ":nb_messages" , $nb_messages, PDO::PARAM_INT ) ;*/
				$requete -> execute() ;
				$tab = $requete->fetchAll(PDO::FETCH_ASSOC) ;
				return $tab ; 	
			}
			catch(PDOException $e) {
					  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			}
		}

		

		//On récupère toutes les infos du profil:
		public function get_profil($id_usr){
			try {
				$req = "SELECT * FROM profile_indiv WHERE id_usr=:usr" ;
				$requete = $this->bd->prepare($req);
				$requete->bindValue( ":usr" , $id_usr ) ;
				$requete -> execute() ;
				$tab = $requete->fetchAll(PDO::FETCH_ASSOC) ;
				return $tab;
			  }
			  catch(PDOException $e) {
					  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
				  }
		}
	
		public function get_photo($id_usr){
			try {
				$req = "SELECT url_photo FROM photo WHERE id_usr= :usr" ;
				$requete = $this->bd->prepare($req);
				$requete->bindValue( ":usr" , $id_usr ) ;
				$requete -> execute() ;
				$tab = $requete->fetch(PDO::FETCH_NUM) ;
				return $tab[0];
			  }
			  catch(PDOException $e) {
					  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
				  }
		}

		//Méthodes pour récupérer la préférences en fonction de l'id_pref:
		public function get_prefCinema($id_pref){
			try {
				$req = "SELECT nom_genre FROM cinema WHERE id_cinema= :cinema" ;
				$requete = $this->bd->prepare($req);
				$requete->bindValue( ":cinema" , $id_pref ) ;
				$requete -> execute() ;
				$tab = $requete->fetch(PDO::FETCH_ASSOC) ;
				return $tab;
			  }
			  catch(PDOException $e) {
					  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
				  }
		}

		public function get_prefLitterature($id_pref){
			try {
				$req = "SELECT nom_litterature FROM litterature WHERE id_litterature= :litterature" ;
				$requete = $this->bd->prepare($req);
				$requete->bindValue( ":litterature" , $id_pref ) ;
				$requete -> execute() ;
				$tab = $requete->fetch(PDO::FETCH_ASSOC) ;
				return $tab;
			  }
			  catch(PDOException $e) {
					  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
				  }
		}

		public function get_prefMusique($id_pref){
			try {
				$req = "SELECT nom_musique FROM musique WHERE id_musique= :musique" ;
				$requete = $this->bd->prepare($req);
				$requete->bindValue( ":musique" , $id_pref ) ;
				$requete -> execute() ;
				$tab = $requete->fetch(PDO::FETCH_ASSOC) ;
				return $tab;
			  }
			  catch(PDOException $e) {
					  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
				  }
		}

		public function get_prefSport($id_pref){
			try {
				$req = "SELECT nom_sport FROM sport WHERE id_sport= :sport" ;
				$requete = $this->bd->prepare($req);
				$requete->bindValue( ":sport" , $id_pref ) ;
				$requete -> execute() ;
				$tab = $requete->fetch(PDO::FETCH_ASSOC) ;
				return $tab;
			  }
			  catch(PDOException $e) {
					  die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
				  }
		}


}



?>