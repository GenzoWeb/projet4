<?php
require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts ORDER BY id DESC');
        
        return $req;
    }
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }     

    public function createPost($title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES (?, ?, NOW())');
        $newPost = $req->execute(array($title, $content));
        
        return $newPost;
    }

    public function updatePost($postId, $title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $rewritePost = $req->execute(array($title, $content, $postId));
        
        return $rewritePost;
    }         
}