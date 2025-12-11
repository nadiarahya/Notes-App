<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM notes ORDER BY created_at DESC");
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notes App</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Notes App</h1>
    <a href="add.php">Tambah Catatan Baru</a>
    <div class="notes-list">
        <?php if (empty($notes)): ?>
            <p>Tidak ada catatan.</p>
        <?php else: ?>
            <?php foreach ($notes as $note): ?>
                <a href="view.php?id=<?php echo $note['id']; ?>" class="note-link"> <!-- Wrap kartu dengan link -->
                    <div class="note-item">
                        <h3><?php echo htmlspecialchars($note['title']); ?></h3>
                        <p><?php echo htmlspecialchars($note['content']); ?></p>
                        <div class="actions">
                            <a href="edit.php?id=<?php echo $note['id']; ?>" class="edit" onclick="event.stopPropagation();">Edit</a> <!-- Stop propagation agar tidak trigger link kartu -->
                            <a href="delete.php?id=<?php echo $note['id']; ?>" onclick="return confirm('Yakin hapus?'); event.stopPropagation();" class="delete">Hapus</a>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>