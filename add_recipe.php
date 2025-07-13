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
    <title>Add Recipe</title>
    <script src="https://cdn.tailwindcss.com"></script>
     <style>
    body {
      background: url('samosas.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    .bg-overlay {
      background-color: rgba(255, 255, 255, 0.9);
      min-height: 100vh;
    }
  </style>
    <script>
        let ingredients = <?php echo json_encode($ingredients); ?>;

        function showSuggestions() {
            const input = document.getElementById('ingredientInput').value.toLowerCase();
            const suggestions = document.getElementById('suggestions');
            suggestions.innerHTML = '';
            if (input === '') {
                suggestions.classList.add('hidden');
                return;
            }

            const matches = ingredients.filter(ing => ing.name.toLowerCase().includes(input));
            matches.forEach(ing => {
                const div = document.createElement('div');
                div.textContent = ing.name;
                div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                div.onclick = () => selectIngredient(ing.id, ing.name);
                suggestions.appendChild(div);
            });
            suggestions.classList.remove('hidden');
        }

        function selectIngredient(id, name) {
            const list = document.getElementById('selectedList');
            const li = document.createElement('li');
            li.textContent = name;

            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'ingredient_ids[]';
            hidden.value = id;
            li.appendChild(hidden);

            list.appendChild(li);

            document.getElementById('ingredientInput').value = '';
            document.getElementById('suggestions').innerHTML = '';
            document.getElementById('suggestions').classList.add('hidden');
        }
    </script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-red-700 mb-4">Add a Recipe</h2>
    <form action="process_add_recipe.php" method="POST" enctype="multipart/form-data">
        <label class="block font-medium">Title:</label>
        <input type="text" name="title" class="w-full border p-2 mb-4 rounded" required>

        <label class="block font-medium">Description:</label>
        <textarea name="description" class="w-full border p-2 mb-4 rounded" required></textarea>

        <input type="hidden" name="chef_id" value="1">

        <label class="block font-medium">Cooking Time:</label>
        <input type="text" name="cooking_time" class="w-full border p-2 mb-4 rounded" required>

        <label class="block font-medium">Instructions:</label>
        <textarea name="instructions" class="w-full border p-2 mb-4 rounded" required></textarea>

        <label class="block font-medium">Upload Image:</label>
        <input type="file" name="image" accept="image/*" class="w-full border p-2 mb-4 rounded">

        <label class="block font-medium">Add Ingredients:</label>
        <input type="text" id="ingredientInput" oninput="showSuggestions()" class="w-full border p-2 mb-1 rounded" placeholder="Type ingredient name...">
        <div id="suggestions" class="border bg-white max-h-40 overflow-y-auto hidden rounded mb-2"></div>

        <ol id="selectedList" class="list-decimal pl-5 text-gray-700 mb-4"></ol>

        <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800">Submit Recipe</button>
    </form>
</div>
</body>
</html>
