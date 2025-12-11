<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("INSERT INTO notes (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Catatan</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Tambah Catatan</h1>
    <form method="POST">
        <input type="text" name="title" placeholder="Judul Catatan" required>
        <textarea name="content" placeholder="Isi Catatan" rows="8" style="height: 150px; resize: vertical;" required></textarea>
        <button type="submit">Tambah</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>
