<?php
try {
    $link = new PDO('mysql:host=localhost;dbname=blog', 'rudim', '123');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
} 

//добавление постов
if ($_POST['add_save']) {
    if (!empty($_POST['post_title_add'])and !empty($_POST['post_min_text_add'])){
        if (!empty($_POST['post_text_add'])){
            $insert = $link ->query("INSERT INTO post SET post.post_title = '{$_POST['post_title_add']}',post.post_min_text = '{$_POST['post_min_text_add']}',post.post_text='{$_POST['post_text_add']}',post.post_create_datetime = NOW()");
            $insert_post_id = $link->lastInsertId();//id последней добавленной строки
            if (!empty($_POST['tag_add'])) {
                $tag_arr = explode(',', $_POST['tag_add']);
                foreach ($tag_arr as $tags) {
                        //проверяет есть ли такой тег к таблице тегов
                        $insert_valid = $link ->query("SELECT * FROM tag WHERE tag_title ='$tags'");
                        $result_valid = $insert_valid->fetchAll(PDO::FETCH_ASSOC);
                    if (!empty($result_valid)) {
                        //print_r($result_valid);
                        $ins_tag_id = $result_valid[0]['tag_id'];
                        $insert_post_tag = $link ->query("INSERT INTO post_to_tag SET post_to_tag.post_id = '$insert_post_id', post_to_tag.tag_id = '$ins_tag_id'");
                    } else {
                            $insert = $link ->query("INSERT INTO tag SET tag_title ='$tags'"); // если нет, то добавляет
                            $insert_tag_id = $link->lastInsertId(); //id последней добавленной строки
                            $insert_post_tag = $link ->query("INSERT INTO post_to_tag SET post_to_tag.post_id = '$insert_post_id', post_to_tag.tag_id = '$insert_tag_id'");
                    }
                }
                
            }
        } header("Location:../index.php");
    } $error_post = "Поля не могут быть пусты";
}


//изъятие полного поста и тегов к нему в виде строки
if($_GET['id']){
    $getid = $_GET['id'];
    $select_update = $link->query("SELECT post.*, group_concat(tag.tag_title) as tags FROM post LEFT JOIN post_to_tag USING (post_id) LEFT JOIN tag USING (tag_id) WHERE post_id='$getid' group by post.post_id");
    $res_select_update = $select_update ->fetchAll(PDO::FETCH_ASSOC);
}

//изменение поста
if($_POST['save']) {
    $update = $link->query("UPDATE post SET post_title='{$_POST['author_edit']}',post_min_text = '{$_POST['up_min_article']}',post_text = '{$_POST['full_edit']}',post_create_datetime='{$_POST['time_edit']}',post_update_datetime=NOW() WHERE post_id=" . $_GET['id']);

        if (!empty($_POST['tag_edit'])) {
            $delet = $link ->query("DELETE FROM post_to_tag WHERE post_id=" . $_GET['id']);
            $tag_arr_edit = explode(',', $_POST['tag_edit']);
            foreach ($tag_arr_edit as $tags_edit) {
                    //проверяет есть ли такой тег к таблице тегов
                    $insert_valid_edit = $link ->query("SELECT * FROM tag WHERE tag_title ='$tags_edit'");
                    $result_valid_edit = $insert_valid_edit->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($result_valid_edit)) { //если есть 
                    $ins_tag_id_edit = $result_valid_edit[0]['tag_id'];
                    $ins_valid_edit = $link ->query("SELECT * FROM post_to_tag WHERE post_to_tag.post_id = '$getid' AND post_to_tag.tag_id = '$ins_tag_id_edit'");
                    $ins_valid_tag_edit = $ins_valid_edit ->fetchAll(PDO::FETCH_ASSOC);
                    // var_dump($ins_valid_tag_edit);
                        if (!empty($ins_valid_tag_edit)) { //и есть запись для него в смежной таблице
                            $error_tag = "Нельзя добавлять несколько одинаковых тегов";
                        } else { //если нет - создает новую
                            
                            $insert_edit_tag = $link ->query("INSERT INTO post_to_tag SET post_to_tag.post_id = '$getid', post_to_tag.tag_id = '$ins_tag_id_edit'");
                        }
                } else {
                        $insert = $link ->query("INSERT INTO tag SET tag_title ='$tags_edit'"); 
                        // если нет, то добавляет
                        $insert_tag_id_edit = $link->lastInsertId(); //id последней добавленной строки
                        $insert_post_tag = $link ->query("INSERT INTO post_to_tag SET post_to_tag.post_id = '$getid', post_to_tag.tag_id = '$insert_tag_id_edit'");
                }
            }
        }
    if (!$error_tag) {
        header("Location:../index.php");
    } 
}


//извлечение постов по тегу
if($_GET['tag']) {
    $gettag = $_GET['tag'];
    $select_post_tag = $link ->query("SELECT tag_id FROM tag WHERE tag_title = '$gettag'");
    if (!$select_post_tag) {
        echo "PDO::errorInfo():";
        print_r($link->errorInfo());
    } else $insert_tag_id = $select_post_tag->fetchAll();
    $tag_id_for_post = $insert_tag_id[0][0];
    $select_posts_for_tag = $link ->query("SELECT post.* from post LEFT JOIN post_to_tag USING (post_id) WHERE post_to_tag.tag_id = '$tag_id_for_post' ORDER BY post.post_create_datetime DESC");
    $result_posts_for_tag = $select_posts_for_tag ->fetchAll(PDO::FETCH_ASSOC);
    //print_r($result_posts_for_tag);
}


//удаление поста
if($_GET['del']) {
    $delete = $link->query("DELETE FROM post WHERE post_id=" . $_GET['del']);
    header("Location:index.php");
}


//добавление комментария
if (!empty($_POST['comment_name']) and !empty($_POST['comment_text'])) {
    if ($_GET['comment'] == 'mine') {
        $insert = $link ->query("INSERT INTO comment SET post_id = '{$_GET['id']}', comment_username = '{$_POST['comment_name']}', comment_text = '{$_POST['comment_text']}'");
        
    } else {
           $insert = $link ->query("INSERT INTO comment SET post_id = '{$_GET['id']}', comment_parent_id = '{$_GET['comment']}', comment_username = '{$_POST['comment_name']}', comment_text = '{$_POST['comment_text']}'");
    }   
} 

//удаление комментария
if ($_GET['comment_del']) {
    $delete_comment = $link ->query("DELETE FROM comment WHERE comment_id=" . $_GET['comment_del']);
}

//извлечения комментария для редактирования
if (!empty($_GET['comment_edit'])) {
    $comment_edit_sql = $link->query("SELECT * FROM comment WHERE comment_id=" . $_GET['comment_edit']);
    $comment_sql_result = $comment_edit_sql ->fetch(PDO::FETCH_ASSOC);
}
 
//добавление отредактированноого комментария
if ($_POST['save_edit_comment']) {
    if (!empty($_POST['comment_edit_name']) and !empty($_POST['comment_edit_text'])) {

        $insert_edit_comment = $link ->query("UPDATE comment SET comment_username = '{$_POST['comment_edit_name']}', comment_text = '{$_POST['comment_edit_text']}' WHERE comment_id=" . $_GET['comment_edit']);
    } else {$error_comment_edit= "Поля не могут быть пусты";}
}





