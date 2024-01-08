<?php 

require("../bootstrap.php");

$comments=$dbh->listComments($_GET["postId"]);

if($comments != null) {
  foreach($comments as $comment) : ?>

        <section class="comment-section">
            <div class="comment">
                <img src="../upload/1.jpeg" class="rounded-circle" class="userpfp" alt="utente" width="40" height="40">
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


    <form action="../util/salva_commento.php?postId=<?php echo $_GET["postId"]; ?>" class="comment-bar" 
            style="width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;" method="POST">
      <input type="text" id="comment-input" name="commento" class="comment-input" placeholder="Scrivi un commento..." 
            style="width: 80%;
            padding: 8px;
            margin-right: 10px;
            box-sizing: border-box;">
      <button type = "submit" class="comment-button"
            style="padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;">Invia</button>
    </form>

 


