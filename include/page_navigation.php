<?php
session_start();
require_once 'db.php';

// Результирующий массив с элементами, выбранными с учётом LIMIT:
$items    = array();
// Число вообще всех элементов ( без LIMIT ) по нужным критериям.
$allItems_count = 0;
 // код постраничной навигации.
$html     = NULL;
// Количество элементов на странице. 
$limit    = 4;
// Количество страничек, нужное для отображения полученного числа элементов
$pageCount = 0;
 
//get из строки запроса. 
$start    = isset($_GET['page'])   ? intval( $_GET['page'] )   : 0 ;
//запрос для выборки целевых элементов прямое 
// Запрос для выборки целевых элементов:
if ($_GET['sort'] == "new") {
	$sql = $link->query("SELECT post.* , group_concat(tag.tag_title) as tags FROM post LEFT JOIN post_to_tag USING (post_id) LEFT JOIN tag USING (tag_id) group by post.post_id  LIMIT $start,$limit ");
} else $sql = $link->query("SELECT post.* , group_concat(tag.tag_title) as tags FROM post LEFT JOIN post_to_tag USING (post_id) LEFT JOIN tag USING (tag_id) group by post.post_id DESC LIMIT $start,$limit ");

 
// Запрос для выборки целевых элементов обратное




$res_select = $sql->fetchAll(PDO::FETCH_ASSOC);
// из phphell для вывода содержимого на страницу 
if( is_array($items) ) {
     
    for($i=0;$i<count($res_select);$i++) { ?>
         
        	<div class="note">
				<p>
					<span class="date"><?=$res_select[$i]['post_create_datetime'];?></span>
					<a href="include/note.php?id=<?=$res_select[$i]['post_id']?>"><?=$res_select[$i]['post_title'];?></a>
					<span>Количество комментариев: <?php
                            $count_title = $link->query("SELECT count(post_id)FROM comment WHERE post_id=" . $res_select[$i]['post_id']);
                            if (!$count_title) {
                                echo "PDO::errorInfo():";
                                print_r($link > errorInfo());
                                echo("<body><div><h3>Please enter the correct data!</div></body>");
                            } else  $res_count = $count_title->fetchAll(PDO::FETCH_ASSOC);
                            //var_dump($res_select);
                            echo $res_count[0]['count(post_id)'];
                            ?>
                        </span>
				</p>
				<p>
					<?=$res_select[$i]['post_min_text'];?>
				</p>
				<?php if ($res_select[$i]['tags']) {   // выборка тегов
					     $value['tags'] = explode(',', $res_select[$i]['tags']);
					     foreach ($value['tags'] as $tag) {
					     	    //print_r($tag);?>
                                  <span class="print_tag">
                                        <a href='include/posttotag.php?tag=<?=$tag?>'><?="#".$tag?></a>
                                  </span>
					     <?php  } ?>  
				<?php } ?>
                <?php if($_SESSION['logined']): //кнопки удалить и редактировать?> 
				<p class="nav">
					<a href="index.php?page=<?=$res_select[$i]['post_id']?>&del=<?=$res_select[$i]['post_id']?>">удалить</a> |
					<a href="include/edit.php?id=<?=$res_select[$i]['post_id']?>">редактировать</a>
				</p>
                <?php endif;?>
			</div>
     <?php    
    }
     
}
 
        
// количество всех элементов:
$sql_count = $link ->query("SELECT COUNT(post_id) AS count FROM post");
$allItems_count = $sql_count->fetch(PDO::FETCH_OBJ)->count;
 
// округляем в большую сторону чтоб показать остаток 
$pageCount = ceil( $allItems_count / $limit);

for( $i = 0; $i < $pageCount; $i++ ) {    
    $html .= '<li><a href="index.php?page=' . ($i * $limit)  . '">' . ($i + 1)  . '</a></li>';
}
 //вывод
echo '<ul class="pagination">' . $html . '</ul>';










