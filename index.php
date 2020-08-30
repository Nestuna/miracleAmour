<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8" />
        <title>Le Miracle de l'Amour</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="./Pages/Vue/JS/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="./Pages/Vue/CSS/main.css">
        <script src="./Pages/Vue/JS/main.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">
              <!-- Code PHP au chargement de la page: Session, Chargement du Css de la page -->
      <?php
          session_start() ; 
          if (isset($_GET['page'])) {
            echo "<link rel='stylesheet' href='./Pages/Vue/CSS/" . $_GET['page'] . ".css'>";
            echo "<script type='text/javascript' src='./Pages/Vue/JS/" . $_GET['page'] . ".js'></script>";
          }
          
        ?>
      <!--------------------------------------------->
    </head>

    <body>
        <!--- HEADER -------------------------------------------------------->
        <header>
            <div class="banner">
                <h1><a href="index.php">Miracle d'Amour</a></h1>
            </div>
              <nav class="navbar navbar-expand-sm bg-blue navbar-fixed-top">

                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?page=profil">Profils</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?page=recherche">Recherche</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?page=swipe">Swipe!</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?page=chat">Chat</a>
                  </li>
                  <li class="nav-item">
                      <?php 
                        if (empty($_SESSION["id_usr"])) {
                          echo '<a class="nav-link" href="index.php?page=login">Login</a>';
                        }
                        else {
                          echo '<a class="nav-link" href="./Pages/Controller/logout.php">Logout</a>';
                        }
                      ?>
                    
                  </li>
                </ul>
              </nav>
        </header>

        <!--- CONTENU -------------------------------------------------------->
        <section  class="container" id="contenu">
			<?php
				if (isset($_GET['page'])) {
					include("Pages/Vue/" . $_GET['page'] . ".html");
				}
				else {
         		 	if (empty($_SESSION["id_usr"])) {
        				header("Location: index.php?page=inscription");
				  	}
					else {
						header("Location: index.php?page=profil");
					}  
				}
			?>
        
        </section>
    </body>
</html>