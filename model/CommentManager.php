<?php
require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, post_id, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        
        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $newComment = $req->execute(array($postId, $author, $comment));

        return $newComment;
    } 

    public function updateReporting($postId, $reporting)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reporting = ? + 1 WHERE id = ?');
        $report = $req->execute(array($reporting, $postId));
        
        return $report;
    }   

    public function getCommentsAdmin()
    {
        $db = $this->dbConnect();
        $commentsAdmin = $db->query('SELECT id, post_id, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE reporting > 1 ORDER BY reporting DESC');
        
        return $commentsAdmin;
    }

    public function getComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $req->execute(array($id));
        $comment = $req->fetch();
        
        return $comment;
    } 

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $eraseComment = $req->execute(array($id));
        
        return $eraseComment;
    }

    public function updateComment($id, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment = ?, reporting = 0 WHERE id = ?');
        $rewriteComment = $req->execute(array($comment, $id));
        
        return $rewriteComment;
    } 
}