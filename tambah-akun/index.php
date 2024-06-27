<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun</title>
</head>
<body>
    <h1>Tambah Akun</h1>
    <form action="../actions/prosestambahakun.php" method="POST" enctype="multipart/form-data">
        <label for="foto">Foto </label>
        <input type="file" name="foto" id="foto" accept="image/*" />
        <br>
        <label for="username">Username </label>
        <input type="text" name="username">
        <br>
        <label for="nama">Nama </label>
        <input type="text" name="nama">
        <br>
        <label for="password">Password </label>
        <input type="text" name="password">
        <br>
        <input type="submit" name="simpan" value="Tambah">
    </form>
    <?php include('../actions/cekStatus.php'); ?>
</body>
</html>