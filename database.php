<?php
class Database
{
    private $host = "localhost";
    private $db = "PPE4";
    private $username = "root";
    private $password = "";
    private $charset = "utf8mB4";
    public $dbHandler;
    private $statement;
    private $error;

    private static $monPdo;
    private static $instance;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db . ';charset=' . $this->charset;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->dbHandler = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
}
?>