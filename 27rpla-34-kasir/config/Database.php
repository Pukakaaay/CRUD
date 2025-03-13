<?php

if (!class_exists('Database')) {
    class Database {
        private $dbms = "mysql";
        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $namadb = "27_rpla_34_kasir"; 
        public $connection;

        public function connect() {
            try {
                $this->connection = new PDO(
                    "$this->dbms:host=$this->host;dbname=$this->namadb",
                    $this->user,
                    $this->pass
                );
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->connection;
            } catch (PDOException $e) {
                die("Koneksi gagal: " . $e->getMessage());
            }
        }
    }
}
?>
