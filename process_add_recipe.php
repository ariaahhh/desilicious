<?php
include 'db_connect.php';

// Sanitize input
$title = mysqli_real_escape_string($conn, $_POST['title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$cooking_time = mysqli_real_escape_string($conn, $_POST['cooking_time']);
$instructions = mysqli_real_escape_string($conn, $_POST['instructions']);

// Optional: handle chef_id (set to null if not provided)
$chef_id = isset($_POST['chef_id']) ? (int) $_POST['chef_id'] : null;

// Handle image upload
$imagePath = "";
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageTmpPath = $_FILES['image']['tmp_name'];
    $imageName = basename($_FILES['image']['name']);
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $imagePath = $uploadDir . time() . '_' . $imageName;
    move_uploaded_file($imageTmpPath, $imagePath);
}

// Insert recipe
$stmt = $conn->prepare("INSERT INTO recipes (title, description, cooking_time, instructions, chef_id, image) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed for recipe insert: " . $conn->error);
}
$stmt->bind_param("ssssis", $title, $description, $cooking_time, $instructions, $chef_id, $imagePath);
$stmt->execute();
$recipe_id = $stmt->insert_id;
$stmt->close();

// Insert ingredients
if (isset($_POST['ingredients']) && is_array($_POST['ingredients'])) {
    foreach ($_POST['ingredients'] as $ingredientName) {
        $ingredientName = trim($ingredientName);

        // Check if ingredient exists
        $stmt = $conn->prepare("SELECT id FROM ingredients WHERE name = ?");
        if (!$stmt) {
            die("Prepare failed for ingredient SELECT: " . $conn->error);
        }
        $stmt->bind_param("s", $ingredientName);
        $stmt->execute();
        $stmt->bind_result($ingredient_id);
        
        if ($stmt->fetch()) {
            $stmt->close();
        } else {
            $stmt->close();

            // Insert new ingredient
            $insertIngStmt = $conn->prepare("INSERT INTO ingredients (name) VALUES (?)");
            if (!$insertIngStmt) {
                die("Prepare failed for ingredient INSERT: " . $conn->error);
            }
            $insertIngStmt->bind_param("s", $ingredientName);
            $insertIngStmt->execute();
            $ingredient_id = $insertIngStmt->insert_id;
            $insertIngStmt->close();
        }

        // Link ingredient to recipe
        if (!empty($ingredient_id)) {
            $linkStmt = $conn->prepare("INSERT INTO recipe_ingredients (recipe_id, ingredient_id) VALUES (?, ?)");
            if (!$linkStmt) {
                die("Prepare failed for recipe_ingredients: " . $conn->error);
            }
            $linkStmt->bind_param("ii", $recipe_id, $ingredient_id);
            $linkStmt->execute();
            $linkStmt->close();
        }
    }
}

$conn->close();

echo "<script>alert('Recipe added successfully with ingredients!'); window.location.href='add_recipe.php';</script>";
?>
