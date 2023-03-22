<?php
class User {
    private int $id;

    private string $email;

    public function __construct(int $id, string $email){
        $this->id = $id;
        $this->email = $email;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getName() : string {
        return $this->email;
    }

    public static function getNameById(int $userId) : string {
        global $db;
        $query = $db->prepare("SELECT email FROM user WHERE id = ? LIMIT 1");
        $query->bind_param('i', $userId);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        return $row['email'];
    }

    public static function register(string $email, string $password) {
        global $db;
        $query = $db->prepare("INSERT INTO user VALUES(NULL, ?, ?)");
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);
        $query->bind_param('ss', $email, $passwordHash);
        return $query->execute();
    }

    public static function login(string $email, string $password) {
        global $db;
        $query = $db->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        $passwordHash = $row['password'];
        if(password_verify($password, $passwordHash)) {
            $u = new User($row['id'], $email);
            $_SESSION['user'] = $u;
        }
    }
}
?>