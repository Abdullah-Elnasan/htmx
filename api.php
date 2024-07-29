<?php 
$db = new PDO("mysql:host=localhost;dbname=htmx", "root", "");
function render_html($id, $title, $content, $image){
    echo "
    <div class='col' id=post-{$id} >
    <div class='card mt-5' style='width: 18rem;'>
        <div class='card-body'>
            <h5 class='card-title'>{$title}</h5>
            <p class='card-text'>{$content}</p>
            <a href='#' class='btn btn-danger' hx-get='./api.php?action=delete-post&id={$id}'>Delete Post</a>
            <a href='#' class='btn btn-success' hx-get='./edit.php?id={$id}&title={$title}&content={$content}&image={$image}' hx-target='#post-{$id}'>Edit Post</a>
        </div>
    </div>
    </div>
    ";
}

switch ($_GET['action']){
    case "add_post":
        $sql= $db->prepare("INSERT INTO posts (title, content, image) VALUES (:title, :content, :image)");
        $sql->execute([
            ":title" => $_POST['title'], 
            ":content" => $_POST['content'], 
            ":image" => "xxx", 
        ]);
        render_html($db->lastInsertId(), $_POST['title'], $_POST['content'], $image);
    break;

    case "get_posts":
        $sql = $db->query("SELECT * FROM posts");
        $posts= $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($posts as $post){
            render_html($post['id'], $post['title'], $post['content'], $post['image']);
        }
    break;

    case "update_post":
        header("HX-Trigger: post_update");
        $id= $_POST['id'];
        $title= $_POST['title']; 
        $content= $_POST['content'];

        $sql= $db->prepare("UPDATE  posts SET title=:title, content=:content WHERE id=:id LIMIT 1");
        $sql->execute([
            ":id" => $id,
            ":title" => $title, 
            ":content" => $content, 
        ]);
    break;

    case "delete-post":
        header("HX-Trigger: post_deleted");
        $id= $_GET['id'];
        $sql= $db->prepare("DELETE FROM posts  WHERE id=:id");
        $sql->execute([
            ":id" => $id,
        ]);
    break;

    
    default:
        echo "invalid action";
}
?>

