<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ?");
$stmt->execute([$id]);
$note = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$note) {
    die("Catatan tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Catatan: <?php echo htmlspecialchars($note['title']); ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Review Catatan</h1>
    <div class="note-detail">
        <h2><?php echo htmlspecialchars($note['title']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($note['content'])); ?></p>
        <p><small>Dibuat pada: <?php echo $note['created_at']; ?></small></p>
        <div class="actions">
            <a href="edit.php?id=<?php echo $note['id']; ?>" class="edit">Edit</a>
            <a href="delete.php?id=<?php echo $note['id']; ?>" onclick="return confirm('Yakin hapus catatan ini?')" class="delete">Hapus</a>
            <a href="index.php" class="back">Kembali</a>
        </div>
    </div>
</body>
</html>