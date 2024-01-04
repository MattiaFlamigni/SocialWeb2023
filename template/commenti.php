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

<section>
    <div class="comment-bar" 
            style="width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;">
      <input type="text" class="comment-input" placeholder="Scrivi un commento..." 
            style="width: 80%;
            padding: 8px;
            margin-right: 10px;
            box-sizing: border-box;">
      <button class="comment-button"  onclick="inviaCommento()"
            style="padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;">Invia</button>
    </div>
  </section>

  <script>
    function inviaCommento() {
      let commento = document.getElementById('comment-input').value;
    }
  </script>


