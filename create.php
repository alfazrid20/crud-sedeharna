<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id_berita = isset($_POST['id_berita']) && !empty($_POST['id_berita']) && $_POST['id_berita'] != 'auto' ? $_POST['id_berita'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $tanggal_berita = isset($_POST['tanggal_berita']) ? $_POST['tanggal_berita'] : '';
    $deksripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
    $gambar = isset($_POST['gambar']) ? $_POST['gambar'] : '';
   
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tb_berita VALUES (?, ?, ?, ?)');
    $stmt->execute([$id_berita, $tanggal_berita, $deksripsi, $gambar]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambahkan Tanggal</h2>
    <form action="create.php" method="post">
        <label for="id_berita">ID_Berita</label>
        <label for="Id_Berita"></label>
        <input type="text" name="id_berita" value="auto" id="id_berita">
        <label for="tanggal_berita">Tanggal Berita</label>
        <label for="deskripsi">Deskripsi</label>
        <input type="text" name="" id="tanggal_berita">
        <input type="text" name="deskripsi" id="deskripsi">
        <label for="gambar">Gambar</label>
        <input type="file" name="gambar">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>