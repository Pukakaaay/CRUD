<?php
include "../config/Database.php";

class Pelanggan {
    private $tabel = "pelanggan";
    private $dbk;
    private $connection;

    public function __construct() {
        $this->dbk = new Database();
        $this->connection = $this->dbk->connect();
    }

    public function ambilSemua() {
        $sql = "SELECT * FROM $this->tabel";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ambilSatu($filter) {
        $sql = "SELECT * FROM $this->tabel WHERE PelangganID = '$filter'";
        $query = $this->connection->prepare($sql);
        $query->execute();
        $hasil = $query->fetch(PDO::FETCH_ASSOC);
        return $hasil;
    }
    

    public function tambahPelanggan($data) {
        $sql = "INSERT INTO $this->tabel (NamaPelanggan, Alamat, NomorTelepon) VALUES (:nama, :alamat, :telepon)";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":nama", $data["nama"]);
        $query->bindParam(":alamat", $data["alamat"]);
        $query->bindParam(":telepon", $data["telepon"]);
        return $query->execute();
    }

    public function hapusPelanggan($id) {
        $sql = "DELETE FROM $this->tabel WHERE PelangganID = :id";
        $query = $this->connection->prepare($sql);
        $query->bindParam(":id", $id);
        return $query->execute();
    }
    public function updatePelanggan($data) {
        $sql = "UPDATE pelanggan SET NamaPelanggan = :nama, NomorTelepon = :telepon, Alamat = :alamat WHERE PelangganID = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(":id", $data['id']);
        $query->bindParam(":nama", $data['nama']);
        $query->bindParam(":telepon", $data['telepon']);
        $query->bindParam(":alamat", $data['alamat']);
    
        return $query->execute();
    }
}
?>
