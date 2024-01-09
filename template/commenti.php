<?php 

require("bootstrap.php");
require("util/post.php");

$comments=$dbh->listComments($_GET["postId"]);

if($comments != null) {
  foreach($comments as $comment) : ?>

        <section class="comment-section">
            <div class="comment">
                <?php 
                if($profilePicURL = $dbh->getProPic($comment["username"])){
                  echo '<img src="' . propic_url($profilePicURL) . '" class=" rounded-circle" alt="User Image" width="50" height="50">';
                  
                }else{
                  echo '<img src="profile_pic/user.jpg" class=" rounded-circle" alt=""  width="50" height="50">';
                }
                echo $comment["username"]?>
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
      <label for="comment-input"></label>
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

 


