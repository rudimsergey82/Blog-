<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 1);
session_start();
require_once 'include/db.php';
require_once 'include/valid.php';
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Список записей</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/styless.css">
	</head>
	<body>
	        <div id="login_form" style=" margin-top: 10px; margin-right: 50px; text-align: right; ">
	          <?php if (!$_SESSION['logined']):?>
                    <p class="error"><?=$error_login;?></p>
                    <form action="" method="post" class="">
                          <input type="text" name="name" placeholder="Введите имя">
                          <input type="password" name="password" placeholder="Введите пароль" class="">
                          <input name="sub" type="submit" value="Отправить">
                    </form>
              <?php else: echo "Вы вошли как: " . $_SESSION['user'];?>
                    <a href='?exit' class="btn btn-info">Выход</a>
              <?php endif; ?>
            </div>
           
            </div>
	      </div>

		<div id="wrapper">
			<h1>Список записей</h1>
			
                 <?php
                 require_once 'include/page_navigation.php';
                 ?>

            <?php if($_SESSION['logined']): ?>
			<div>
				<a href="include/add.php" class="btn btn-danger btn-block">Добавить запись</a>
			</div>
            <?php endif; ?>
		</div>
	</body>
</html>


			