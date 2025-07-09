<?php
include 'db_connect.php';
$result = $conn->query("SELECT * FROM ingredients ORDER BY name ASC");
$ingredients = [];
while ($row = $result->fetch_assoc()) {
    $ingredients[] = ['id' => $row['id'], 'name' => $row['name']];
}
?>
<!DOCTYPE html>
<html>
<head>
  <style>
  body {
    background: url('samosas.jpg') no-repeat center center fixed;
    background-size: cover;
  }

  .bg-overlay {
    background-color: rgba(255, 255, 255, 0.85); /* Semi-transparent white */
    min-height: 100vh;
  }
</style>

  <title>Add Recipe</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    let ingredients = <?= json_encode($ingredients); ?>;

    function showSuggestions() {
      const input = document.getElementById('ingredientInput').value.toLowerCase();
      const suggestions = document.getElementById('suggestions');
      suggestions.innerHTML = "";

      ingredients.forEach(ingredient => {
        if (ingredient.name.toLowerCase().includes(input)) {
          const option = document.createElement("div");
          option.className = "cursor-pointer p-2 hover:bg-gray-200";
          option.textContent = ingredient.name;
          option.onclick = () => addIngredient(ingredient.name);
          suggestions.appendChild(option);
        }
      });

      suggestions.style.display = input ? "block" : "none";
    }

    function addIngredient(name) {
      const list = document.getElementById("selectedList");
      const existingItems = [...list.querySelectorAll("li")].map(li => li.textContent.trim());
      if (existingItems.includes(name)) return;

      const li = document.createElement("li");
      li.className = "flex justify-between items-center mb-1";
      li.innerHTML = name +
        `<input type="hidden" name="ingredients[]" value="${name}">
         <button type="button" onclick="this.parentElement.remove()" class="ml-2 text-red-600 hover:text-red-800">&times;</button>`;
      list.appendChild(li);

      document.getElementById('ingredientInput').value = "";
      document.getElementById('suggestions').style.display = "none";
    }
  </script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-2xl mx-auto bg-white shadow-md p-6 rounded">
    <h1 class="text-2xl font-bold text-red-700 mb-4">Add Recipe</h1>
    <form action="process_add_recipe.php" method="POST" enctype="multipart/form-data">
     <label class="block font-medium">Title:</label>
<input type="text" name="title" class="w-full border p-2 mb-4 rounded" required>

<label class="block font-medium">Description:</label>
<textarea name="description" rows="3" class="w-full border p-2 mb-4 rounded" required></textarea>

      <label class="block font-medium">Cooking Time:</label>
      <input type="text" name="cooking_time" class="w-full border p-2 mb-4 rounded" placeholder="e.g. 30 minutes" required>

      <label class="block font-medium">Instructions:</label>
      <textarea name="instructions" class="w-full border p-2 mb-4 rounded" required></textarea>

      <label class="block font-medium">Upload Image:</label>
      <input type="file" name="image" accept="image/*" class="w-full border p-2 mb-4 rounded">

      <label class="block font-medium">Add Ingredients:</label>
      <input type="text" id="ingredientInput" oninput="showSuggestions()" class="w-full border p-2 rounded mb-1" placeholder="Type ingredient name...">
      <div id="suggestions" class="border bg-white max-h-40 overflow-y-auto hidden rounded mb-2"></div>

      <ol id="selectedList" class="list-decimal pl-5 text-gray-700 mb-4"></ol>

      <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800">Submit Recipe</button>
    </form>
  </div>
</body>
</html>
