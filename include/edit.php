<?php
 //error_reporting(E_ALL);

require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Редактировать запись</title>
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/styless.css">
	</head>
	<body>
		<div id="wrapper">
			<h1>Редактировать запись</h1>
			<p class="nav">
				<a href="../index.php">на главную</a>
			</p>
			<p class="error" style="color: red; font-weight: bolder; text-align: center";><?=$error_tag;?></p>
			<div>
				<form action="" method="POST" enctype="multipart/form-data">
				    <p>Редактировать время</p>
					<p><input name="time_edit" class="form-control" value="<?=$res_select_update[0]['post_create_datetime']?>"></p>
					<p>Редактировать имя</p>
					<p><input name="author_edit" class="form-control" value="<?=$res_select_update[0]['post_title']?>"></p>
				    <?php if ($res_select_update[0]['tags']) {   // выборка тегов?>
				            <p>Редактировать теги</p>
                            <p><input name="tag_edit" class="form-control" value="<?=$res_select_update[0]['tags']?>"></p>                            
				     <?php } else {?> <p><input name="tag_edit" placeholder="можно добавить новые теги" class="form-control"></p><?php }?>
				     <p>Редактировать краткое содержание</p>
					<p>
                        <textarea placeholder="краткое содержание" class="form-control" name="up_min_article">
                             <?=$res_select_update[0]['post_min_text']?>
                        </textarea>
                    </p>
                    <p>Редактировать текст поста</p>
                    <p>
					    <textarea name="full_edit" class="form-control">
                        <?=$res_select_update[0]['post_text']?>
		        	    </textarea>
					</p>
					<p><input name="save" type="submit" class="btn btn-danger btn-block" value="Сохранить"></p>
				</form>
			</div>
			
		</div>

	</body>
</html>


			