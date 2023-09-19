<div class="container">
    <h1><?= isset($h1_tag) ? htmlspecialchars($h1_tag) : 'Titre non défini' ?></h1>
    <div class="row">
        <div class="col-md-4">
            <img src="/img/<?= htmlspecialchars($annonce->photo[0]->image_path) ?>" alt="Image de l'annonce">
        </div>
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= isset($annonce->titre) ? htmlspecialchars($annonce->titre) : 'Titre non défini' ?></h5>
                    <p class="card-text">
                        <strong>Pays:</strong> <?= isset($annonce->pays) ? htmlspecialchars($annonce->pays) : 'Pays non défini' ?><br>
                        <strong>Ville:</strong> <?= isset($annonce->ville) ? htmlspecialchars($annonce->ville) : 'Ville non définie' ?><br>
                        <strong>Adresse:</strong> <?= isset($annonce->adresse) ? htmlspecialchars($annonce->adresse) : 'Adresse non définie' ?><br>
                        <strong>Type de logement:</strong> <?= isset($annonce->type_de_logement_id) ? htmlspecialchars($annonce->type_de_logement_id) : 'Type de logement non défini' ?><br>
                        <strong>Taille:</strong> <?= isset($annonce->taile) ? htmlspecialchars($annonce->taile) . ' m²' : 'Taille non définie' ?><br>
                        <strong>Nombre de pièces:</strong> <?= isset($annonce->nbr_de_pieces) ? htmlspecialchars($annonce->nbr_de_pieces) : 'Nombre de pièces non défini' ?><br>
                        <strong>Description:</strong> <?= isset($annonce->description) ? htmlspecialchars($annonce->description) : 'Description non définie' ?><br>
                        <strong>Prix par nuit:</strong> <?= isset($annonce->prix_par_nuit) ? htmlspecialchars($annonce->prix_par_nuit) . ' €' : 'Prix par nuit non défini' ?><br>
                        <strong>Nombre de couchages:</strong> <?= isset($annonce->nbr_de_couchages) ? htmlspecialchars($annonce->nbr_de_couchages) : 'Nombre de couchages non défini' ?><br>
                    </p>
                </div>
                <div class="card-footer">
                    <h5>Réserver cette annonce</h5>
                    <form action="/" method="POST">
                        <div class="form-group">
                            <label for="checkin">Date d'arrivée :</label>
                            <input type="date" id="checkin" name="checkin" required>
                        </div>
                        <div class="form-group">
                            <label for="checkout">Date de départ :</label>
                            <input type="date" id="checkout" name="checkout" required>
                        </div>
                        <button type="submit" class="btn btn-pink" id="btn-reserver">Réserver</button>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>