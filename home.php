<?php
include 'db_connect.php';

// Fetch all recipes
$result = $conn->query("SELECT * FROM recipes ORDER BY created_at DESC LIMIT 6");

// Check for errors
if (!$result) {
    die("Error fetching recipes: " . $conn->error);
}
?>

<!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="style.css">
    <title>www.Desilicious.com</title>
    <style>
.latest-recipes {
  padding: 40px;
  text-align: center;
  background-color: #000000ff;
}

.latest-recipes h2 {
  font-size: 2rem;
  margin-bottom: 25px;
  color: #e63946;
}

.recipe-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
}

.recipe-card {
  display: block;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.08);
  overflow: hidden;
  text-decoration: none;
  color: inherit;
  transition: transform 0.3s;
}

.recipe-card:hover {
  transform: translateY(-5px);
}

.recipe-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}

.recipe-content {
  padding: 15px;
  text-align: left;
}

.recipe-content h3 {
  font-size: 1.2rem;
  margin: 0 0 10px;
  color: #333;
}

.recipe-content p {
  font-size: 0.95rem;
  color: #666;
}

.view-more {
  margin-top: 30px;
}

.view-more .btn {
  display: inline-block;
  padding: 10px 20px;
  background: #e63946;
  color: white;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.2s;
}

.view-more .btn:hover {
  background: #d62839;
}

              .categories {
  text-align: center;
  padding: 40px 20px;
}
.category-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  margin-top: 10px;
}
.category-card {
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  transition: transform 0.2s ease;
}
.category-card img {
  width: 100%;
  height: 150px;
  object-fit: cover;
}
.category-card h3 {
  background: #5c5050ff;
  color: white;
  margin: 0;
  padding: 10px;
}
.category-card:hover {
  transform: scale(1.05);
}
      .profile-pic img {
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--text-color);
        transition: transfrom 0.2s ease;
      }

      .nav-links {
        position: absolute;
        top: 15px;
        right: 130px;
        display: flex;
        gap: 10px;
      }
      .nav-links a {
        color: var(--text-color);
        text-decoration: none;
        font-size: 20px;
        padding: 15px 15px;
        border-radius: 16px;
        transition: background-color 0.3s;
      }
      .nav-links a:hover {
        background-color: #082d4b;
      }
      :root {
        --bg-color: #090a0a;
        --text-color: #a1a5a8;
        --caption-color: #c8c8c8;
      }

      body {
        margin: 0;
        background-color: var(--bg-color);
        color: var(--text-color);
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        transition: background-color 0.4s, color 0.4s;
      }

      .home {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        position: relative;
      }

      .branding {
        display: flex;
        flex-direction: column;
        margin-left: 10px;
      }

      .branding a {
        text-decoration: none;
        color: inherit;
      }

      .branding h1 {
        margin: 0;
        font-size: 24px;
      }

      .branding p {
        margin: 0;
        font-size: 14px;
        color: var(--caption-color);
      }

      .home a img {
        height: 80px;
        width: 80px;
      }
      .switch-container {
        position: absolute;
        top: 10px;
        right: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .switch-label {
        font-size: 14px;
        color: var(--text-color);
        padding-top: 15px;
      }

      .switch {
        position: relative;
        display: inline-block;
        width: 52px;
        height: 26px;
      }

      .switch input {
        opacity: 0;
        width: 0;
        height: 0;
      }

      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 26px;
      }

      .slider::before {
        position: absolute;
        content: "🌙";
        height: 22px;
        width: 22px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        border-radius: 50%;
        text-align: center;
        line-height: 22px;
        font-size: 14px;
        transition: 0.4s;
      }

      input:checked + .slider::before {
        transform: translateX(26px);
      }

      input:checked + .slider {
        background-color: #2196f3;
      }
      .light-mode {
        --bg-color: #f0f0f0;
        --text-color: #222;
        --caption-color: #444;
      }
    </style>
  </head>
  <body>
    <div class="home">
      <a href="index.html">
        <img src="logo.png" alt="Desilicious Logo" />
      </a>
      <div class="branding">
        <a href="index.html">
          <h1>Desilicious</h1>
        </a>
        <p>Discover. Cook. Share.</p>
      </div>
      <div class="nav-links">
        <a href="explore.php">Explore</a>
        <a href="Smartsearch.php">Smart Search</a>
        <a href="Saved.php">Saved</a>
        <a href="signup.php">Profile</a>
        </a>
      </div>
      <div class="switch-container">
        <span class="switch-label"></span>
        <label class="switch">
          <input type="checkbox" id="themeToggle" />
          <span class="slider" id="sliderEmoji"></span>
        </label>
      </div>
    </div>
    <div class="hero">
      <div class="hero-content">
        <h1>Unleash the Magic of Indian Cooking with Desilicious</h1>
        <p>
          Explore a treasure trove of authentic, home-style recipes curated for
          every craving—from spicy street snacks to soulful curries. Start your
          flavorful journey today.
        </p>
        <form class="search-bar" action="search.php" method="get">
          <input type="text" name="query" placeholder="Search recipes..." />
          <button type="submit">View Recipes</button>
        </form>
      </div>
    </div>
    <script>
      const toggle = document.getElementById("themeToggle");
      const body = document.body;
      const slider = document.getElementById("sliderEmoji");
      function updateEmoji() {
        slider.style.setProperty("--emoji", toggle.checked ? '"☀️"' : '"🌙"');
        slider.innerText = toggle.checked ? "☀️" : "🌙";
      }
      const savedTheme = localStorage.getItem("theme");
      if (savedTheme === "light") {
        body.classList.add("light-mode");
        toggle.checked = true;
      }
      updateEmoji();
      toggle.addEventListener("change", () => {
        const isLight = toggle.checked;
        body.classList.toggle("light-mode", isLight);
        localStorage.setItem("theme", isLight ? "light" : "dark");
        updateEmoji();
      });
    </script>
   <section class="categories">
  <h2>EXPLORE CATEGORIES</h2>
  <div class="category-grid">
    <div class="category-card">
      <img src="break.jpg" alt="Breakfast">
      <h3>Breakfast</h3>
    </div>
     <div class="category-card">
      <img src="lunch3.jpg" alt="Lunch">
      <h3>Lunch</h3>
    </div>
     <div class="category-card">
      <img src="dinner.jpg" alt="dinner">
      <h3>Dinner</h3>
    </div>
    <div class="category-card">
      <img src="dess.png" alt="Desserts">
      <h3>Desserts</h3>
    </div>
    <div class="category-card">
      <img src="drink.webp" alt="Drinks">
      <h3>Drinks</h3>
    </div>
    <div class="category-card">
      <img src="snack.webp" alt="Snacks">
      <h3>Snacks</h3>
    </div>
   
  </div>
</section>
<section class="latest-recipes">
  <h2>Latest Recipes</h2>
  <div class="recipe-grid">
    <?php while ($row = $result->fetch_assoc()): ?>
      <a href="recipe_detail.php?id=<?= $row['id'] ?>" class="recipe-card">
        <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
        <div class="recipe-content">
          <h3><?= htmlspecialchars($row['title']) ?></h3>
          <p><?= substr(htmlspecialchars($row['description']), 0, 80) ?>...</p>
        </div>
      </a>
    <?php endwhile; ?>
  </div>

  <div class="view-more">
    <a href="explore.php" class="btn">View More Recipes</a>
  </div>
</section>


</body>
</html>

  </body>
</html>