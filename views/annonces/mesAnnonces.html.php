<div class="container mt-5">
    <h1>Mes annonces</h1>

    <div class="row">
        <?php if (!empty($mesAnnonces)) : ?>
            <?php foreach ($mesAnnonces as $annonce) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $annonce['titre'] ?></h5>
                            <p class="card-text"><strong>Description :</strong> <?= $annonce['description'] ?></p>
                            <p class="card-text"><strong>Pays :</strong> <?= $annonce['pays'] ?></p>
                            <p class="card-text"><strong>Ville :</strong> <?= $annonce['ville'] ?></p>
                            <p class="card-text"><strong>Adresse :</strong> <?= $annonce['adresse'] ?></p>
                            <p class="card-text"><strong>Taille :</strong> <?= $annonce['taile'] ?> m²</p>
                            <p class="card-text"><strong>Nombre de pièces :</strong> <?= $annonce['nbr_de_pieces'] ?></p>
                            <p class="card-text"><strong>Prix par nuit :</strong> <?= $annonce['prix_par_nuit'] ?> €</p>
                            <p class="card-text"><strong>Nombre de couchages :</strong> <?= $annonce['nbr_de_couchages'] ?></p>
                            <form action="/mesAnnonces">
                                <input type="hidden" name="annonce_id" value="<?= $annonce['id'] ?>">
                                <button type="submit" class="btn btn-danger">Supprimer l'annonce</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Vous n'avez pas encore créé d'annonces.</p>
        <?php endif; ?>
    </div>
</div>
