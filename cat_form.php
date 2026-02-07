<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$breed = trim($_POST['breed']);
$age = intval($_POST['age']);
$desc = trim($_POST['description']);
$imageName = '';

if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $imageName = time() . '_' . basename($_FILES['image']['name']); // auto-rename
    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/uploads/" . $imageName);
}

if (!empty($_POST['id'])) {
    // Update
    $id = intval($_POST['id']);
    if ($imageName !== '') {
        $stmt = $conn->prepare("UPDATE cats SET breed=?, age=?, description=?, image=? WHERE id=?");
        $stmt->bind_param("sissi", $breed, $age, $desc, $imageName, $id);
    } else {
        $stmt = $conn->prepare("UPDATE cats SET breed=?, age=?, description=? WHERE id=?");
        $stmt->bind_param("sisi", $breed, $age, $desc, $id);
    }
} else {
    // Insert
    $stmt = $conn->prepare("INSERT INTO cats (breed, age, description, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $breed, $age, $desc, $imageName);
}

if ($stmt->execute()) {
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $isEditing ? "Edit Cat" : "Add New Cat" ?></title>
    <style>
        /* Same styles as before... */
    </style>
</head>
<body>

<div class="form-container">
    <h2><?= $isEditing ? "Edit Cat Information" : "Add New Cat" ?></h2>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="text" name="breed" value="<?= htmlspecialchars($breed) ?>" placeholder="Cat Breed" required>
        <input type="number" name="age" value="<?= htmlspecialchars($age) ?>" placeholder="Age" required>
        <textarea name="description" placeholder="Description" required><?= htmlspecialchars($desc) ?></textarea>
        
        <input type="file" name="image" accept="image/*" <?= $isEditing ? '' : 'required' ?>>

        <?php if ($isEditing && $image): ?>
            <p>Current Image:</p>
            <img src="/uploads/) ?>" alt="Cat Image" width="150">
        <?php endif; ?>

        <button type="submit"><?= $isEditing ? "Update Cat" : "Add Cat" ?></button>
    </form>
</div>

</body>
</html>
