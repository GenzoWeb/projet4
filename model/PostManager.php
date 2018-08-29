<?php
require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts($start, $numberChapter)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts ORDER BY id DESC LIMIT :start, :numberChapter');

        $req->bindValue(':start', $start, PDO::PARAM_INT);
        $req->bindValue(':numberChapter', $numberChapter, PDO::PARAM_INT);
        $req->execute();

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

    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE posts, comments FROM posts LEFT JOIN comments ON posts.id = comments.post_id WHERE posts.id = ?');
        $erasePost = $req->execute(array($postId));
        
        return $erasePost;
    }

    public function countPosts($numberChapter)
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbPosts FROM posts');
        $data = $req->fetch();
        $nbPosts = $data['nbPosts'];

        return $nbPosts;
    } 
}