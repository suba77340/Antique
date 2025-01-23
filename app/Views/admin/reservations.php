<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations</title>

    <style>
        /* Centrer la table sur la page */
        table {
            width: 100%;
            /* La table prendra toute la largeur de son conteneur */
            margin: 0 auto;
            /* Centrer la table */
            border-collapse: collapse;
            /* Enlever les espaces entre les cellules */
        }

        /* Centrer le texte dans les cellules du tableau */
        table th,
        table td {
            text-align: center;
            /* Centrer le texte */
            padding: 10px;
            /* Ajouter de l'espace autour du texte */
        }

        /* Style des entêtes de colonne */
        table th {
            background-color: #f8f9fa;
            /* Fond léger pour les entêtes */
            font-weight: bold;
            /* Mettre en gras les entêtes */
        }

        /* Style des cellules de données */
        table td {
            background-color: #ffffff;
            /* Fond blanc pour les cellules */
        }

        /* Ajouter des bordures aux cellules et au tableau */
        table,
        th,
        td {
            border: 1px solid #ddd;
            /* Bordures légères */
        }

        /* Style responsive pour les petits écrans */
        @media (max-width: 768px) {
            table {
                width: 100%;
                /* La table prend 100% de la largeur pour les petits écrans */
            }

            /* Rendre la table plus lisible sur les petits écrans */
            table th,
            table td {
                padding: 8px;
                /* Moins d'espace sur les petits écrans */
            }

            /* Mettre la table en mode défilement horizontal sur mobile */
            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                /* Ajout de scrolling fluide sur mobile */
            }

            /* Enlever les bordures de la table pour une meilleure présentation sur mobile */
            table {
                border: none;
            }

            table th,
            table td {
                border: none;
                /* Supprimer les bordures visibles */
            }
        }
    </style>

</head>

<body>

    <div class="restaurant text-center text-white">
        <div class="restaurant-content">
            <h1>Réservations clients</h1>
        </div>
    </div>

    <div class="container text-center pb-3">
        <?php if (!empty($reservations)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Allergies</th>
                            <th>Nombre de convives</th>
                            <th>Date</th>
                            <th>Heure</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td><?= htmlspecialchars($reservation['name']) ?></td>
                                <td><?= htmlspecialchars($reservation['prenom']) ?></td>
                                <td><?= htmlspecialchars($reservation['allergies']) ?></td>
                                <td><?= htmlspecialchars($reservation['nbConvives']) ?></td>
                                <td><?= htmlspecialchars($reservation['date']) ?></td>
                                <td><?= htmlspecialchars($reservation['heure']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>Aucune réservation trouvée.</p>
        <?php endif; ?>
    </div>

</body>

</html>