<div class="restaurant text-center text-white">
    <div class="restaurant-content">
        <h1>Connexion</h1>
    </div>
</div>
<div class="container">
    <form action="/signin/login" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <!-- Ajout du token CSRF dans le formulaire -->
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>
        <?php if (isset($error)) : ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
    </form>
    <div class="text-center pt-3">
        <a href="/signup">Vous n’avez pas de compte ? Inscrivez-vous!</a>
    </div>