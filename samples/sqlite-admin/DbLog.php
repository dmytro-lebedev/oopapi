<?php

class DbLog extends Model {
    private static $CREATE_QUERY = <<<EOQ
            CREATE TABLE IF NOT EXISTS `log` (`user` TEXT, `message` TEXT)
EOQ;
    private static $SELECT_QUERY = <<<EOQ
            SELECT * FROM `log` WHERE `user` = :user
EOQ;
    private static $INSERT_QUERY = <<<EOQ
            INSERT INTO `log` (`user`, `message`) VALUES (:user, :message)
EOQ;
    private static $DELETE_QUERY = <<<EOQ
            DELETE FROM `log` WHERE `user` = :user
EOQ;

    protected function create() {
        $this->db->exec(self::$CREATE_QUERY);
    }

    protected function select() {
        $stmt = $this->db->prepare(self::$SELECT_QUERY);
        $stmt->bindValue(':user', HttpGetRequest::getUser(), SQLITE3_TEXT);
        $this->echoResult($stmt->execute());
    }

    protected function insert($user = NULL, $message = NULL) {
        $stmt = $this->db->prepare(self::$INSERT_QUERY);
        $stmt->bindValue(':user', isset($user) ? $user : HttpGetRequest::getUser(), SQLITE3_TEXT);
        $stmt->bindValue(':message', isset($message) ? $message : HttpGetRequest::getMessage(), SQLITE3_TEXT);
        $this->echoResult($stmt->execute());
    }

    protected function update() {
        throw new BadMethodCallException();
    }

    protected function delete() {
        $stmt = $this->db->prepare(self::$DELETE_QUERY);
        $stmt->bindValue(':user', HttpGetRequest::getUser(), SQLITE3_TEXT);
        $this->echoResult($stmt->execute());
    }

    public function log($message) {
        $this->insert(Sqlite3::escapeString(HttpBasicAuthentication::getUser()),
                Sqlite3::escapeString($message));
    }
}