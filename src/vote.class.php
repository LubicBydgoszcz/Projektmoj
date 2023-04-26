<?php
class Vote {
    public static function upVote(int $postId, int $userID) : bool {
        global $db;
        $query = $db->prepare("INSERT INTO vote VALUES (NULL, ?, 1, ?)");
        $query->bind_param('ii', $postId, $userId);
        if($query->execute())
            return true;
        return false;
    }

    public static function downVote(int $postId, int $userId) : bool {
        global $db;
        $query = $db->prepare("INSERT INTO vote VALUES (NULL, ?, -1, ?)");
        $query->bind_param('ii', $postId, $userId);
        if($query->execute())
            return true;
        return false;
    }

    public static function getScore(int $postId) : int {
        global $db;
        $query = $db->prepare("SELECT SUM(value) FROM vote WHERE post_id = ?");
        $query->bind_param('i', $postId);
        if($query->execute()){
            $result = $query->get_result();
            $score = $result->fetch_row()[0];
            return $score;
        }
        return 0;
    }

    public static function getVote(int $postId, int $userId) : int {
        global $db;
        $query = $db->prepare("SELECT value FROM vote WHERE post_id = ? AND user_id = ?");
        $query->bind_param('ii', $postId, $userId);
        if($query->execute()) {
            $vote = $query->get_result()->fetch_row()[0];
            return $vote;
        }
        return 0;
    }
}
?>