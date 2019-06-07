<?php
class Handler
{
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $charset = DB_CHARSET;
    private $tableName = DB_SL_TABLE_NAME;
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname.';charset='.$this->charset, $this->user, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'CREATE TABLE IF NOT EXISTS '.$this->tableName.'
            (
            hash VARCHAR (45)  PRIMARY KEY,
            link VARCHAR (250) NOT NULL
            )';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Error during connecting to DB: '.$e->getMessage());
        }
    }
    public function test()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS '.DB_SL_TABLE_NAME.'
            (
            hash VARCHAR (45)  PRIMARY KEY,
            link VARCHAR (250) NOT NULL
            )';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
    public function getLinkByHash($hash)
    {
        $sql = 'SELECT link FROM short_links WHERE hash=:hash';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':hash' => $hash
        ]);
        $link = $stmt->fetchColumn();
        return $link ? $link : false;
    }
    public function addNewLinkInOurDB($link)
    {
        try {
            $counter = 0;
            while (true){
                $counter++;
                if($counter === COUNTER_ATTEPTS){
                    return false;
                }
                $hash = substr(md5(microtime()), 0, 5);
                $sql = 'INSERT IGNORE INTO short_links 
                (hash, link) 
                VALUES 
                (:hash, :link)';
                $preparedRequest = $this->db->prepare($sql);
                $preparedRequest->execute([
                    ':hash' => $hash,
                    ':link' => $link,
                ]);
                echo $counter;
                if($preparedRequest->rowCount()){
                    return SHORT_LINK_TEMPLATE . $hash;
                }
            }
        } catch (Exception $e) {
            return false;
        }
    }

}