<?php 

require("bootstrap.php");

if($templateParams["comments"] > 0) {
  foreach($templateParams["comments"] as $comment) : ?>

        <section class="comment-section">
            <div class="comment">
                <img src="img/user.jpg" class="rounded-circle" class="userpfp" alt="utente" width="40" height="40">
                <?php echo $comment["username"]?>
                <p class="comment-text"><?php echo $comment["testo"]?></p>
            </div>
        </section>

  <?php endforeach;
} else {?>
  <section>
    <div>
      <h2>Non ci sono ancora commenti</h2>
    </div>
  </section>
<?php }?>


