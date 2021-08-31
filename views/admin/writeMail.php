<h1>Création d'un nouveau mail</h1>
<div class="row">
    <form action="" method="post" class="col-md-6 offset-md-3">
        <div class="form-group">
            <label for="mailType" class="form-label">Type</label>
            <select name="mailType" id="mailType" class="form-control">
                <?php
                foreach ($typesList as $type) { ?>
                    <option value="<?= $type->key ?>"><?= $type->value ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="subject" class="form-label">Sujet</label>
            <input type="text" name="subject" id="subject" class="form-control" />
        </div>
        <div class="form-group">
            <label for="content" class="form-label">Contenu</label>
            <textarea name="content" id="content" class="form-control"></textarea>
        </div>
        <input type="submit" value="Enregistrer" name="saveMail" class="btn btn-success mt-4" />
    </form>
</div>