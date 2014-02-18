<?php

class DbUser extends Model {
    private static $CREATE_QUERY = <<<EOQ
            CREATE TABLE IF NOT EXISTS `user` (`user` TEXT UNIQUE ON CONFLICT IGNORE,
                `password` TEXT, `group` TEXT, `email` TEXT)
EOQ;
    private static $SELECT_QUERY = <<<EOQ
            SELECT * FROM `user` WHERE `user` = :user OR `group` = :group OR `email` = :email
EOQ;
    private static $INSERT_QUERY = <<<EOQ
            INSERT INTO `user` (`user`, `password`, `group`) VALUES (:user, :user, :user)
EOQ;
    private static $UPDATE_QUERY = <<<EOQ
            UPDATE `user` SET `group` = :group, `email` = :email WHERE `user` = :user
EOQ;
    private static $DELETE_QUERY = <<<EOQ
            DELETE FROM `user` WHERE `user` = :user
EOQ;
    private static $MATCH_QUERY = <<<EOQ
            SELECT * FROM `user` WHERE `user` = :user AND `password` = :password
EOQ;
    private static $GROUP_QUERY = <<<EOQ
            SELECT `group` FROM `user` WHERE `user` = :user
EOQ;

    public function __construct() {
        parent::__construct();
        $this->init();
    }
    
    private function init() {
        $this->insert('admin');
        $this->insert('guest');
    }

    protected function create() {
        $this->db->exec(self::$CREATE_QUERY);
    }

    protected function select() {
        $stmt = $this->db->prepare(self::$SELECT_QUERY);
        $stmt->bindValue(':user', HttpGetRequest::getUser(), SQLITE3_TEXT);
        $stmt->bindValue(':group', HttpGetRequest::getGroup(), SQLITE3_TEXT);
        $stmt->bindValue(':email', HttpGetRequest::getEmail(), SQLITE3_TEXT);
        $this->echoResult($stmt->execute());
    }

    protected function insert($user = NULL) {
        $stmt = $this->db->prepare(self::$INSERT_QUERY);
        $stmt->bindValue(':user', isset($user) ? $user : HttpGetRequest::getUser(), SQLITE3_TEXT);
        $this->echoResult($stmt->execute());
    }

    protected function update() {
        $stmt = $this->db->prepare(self::$UPDATE_QUERY);
        $stmt->bindValue(':group', HttpGetRequest::getGroup(), SQLITE3_TEXT);
        $stmt->bindValue(':email', HttpGetRequest::getEmail(), SQLITE3_TEXT);
        $stmt->bindValue(':user', HttpGetRequest::getUser(), SQLITE3_TEXT);
        $this->echoResult($stmt->execute());
    }
    
    protected function delete() {
        $stmt = $this->db->prepare(self::$DELETE_QUERY);
        $stmt->bindValue(':user', HttpGetRequest::getUser(), SQLITE3_TEXT);
        $this->echoResult($stmt->execute());
    }

    public function match($user, $password) {
        $stmt = $this->db->prepare(self::$MATCH_QUERY);
        $stmt->bindValue(':user', Sqlite3::escapeString($user), SQLITE3_TEXT);
        $stmt->bindValue(':password', Sqlite3::escapeString($password), SQLITE3_TEXT);
        $result = $stmt->execute();
        return $result->fetchArray() !== FALSE;
    }
    
    public function getGroup($user) {
        $stmt = $this->db->prepare(self::$GROUP_QUERY);
        $stmt->bindValue(':user', Sqlite3::escapeString($user), SQLITE3_TEXT);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC)['group'];
    }
}