<?php

include_once 'include.php';

$db = new Database();

$posts = $db -> getPosts();

foreach ($posts as $post) {
    echo $post;
    echo '<br/>';
}
?>

