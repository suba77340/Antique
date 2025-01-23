<div class="restaurant text-center text-white">
    <div class="restaurant-content">
        <h1>Vos réservations</h1>
    </div>
</div>

<div class="container text-center pb-3">
    <h1>Mes réservations</h1>
</div>

<div class="container text-center allresa">
    <?php if (empty($reservations)): ?>
    <?php else: ?>
        <?php foreach ($reservations as $reservation): ?>
            <a href="#" class="reservation-item">
                <span><?= htmlspecialchars($reservation->name) ?></span> | 
                <span><?= htmlspecialchars($reservation->date) ?></span> | 
                <span><?= htmlspecialchars($reservation->heure) ?></span> | 
                <span><?= htmlspecialchars($reservation->nbConvives) ?> personnes</span> | 
                <span><?= htmlspecialchars($reservation->allergies ?: 'Pas d’allergie') ?></span>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


<div class="container">
    <form method="POST" action="/allresa/make">
        <div class="mb-3">
            <label for="NomInput" class="form-label">Nom</label>
            <input type="text" class="form-control" id="NomInput" placeholder="Votre nom" name="Nom">
        </div>
        <div class="mb-3">
            <label for="PrenomInput" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="PrenomInput" placeholder="Votre prénom"name="Prenom">
        </div>
        <div class="mb-3">
            <label for="AllergieInput" class="form-label">Allergies</label>
            <input type="text" class="form-control" id="AllergieInput" placeholder="Vos allergies (fruits de mer, arachides..)" name="Allergies">
        </div>
        <div class="mb-3">
            <label for="NbConvivesInput" class="form-label">Nombres de convives</label>
            <input type="number" class="form-control" id="NbConvivesInput" name="NbConvives">
        </div>
        <div class="mb-3">
            <label for="DateInput" class="form-label">Date</label>
            <input type="date" class="form-control" id="DateInput" name="Date">
        </div>
        <div class="mb-3">
            <label for="HeureInput" class="form-label">Heure</label>
            <select class="form-select" id="selectHour" name="Heure">
                <option>19:30</option>
                <option>19:45</option>
                <option>20:00</option>
                <option>20:15</option>
                <option>20:30</option>
                <option>20:45</option>
                <option>21:00</option>
                <option>21:15</option>
                <option>21:30</option>
            </select>
        </div>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Réserver</button>
        </div>
    </form>
</div>
