<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/main.css">
  <title>Antique Restaurant</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">Antique</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/galerie">Galerie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/carte">La carte</a>
            </li>

            <!-- Affichage conditionnel de l'onglet en fonction du rôle -->
            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['role'])): ?>
              <!-- Si l'utilisateur est un admin -->
              <?php if ($_SESSION['role'] === 'admin'): ?>
                <li class="nav-item">
                  <a class="nav-link" href="/admin/reservations">Réservations clients</a>
                </li>
              <?php elseif ($_SESSION['role'] === 'user'): ?>
                <!-- Si l'utilisateur est un client normal -->
                <li class="nav-item">
                  <a class="nav-link" href="/allresa">Les réservations</a>
                </li>
              <?php endif; ?>
            <?php else: ?>
              <!-- Si personne n'est connecté -->
              <li class="nav-item">
                <a class="nav-link" href="/allresa">Les réservations</a>
              </li>
            <?php endif; ?>

            <li class="nav-item">
              <a class="nav-link" href="/account">Mon compte</a>
            </li>
            <!-- Affichage conditionnel en fonction de la connexion -->
            <?php if (isset($_SESSION['user_id'])): ?>
              <li class="nav-item">
                <form action="/account/logout" method="POST">
                  <!-- Ajoutez le jeton CSRF ici -->
                  <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                  <button class="nav-link btn btn-link" type="submit" id="signout-btn">Déconnexion</button>
                </form>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link" href="/signin">Connexion</a>
              </li>
            <?php endif; ?>

          </ul>
        </div>
      </div>
    </nav>
  </header>


  <main>
    <?= $contenu ?>
  </main>

  <footer>
    <footer class="bg-dark text-white text-center footer">
      <div class="row">
        <div class="col-12 col-lg-4">
          <h3 class="text-secondary">Nos horaires</h3>
          <p>Du mardi au dimanche 12:00-14:30 18:30-23:00</p>
        </div>
        <div class="col-6 col-lg-4">
          <p>Restaurant Antique <br />
            6 rue du restaurant <br />
            73000 Chambery <br />
            01 02 03 04 05 <br />
          </p>
        </div>
        <div class="col-6 col-lg-4">
          <p>contact@antique.com</p>
        </div>
      </div>
    </footer>
  </footer>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>