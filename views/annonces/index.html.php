<?php

?>

<div class="text-center">
    <h1 class="text-pink"> <?= $h1_tag ?></h1>
</div>

<div class="container">
    <div class="row">
        <?php foreach ($annonces as $annonce) : ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $annonce->titre ?></h5>


                        <img src="/img/<?= $annonce->photo[0]->image_path ?>" alt="Image de l'annonce">

                        <p class="card-text">
                            <strong>Pays:</strong> <?= $annonce->pays ?><br>
                            <strong>Ville:</strong> <?= $annonce->ville ?><br>
                            <strong>Description:</strong> <?= $annonce->description ?><br>
                            <strong>Prix par nuit:</strong> <?= $annonce->prix_par_nuit ?> €<br>
                        </p>
                        <a href="/detail/<?= $annonce->id ?>" class="btn btn-primary">Voir détail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>