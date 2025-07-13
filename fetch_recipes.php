<?php
include 'db_connect.php';

if (!isset($_POST['ingredients'])) {
  echo "Please select at least one ingredient.";
  exit;
}

$ingredient_ids = $_POST['ingredients'];

if (count($ingredient_ids) === 0) {
  echo "No ingredients selected.";
  exit;
}

// Convert to int for safety
$ingredient_ids = array_map('intval', $ingredient_ids);
$placeholders = implode(',', array_fill(0, count($ingredient_ids), '?'));

// Find recipes that match ALL selected ingredients
$sql = "
  SELECT r.*
  FROM recipes r
  JOIN recipe_ingredients ri ON r.id = ri.recipe_id
  WHERE ri.ingredient_id IN ($placeholders)
  GROUP BY r.id
  HAVING COUNT(DISTINCT ri.ingredient_id) = ?
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
  echo "SQL error: " . $conn->error;
  exit;
}

$params = array_merge($ingredient_ids, [count($ingredient_ids)]);
$types = str_repeat('i', count($params));
$stmt->bind_param($types, ...$params);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  echo "No recipes found with the selected ingredients.";
} else {
  while ($row = $result->fetch_assoc()) {
    echo "<div class='recipe'>";
    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' width='200'>";
    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
    echo "</div>";
  }
}
?>
