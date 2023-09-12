<?php

 if($auth::isAuth()) $auth::redirect('/'); ?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Connexion</h3>
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
                </div>
                <div class="card-body">
                    <form action="/login" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p>Vous n'avez pas de compte ? <a href="/inscription/">Inscrivez-vous</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
