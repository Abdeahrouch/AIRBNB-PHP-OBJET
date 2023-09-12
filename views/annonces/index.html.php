<h1><?= $h1_tag ?></h1>

<div class="container">
    <div class="row">
        <?php foreach ($annonces as $annonce) : ?>
            <?php var_dump($annonce); ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        Annonce <?= $annonce->id ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $annonce->titre ?></h5>
                        <!-- Ajout de l'image -->
                        <img src="<?= $annonce->image_path ?>" alt="Image de l'annonce">
                        <p class="card-text">
                            <strong>Pays:</strong> <?= $annonce->pays ?><br>
                            <strong>Ville:</strong> <?= $annonce->ville ?><br>
                            <strong>Adresse:</strong> <?= $annonce->adresse ?><br>
                            <strong>Type de logement:</strong> <?= $annonce->type_de_logement_id ?><br>
                            <strong>Taille:</strong> <?= $annonce->taile ?> m²<br>
                            <strong>Nombre de pièces:</strong> <?= $annonce->nbr_de_pieces ?><br>
                            <strong>Description:</strong> <?= $annonce->description ?><br>
                            <strong>Prix par nuit:</strong> <?= $annonce->prix_par_nuit ?> €<br>
                            <strong>Nombre de couchages:</strong> <?= $annonce->nbr_de_couchages ?><br>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
