<div class="container mt-5">
    <h1>Ajouter un bien</h1>

    <form action="/ajoutBien" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        </div>
        <div class="mb-3">
            <label for="pays" class="form-label">Pays</label>
            <input type="text" class="form-control" id="pays" name="pays" required>
        </div>
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" required>
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" required>
        </div>
        <div class="mb-3">
            <label for="type_de_logement" class="form-label">Type de logement</label>
            <select class="form-select" id="type_de_logement" name="type_de_logement" required>
                <?php foreach ($typedelogements as $typedelogement) : ?>
                    <option value="<?= $typedelogement['id'] ?>"><?= $typedelogement['label'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="taile" class="form-label">Taille (en m²)</label>
            <input type="number" class="form-control" id="taile" name="taile" required>
        </div>
        <div class="mb-3">
            <label for="nbr_de_pieces" class="form-label">Nombre de pièces</label>
            <input type="number" class="form-control" id="nbr_de_pieces" name="nbr_de_pieces" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="prix_par_nuit" class="form-label">Prix par nuit</label>
            <input type="number" class="form-control" id="prix_par_nuit" name="prix_par_nuit" required>
        </div>
        <div class="mb-3">
            <label for="nbr_de_couchages" class="form-label">Nombre de couchages</label>
            <input type="number" class="form-control" id="nbr_de_couchages" name="nbr_de_couchages" required>
        </div>
        <div>
            <input type="file" name="images" id="images">

        </div>
        <button type="submit" class="btn btn-primary">Ajouter le bien</button>
    </form>
</div>