<div class="restaurant text-center text-white">
    <div class="restaurant-content">
        <h1>Mon compte</h1>
    </div>
</div>

<div class="container">
    <form id="profileForm" method="POST" action="/account/update">
        <div class="mb-3">
            <label for="NomInput" class="form-label">Nom</label>
            <input type="text" class="form-control" id="NomInput" placeholder="Votre nom" value="<?= htmlspecialchars($first_name ?? '') ?>" name="first_name">
        </div>
        <div class="mb-3">
            <label for="PrenomInput" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="PrenomInput" placeholder="Votre prénom" value="<?= htmlspecialchars($last_name ?? '') ?>" name="last_name">
        </div>
        <div class="mb-3">
            <label for="EmailInput" class="form-label">Email</label>
            <input type="email" class="form-control" id="EmailInput" placeholder="Votre email" value="<?= htmlspecialchars($email ?? '') ?>" name="email" required>
        </div>

        <div class="mb-3">
            <label for="currentPassword" class="form-label">Mot de passe actuel</label>
            <input type="password" class="form-control" id="currentPassword" placeholder="Entrez votre mot de passe actuel" name="currentPassword" required>
        </div>
        <div class="mb-3">
            <label for="newPassword" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="newPassword" placeholder="Entrez votre nouveau mot de passe" name="newPassword" required>
        </div>
        <div class="mb-3">
            <label for="confirmNewPassword" class="form-label">Confirmer le nouveau mot de passe</label>
            <input type="password" class="form-control" id="confirmNewPassword" placeholder="Confirmez votre nouveau mot de passe" name="confirmNewPassword" required>
        </div>

        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Modifier vos informations</button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='/account/delete'">Supprimer mon compte</button>
        </div>
    </form>

    <!-- Ajouter le bouton de déconnexion -->
    <div class="text-center pt-3">
        <a href="/account/logout" class="btn btn-secondary">Se déconnecter</a>
    </div>
</div>