<?php
session_start();
//рекурсивная функция 
function comment($row){ ?>
        <div style="margin-left: 30px">
	        <div id="<?=$row['comment_id']?>" class="date"><?=$row['comment_username'] . " " . $row['comment_datetime'] ?></div>
	        <div class="text"><?=$row['comment_text']?></div>
	        <a href="#<?=$row['comment_parent_id']?>" class="glyphicon glyphicon-circle-arrow-up"></a>
	        <a href="?id=<?=$_GET['id']?>&comment=<?=$row['comment_id']?>#answer">Ответить</a>
        <?php if ($_SESSION['logined']) { ?>
    	    | <a href='?id=<?=$_GET['id']?>&comment_del=<?=$row['comment_id']?>'>Удалить</a> 
    	    | <a href='?id=<?=$_GET['id']?>&comment_edit=<?=$row['comment_id']?>#answer'>Редактировать</a> 
        <?php }

        
        try {
             $link = new PDO('mysql:host=localhost;dbname=blog', 'rudim', '123');
            } catch (PDOException $e) {
             print "Error!: " . $e->getMessage() . "<br/>";
            die();
        } 

		$res = $link ->query("SELECT * FROM comment WHERE comment_parent_id=".$row['comment_id']);

		if ( $res->rowCount() > 0) {
			      while ($res_com = $res ->fetch(PDO::FETCH_ASSOC)) {
			      	    comment($res_com);
			      }
		}?>
	    </div>
	    <?php
}
?>
