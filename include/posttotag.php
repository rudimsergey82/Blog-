<?php
  // error_reporting(E_ALL);
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Список записей по тегу <?="#".$_GET['tag']; ?></title>
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/styless.css">
	</head>
	<body>

		<div id="wrapper">
			<h1>Записи по тегу: <?="#".$_GET['tag']; ?></h1>
			
			<p class="nav">
				<a href="../index.php">на главную</a>
			</p>
            <?php for($i=0;$i<count($result_posts_for_tag);$i++):?>
			<div class="note">
				<p>
					<span class="date"><?=$result_posts_for_tag[$i]['post_create_datetime'];?></span>
					<a href="../note.php?id=<?=$result_posts_for_tag[$i]['post_id']?>"><?=$result_posts_for_tag[$i]['post_title'];?></a>
				</p>
				<p>
					<?=$result_posts_for_tag[$i]['post_min_text'];?>
				</p>
				<?php if ($result_posts_for_tag[$i]['tags']) {   // выборка тегов
					     $value['tags'] = explode(',', $result_posts_for_tag[$i]['tags']);
					     foreach ($value['tags'] as $tag) {
					     	    //print_r($tag);?>
                                  <span class="print_tag">
                                        <a href='../posttotag.php?tag=<?=$tag?>'><?="#".$tag?></a>
                                  </span>
					     <?php  } ?>  
				<?php } ?>
			</div>
            <?php endfor; 
            ?>


		</div>

	</body>
</html>


			