<?php
$id= $_GET['id'];
$title= $_GET['title'];
$content= $_GET['content'];
$image= $_GET['image'];

?>

<div class='card mt-5' style='width: 18rem;'>
        <div class='card-body'>
            <form hx-post='./api.php?action=update_post' hx-vals='.form' hx-target='#post-<?php echo $id?>' >
                    <div class="form">
                    <input name='id' type='hidden' value='<?php echo $id ?>' >
                    <input name='title' type='text' value='<?php echo $title ?>' class='form-control mb-3' >
                    <textarea name='content' class='form-control mb-3' rows='3'><?php echo $content ?></textarea>
                    <button class='btn btn-success'>Update post</button>
                    </div>
            </form>
        </div>
</div>


