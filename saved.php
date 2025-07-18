<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Saved Recipes – DelishShare</title>
  <link rel="stylesheet" href="saved style.css"/>
</head>
<body>
  <header>
    <div class="container">
      <h1 style="text-decoration: underline;"> My Saved Recipes</h1>
      <p style="font-family: cursive;">Your handpicked delicious dishes!</p>
    </div>
  </header>

  <main class="container">
    <h2>Saved Recipes</h2>
    <div class="recipe-grid" id="saved-recipes">
      <!-- Recipes will be injected here by JS -->
    </div>
  </main>

  <footer>
    <p>© 2025 Desilicious. Made with love for food lovers.</p>
  </footer>

  <script>
    const allRecipes = [
      {
        id: "1",
        title: "Classic Italian Pasta",
        image: "https://source.unsplash.com/400x300/?pasta",
        description: "A traditional pasta recipe with rich tomato sauce and herbs."
      },
      {
        id: "2",
        title: "Fresh Garden Salad",
        image: "https://source.unsplash.com/400x300/?salad",
        description: "Crisp lettuce, juicy tomatoes, and a light vinaigrette."
      },
      {
        id: "3",
        title: "Chocolate Lava Cake",
        image: "https://source.unsplash.com/400x300/?dessert",
        description: "Warm and gooey chocolate cake with a molten center."
      }
    ];

    // Load saved recipe IDs
    const savedIds = JSON.parse(localStorage.getItem('savedRecipes')) || [];
    const savedContainer = document.getElementById('saved-recipes');

    if (savedIds.length === 0) {
      savedContainer.innerHTML = "<p>You haven't saved any recipes yet.</p>";
    } else {
      const savedRecipes = allRecipes.filter(recipe => savedIds.includes(recipe.id));

      savedRecipes.forEach(recipe => {
        const card = document.createElement('div');
        card.className = 'recipe-card';
        card.innerHTML = `
          <img src="${recipe.image}" alt="${recipe.title}">
          <h3>${recipe.title}</h3>
          <p>${recipe.description}</p>
        `;
        savedContainer.appendChild(card);
      });
    }
  </script>
</body>
</html>