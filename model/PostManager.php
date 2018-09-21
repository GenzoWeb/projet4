<?php
require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts($start, $numberChapter)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT posts.id AS id, posts.title AS title, posts.content AS content, DATE_FORMAT(posts.creation_date, \'%d/%m/%Y\') AS creation_date_fr, COUNT(comments.post_id) AS nb FROM posts  LEFT JOIN comments ON posts.id=comments.post_id GROUP BY posts.id LIMIT :start, :numberChapter');

        $req->bindValue(':start', $start, PDO::PARAM_INT);
        $req->bindValue(':numberChapter', $numberChapter, PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function getPost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($id));
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

    public function updatePost($id, $title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $rewritePost = $req->execute(array($title, $content, $id));
        
        return $rewritePost;
    }

    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE posts, comments FROM posts LEFT JOIN comments ON posts.id = comments.post_id WHERE posts.id = ?');
        $erasePost = $req->execute(array($id));
        
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