<?php
class Vote {
    public static function upVote(int $postId, int $userId) : bool {
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
        $query = $db->prepare("SELECT SUM(score) FROM vote WHERE post_id = ?");
        $query->bind_param('i', $postId);
        if($query->execute()){
            $result = $query->get_result();
            if($result->num_rows > 0) {
                $row = $result->fetch_row();
                if($row[0] == NULL) {
                    return 0;
                } else 
                    return $row[0];
            }

            else return 0;
        }
        return 0;
    }

    public static function getVote(int $postId, int $userId) : int {
        global $db;
        $query = $db->prepare("SELECT score FROM vote WHERE post_id = ? AND user_id = ?");
        $query->bind_param('ii', $postId, $userId);
        if($query->execute()) {
            $result = $query->get_result();
            if($result->num_rows > 0)
                return $result->fetch_row()[0];
            else return 0 ;
        }
        return 0;
    }
}
?>