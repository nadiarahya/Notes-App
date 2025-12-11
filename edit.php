<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ?");
$stmt->execute([$id]);
$note = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$note) {
    die("Catatan tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Catatan</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Edit Catatan</h1>
    <form method="POST">
        <input type="text" name="title" value="<?php echo htmlspecialchars($note['title']); ?>" required>
        <textarea name="content" required><?php echo htmlspecialchars($note['content']); ?></textarea>
        <button type="submit">Update</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>