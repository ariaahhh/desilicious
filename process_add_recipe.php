<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $cooking_time = $_POST['cooking_time'] ?? '';
    $instructions = $_POST['instructions'] ?? '';
    $chef_id = $_POST['chef_id'] ?? null;
    $ingredient_ids = $_POST['ingredient_ids'] ?? [];

    // Handle image
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $img_name = basename($_FILES['image']['name']);
        $target = "uploads/" . $img_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image = $target;
        }
    }

    // Insert recipe
    $stmt = $conn->prepare("INSERT INTO recipes (title, description, image, chef_id, instructions, cooking_time) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $title, $description, $image, $chef_id, $instructions, $cooking_time);
    $stmt->execute();
    $recipe_id = $stmt->insert_id;
    $stmt->close();

    // Insert into recipe_ingredients
    if (!empty($ingredient_ids)) {
        $stmt_link = $conn->prepare("INSERT INTO recipe_ingredients (recipe_id, ingredient_id) VALUES (?, ?)");
        foreach ($ingredient_ids as $ing_id) {
            $stmt_link->bind_param("ii", $recipe_id, $ing_id);
            $stmt_link->execute();
        }
        $stmt_link->close();
    }

    $conn->close();
    echo "✅ Recipe added successfully!";
} else {
    echo "❌ Invalid request.";
}
