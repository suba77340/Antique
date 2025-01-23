<div class="restaurant text-center text-white">
    <div class="restaurant-content">
        <h1>Inscription</h1>
    </div>
</div>
<div class="container">
<form action="/signup/register" method="POST">
    <div class="mb-3">
        <label for="username" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="first_name" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="first_name" name="first_name" required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="password_confirm" class="form-label">Confirmer le mot de passe</label>
        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
    </div>

    <!-- Ajout du CSRF Token -->
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>

    </form>

    <div class="text-center pt-3">
        <a href="/signin">Déjà un compte ? Connectez-vous</a>
    </div>