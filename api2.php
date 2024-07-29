

<?php 
$db = new PDO("mysql:host=localhost;dbname=htmx", "root", "");
switch ($_GET['action']){
    case "add_post":
        $sql= $db->prepare("INSERT INTO posts (title, content, image) VALUES (:title, :content, :image)");
        $sql->execute([
            ":title" => $_POST['title'], 
            ":content" => $_POST['content'], 
            ":image" => "xxx", 
        ]);
?>
            <div class="col">
                <div class="card mt-5" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $_POST['title']; ?></h5>
                        <p class="card-text"><?php echo $_POST['content']; ?></p>
                        <a href="#" class="btn btn-danger">Delete Post</a>
                        <a href="#" class="btn btn-success">Edit Post</a>
                    </div>
                </div>
            </div>
<?php
    break;

    case "get_posts":
        $sql = $db->query("SELECT * FROM posts");
        $posts= $sql -> fetchAll(PDO::FETCH_ASSOC);
        foreach($posts as $post){
            ?>
            <div class="col">
            <div class="card mt-5" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post['title']; ?></h5>
                    <p class="card-text"><?php echo $post['content']; ?></p>
                    <a href="#" class="btn btn-danger">Delete Post</a>
                    <a href="#" class="btn btn-success">Edit Post</a>
                </div>
            </div>
            <?php
        }
    break;
    default:
        echo "invalid action";
}
?>