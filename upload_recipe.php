<?php
include 'db_connect.php'; // connect to your recipewebsite DB

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $cooking_time = $_POST['cooking_time'];
    $chef_id = $_SESSION['chef_id']; // or however you store logged-in chef

    // IMAGE UPLOAD
    $imagePath = "";
    if ($_FILES['image']['name']) {
        $imageName = uniqid() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
        $imagePath = "uploads/" . $imageName;
    }

    // 1. Insert into recipes table
    $stmt = $conn->prepare("INSERT INTO recipes (chef_id, name, description, image, cooking_time, category) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $chef_id, $name, $description, $imagePath, $cooking_time, $category);
    $stmt->execute();
    $recipe_id = $stmt->insert_id;

    // 2. Loop through ingredients
    $ingredient_names = $_POST['ingredient_names'];
    $quantities = $_POST['quantities'];

    for ($i = 0; $i < count($ingredient_names); $i++) {
        $iname = trim($ingredient_names[$i]);
        $qty = trim($quantities[$i]);

        if ($iname == "" || $qty == "") continue;

        // Check if ingredient exists
        $res = $conn->prepare("SELECT id FROM ingredients WHERE name = ?");
        $res->bind_param("s", $iname);
        $res->execute();
        $res->store_result();
        $res->bind_result($ing_id);

        if ($res->num_rows > 0) {
            $res->fetch();
        } else {
            // Insert new ingredient
            $ins = $conn->prepare("INSERT INTO ingredients (name) VALUES (?)");
            $ins->bind_param("s", $iname);
            $ins->execute();
            $ing_id = $ins->insert_id;
        }

        // Insert into recipe_ingredients
        $stmt2 = $conn->prepare("INSERT INTO recipe_ingredients (recipe_id, ingredient_id, quantity) VALUES (?, ?, ?)");
        $stmt2->bind_param("iis", $recipe_id, $ing_id, $qty);
        $stmt2->execute();
    }

    echo "Recipe added successfully!";
}
?>
