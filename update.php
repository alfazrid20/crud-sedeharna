<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id_berita'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id_berita']) ? $_POST['id_berita'] : NULL;
        $nama = isset($_POST['tanggal_berita']) ? $_POST['tanggal_berita'] : '';
        $email = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
        $notelp = isset($_POST['gambar']) ? $_POST['gambar'] : '';
       
        // Update the record
        $stmt = $pdo->prepare('UPDATE tb_berita SET id_berita = ?, tanggal_berita = ?, deskripsi = ?, gambar = ?,  WHERE id_berita = ?');
        $stmt->execute([$id_berita, $tanggal_berita, $deksripsi, $gambar, $_GET['id_berita']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tb_berita WHERE id_berita = ?');
    $stmt->execute([$_GET['id_berita']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$berita) {
        exit('Berita doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Berita #<?=$berita['id_berita']?></h2>
    <form action="update.php?id=<?=$contact['is_double']?>" method="post">
        <label for="id">ID Berita</label>
        <label for="nama">Tanggal Berita</label>
        <input type="text" name="id" value="<?=$berita['id_berita']?>" id="id_berita">
        <input type="text" name="nama" value="<?=$berita['tanggal_berita']?>" id="tanggal_berita">
        <label for="email">Deskripsi</label>
        <label for="notelp">Gambar</label>
        <input type="text" name="email" value="<?=$berita['email']?>" id="email">
        <input type="text" name="notelp" value="<?=$berita['notelp']?>" id="notelp">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>