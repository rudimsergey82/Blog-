<?php
require_once 'db.php';
require_once 'function.php';
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/styless.css">
	</head>
	<body>
		<div id="wrapper">
			<h1><?=$res_select_update[0]['post_title']?></h1>
			<div>
				<p class="nav right">
					<a href="../index.php">на главную</a>
				</p>
				<p class="date"><?=$res_select_update[0]['post_create_datetime']?></p>
				<p class="posttext">
                <?=$res_select_update[0]['post_text'];?>
                </p>
                <p>
                <?php if ($res_select_update[0]['tags']) {   // выборка тегов
					       $value['tags'] = explode(',', $res_select_update[0]['tags']);
					    foreach ($value['tags'] as $tag) {
					     	    //print_r($tag);?>
                         <span class="print_tag">
                         <a href='../include/posttotag.php?tag=<?=$tag?>'><?="#".$tag?></a>
                         </span>
					    <?php  } ?>  
				<?php } ?>
                </p>
                <a href='?id=<?=$_GET['id']?>&comment=mine#answer'>Оставить комментарий</a>
                <h4>Комментарии:</h4>
            <?php // выборка родительских пустых комментариев 
                   $res_row = $link ->query("SELECT * FROM comment WHERE post_id='$getid' and comment_parent_id is NULL ");   
                                while ( $row = $res_row ->fetch(PDO::FETCH_ASSOC)) {
                                       comment($row);
                                }
                if (!empty($_GET['comment'])) {
                    ?>
                    <form method="POST">
                            <p>
                                <input name="comment_name" placeholder="ваше имя" class="form-control">
                            </p>
                            <p>
                                <textarea placeholder="  ваш коментарий" name="comment_text" cols="77" rows="5"></textarea>
                            </p>
                            <p>
                                <input name="save_comment" type="submit" class="btn btn-danger btn-block" value="Отправить">
                            </p>
                    </form>
                <?php }
                    if (!empty($_GET['comment_edit'])) {
                    ?>
                    <form method="POST" >
                            <p class="error" style="color: red; font-weight: bolder; text-align: center";><?=$error_comment_edit;?></p>
                            <p>
                                <input name="comment_edit_name" placeholder="ваше имя" class="form-control" value="<?=$comment_sql_result['comment_username']?>">
                            </p>
                            <p>
                                <textarea placeholder="  ваш коментарий" name="comment_edit_text" cols="77" rows="5" ><?=$comment_sql_result['comment_text']?></textarea>
                            </p>
                            <p>
                                <input name="save_edit_comment" type="submit" class="btn btn-danger btn-block" value="Отправить">
                            </p>
                    </form>
                 <?php }?>
                 <div id="answer"></div>
			</div>
		</div>
	</body>
</html>

