<div class="profile">
    <h1>Profil de <span id="spanpseudo" data-input="pseudo"><?= $pseudo ?></span><input type="text" value="<?= $pseudo ?>" name="pseudo" id="pseudo" /></h1>
    <div class="card" style="width: 18rem;">
        <img src="<?= (!empty($_SESSION['user']['avatar']))  ? $_SESSION['user']['avatar'] :  $defaultImage ?>" class="card-img-top" alt="Profil de <?= $pseudo  ?>">
        <div class="card-body">
            <p class="card-title h5"><span id="spanmail" data-input="mail"><?= $mail ?></span><input type="email" value="<?= $mail ?>" name="mail" id="mail" /></p>
            <p class="card-text">Derniere connexion : <?= isset($_SESSION['user']['last_session_at']) ? $_SESSION['user']['last_session_at'] : '' ?></p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#avatarModal">Modifier l'image</button>
        </div>
    </div>
</div>
<div class="modal" id="avatarModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title h5">Changement de l'avatar</p>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <input type="file" name="avatar" id="avatar" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Enregistrer l'avatar" name="saveAvatar"/>
      </div>
    </div>
  </div>
</div>
