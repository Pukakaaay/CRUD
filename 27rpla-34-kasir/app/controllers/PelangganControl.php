<?php 
include "../app/models/Pelanggan.php";

class PelangganController {
    private $model;

    public function __construct() {
        $this->model = new Pelanggan();
    }

    public function getList() {
        $data = $this->model->ambilSemua(); 
        include "../app/views/pelanggan/list.php"; 
    }

    public function detail($id) {
        $data = $this->model->ambilSatu($id);
        include "../app/views/pelanggan/detail.php"; 
    }
    
    public function tambah() {
        include "../app/views/pelanggan/tambah.php"; 
    }

    public function simpanTambah() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model->tambahPelanggan($_POST);
        }
        header("Location: index.php?page=list");
        exit;
    }

    public function edit($id) {
        $data = $this->model->ambilSatu($id);
        include "../app/views/pelanggan/edit.php"; 
    }

    public function simpanEdit() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model->updatePelanggan($_POST);
        }
        header("Location: index.php?page=list");
        exit;
    }

    public function hapus($id) {
        $this->model->hapusPelanggan($id);
        header("Location: index.php?page=list");
        exit;
    }
}

// Routing untuk edit pelanggan
if (isset($_GET['page'])) {
    $controller = new PelangganController();
    
    if ($_GET['page'] == 'edit' && isset($_GET['id'])) {
        $controller->edit($_GET['id']);
        exit;
    } elseif ($_GET['page'] == 'simpanEdit') {
        $controller->simpanEdit();
        exit;
    }
}
?>
