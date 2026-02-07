<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$isEditing = false;
$edit_id = $breed = $age = $description = $image = '';

// If editing, fetch data
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM cats WHERE id = $edit_id");
    if ($res && $res->num_rows === 1) {
        $data = $res->fetch_assoc();
        $breed = $data['breed'];
        $age = $data['age'];
        $description = $data['description'];
        $image = $data['image'];
        $isEditing = true;
    }
}

// Fetch all cats
$result = $conn->query("SELECT * FROM cats ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Cat Adoption</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 30px; }
        .container { max-width: 1000px; margin: auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        h2 { color: #4CAF50; text-align: center; }
        form { margin-top: 20px; padding: 20px; border: 1px solid #ccc; background: #fafafa; border-radius: 8px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border-radius: 6px; border: 1px solid #ccc; }
        button { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; }
        button:hover { background-color: #388e3c; }
        .cat-list { margin-top: 30px; }
        .cat-item { margin-bottom: 20px; padding: 10px; border-bottom: 1px solid #ccc; }
        .cat-item-actions a { margin-right: 10px; text-decoration: none; color: white; background-color: #f0ad4e; padding: 6px 10px; border-radius: 4px; font-size: 13px; }
        .cat-item-actions a.delete { background-color: #d9534f; }
        .logout { text-align: right; margin-top: -10px; }
        .logout a { text-decoration: none; background-color: #d9534f; color: white; padding: 8px 14px; border-radius: 6px; }
        .logout a:hover { background-color: #c9302c; }
    </style>
</head>
<body>

<div class="container">
    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>

    <h2>Welcome Admin! 🐱</h2>

    <!-- Add/Edit Cat Form (No Image) -->
    <form method="post" action="cat_form.php">
        <h3><?= $isEditing ? "Edit Cat" : "Add a New Cat" ?></h3>
        <input type="hidden" name="id" value="<?= $edit_id ?>">
        <input type="text" name="breed" value="<?= htmlspecialchars($breed) ?>" placeholder="Breed" required>
        <input type="number" name="age" value="<?= htmlspecialchars($age) ?>" placeholder="Age" required>
        <textarea name="description" placeholder="Description" required><?= htmlspecialchars($description) ?></textarea>
        <button type="submit"><?= $isEditing ? "Update Cat" : "Add Cat" ?></button>
    </form>

    <!-- Existing Cats List (No Image) -->
    <div class="cat-list">
        <h3>Existing Cats</h3>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="cat-item">
                    <strong><?= htmlspecialchars($row['breed']) ?></strong><br>
                    Age: <?= htmlspecialchars($row['age']) ?><br>
                    <?= htmlspecialchars($row['description']) ?>
                    <div class="cat-item-actions">
                        <a href="?edit=<?= $row['id'] ?>">Edit</a>
                        <a href="delete_cat.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No cats added yet.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
