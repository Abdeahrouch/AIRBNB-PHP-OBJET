<div class="container mt-5">
    <h2>Formulaire d'inscription</h2>

    <?php
    if ($form_result && $form_result->hasError()) {
        $errors = $form_result->getErrors();
        if (!empty($errors)) {
    ?>
            <div>
                <?php echo $errors[0]->getMessage(); ?>
            </div>
    <?php
        }
    }
    ?>
    <form action="/inscription" method="post">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="is_hote">Êtes-vous un hôte ?</label>
            <select class="form-control" id="is_hote" name="is_hote" required>
                <option value="1" selected>Oui</option>
                <option value="0">Non</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>