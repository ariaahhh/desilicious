<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Raleway:wght@400;700&display=swap" rel="stylesheet"/>
    <title>Smart Search</title>
    <style>
      body {
        font-family: "Raleway", sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 30px;
        background-image: url("smartsearch.jpg");
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        background-color: rgba(255, 255, 255, 0.8);
        background-blend-mode: lighten;
      }
      .container {
        max-width: 900px;
        margin: auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      }
      h1 {
        text-align: center;
        font-family: "Pacifico", cursive;
        margin-bottom: 30px;
        color: #e63946;
        font-size: 40px;
        margin-top: 30px;
      }
      .form label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
        font-size: 18px;
        color: #333;
      }
      .checkbox-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 12px;
        margin-top: 15px;
      }
      .checkbox-grid input {
        margin-right: 8px;
      }
      button {
        margin-top: 25px;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #cc0000;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
      }
      button:hover {
        background-color: #990000;
      }
      hr {
        margin: 15px 0;
        border: 0.5px solid #ccc;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>SMART SEARCH</h1>
      <p
        style="
          text-align: center;
          font-size: 18px;
          color: #333;
          font-style: italic;
          margin-top: -20px;
        "
      >
        Choose your ingredients and we'll find you a delicious recipe! 
      </p>
      <hr>
      <div class="form">
        <form action="fetch_recipes.php" method="post" id="searchform">
          <label style="color: #e63946;">VEGETABLES</label>
          <hr />
          <div class="checkbox-grid">
            <label><input type="checkbox" name="ingredients[]" value="6"/>Ash Gourd</label>
            <label><input type="checkbox" name="ingredients[]" value="2"/>Beans</label>
            <label><input type="checkbox" name="ingredients[]" value="3"/>Brinjal</label>
            <label><input type="checkbox" name="ingredients[]" value="4"/>Beetroot</label>
            <label><input type="checkbox" name="ingredients[]" value="5"/>Bottle Gourd</label>
            <label><input type="checkbox" name="ingredients[]" value="6"/>Broccoli</label>
            <label><input type="checkbox" name="ingredients[]" value="7"/>Carrot</label>
            <label><input type="checkbox" name="ingredients[]" value="8"/>Cabbage</label>
            <label><input type="checkbox" name="ingredients[]" value="9"/>Cauliflower</label>
            <label><input type="checkbox" name="ingredients[]" value="10"/>Capsicum</label>
            <label><input type="checkbox" name="ingredients[]" value="11"/>Curry Leaves</label>
            <label><input type="checkbox" name="ingredients[]" value="12"/>Cucumber</label>
            <label><input type="checkbox" name="ingredients[]" value="13"/>Coriander</label>
            <label><input type="checkbox" name="ingredients[]" value="14"/>Drumstick</label>
            <label><input type="checkbox" name="ingredients[]" value="15"/>Elephant Yam</label>
            <label><input type="checkbox" name="ingredients[]" value="16"/>Garlic</label>
            <label><input type="checkbox" name="ingredients[]" value="17"/>Ginger</label>
            <label><input type="checkbox" name="ingredients[]" value="18"/>Ivy Gourd</label>
            <label><input type="checkbox" name="ingredients[]" value="19"/>Green Chilli</label>
            <label><input type="checkbox" name="ingredients[]" value="20"/>Lady Finger</label>
            <label><input type="checkbox" name="ingredients[]" value="21"/>Mint</label>
            <label><input type="checkbox" name="ingredients[]" value="22"/>Mushroom</label>
            <label><input type="checkbox" name="ingredients[]" value="23"/>Onion</label>
            <label><input type="checkbox" name="ingredients[]" value="24"/>Plantain</label>
            <label><input type="checkbox" name="ingredients[]" value="25"/>Potato</label>
            <label><input type="checkbox" name="ingredients[]" value="26"/>Pumpkin</label>
            <label><input type="checkbox" name="ingredients[]" value="27"/>Radish</label>
            <label><input type="checkbox" name="ingredients[]" value="28"/>Ridge Gourd</label>
            <label><input type="checkbox" name="ingredients[]" value="29"/>Snake Gourd</label>
            <label><input type="checkbox" name="ingredients[]" value="30"/>Spinach</label>
            <label><input type="checkbox" name="ingredients[]" value="31"/>Spring Onion</label>
            <label><input type="checkbox" name="ingredients[]" value="32"/>Sweet Potato</label>
            <label><input type="checkbox" name="ingredients[]" value="33"/>Soya Bean</label>
            <label><input type="checkbox" name="ingredients[]" value="34"/>Tomato</label>
            <label><input type="checkbox" name="ingredients[]" value="35"/>Tamarind</label>
            <label><input type="checkbox" name="ingredients[]" value="36"/>Turnip</label>
            <label><input type="checkbox" name="ingredients[]" value="37"/>Vaal Beans</label>
            <label><input type="checkbox" name="ingredients[]" value="38"/>Yam</label>
          </div><hr>
          <label style="color: #e63946;">FRUITS</label>
          <hr>
          <div class="checkbox-grid">
           <label><input type="checkbox" name="ingredients[]" value="44"/>Apple</label>
           <label><input type="checkbox" name="ingredients[]" value="40"/>Avocado</label>
           <label><input type="checkbox" name="ingredients[]" value="41"/>Banana</label>
           <label><input type="checkbox" name="ingredients[]" value="42"/>Blueberry</label>
           <label><input type="checkbox" name="ingredients[]" value="43"/>Blackberry</label>
           <label><input type="checkbox" name="ingredients[]" value="44"/>Coconut</label>
           <label><input type="checkbox" name="ingredients[]" value="45"/>Coco</label>
           <label><input type="checkbox" name="ingredients[]" value="46"/>Chiku</label>
           <label><input type="checkbox" name="ingredients[]" value="47"/>Dragon Fruit</label>
           <label><input type="checkbox" name="ingredients[]" value="48"/>Fig</label>
           <label><input type="checkbox" name="ingredients[]" value="49"/>Grapes</label>
           <label><input type="checkbox" name="ingredients[]" value="50"/>Guava</label>
           <label><input type="checkbox" name="ingredients[]" value="51"/>Gooseberry</label>
           <label><input type="checkbox" name="ingredients[]" value="52"/>Jackfruit</label>
           <label><input type="checkbox" name="ingredients[]" value="53"/>Kiwi</label>
           <label><input type="checkbox" name="ingredients[]" value="54"/>Lime</label>
           <label><input type="checkbox" name="ingredients[]" value="55"/>Litchi</label>
           <label><input type="checkbox" name="ingredients[]" value="56"/>Mango</label>
           <label><input type="checkbox" name="ingredients[]" value="57"/>Muskmelon</label>
           <label><input type="checkbox" name="ingredients[]" value="58"/>Orange</label>
           <label><input type="checkbox" name="ingredients[]" value="59"/>Papaya</label>
           <label><input type="checkbox" name="ingredients[]" value="60"/>Peach</label>
           <label><input type="checkbox" name="ingredients[]" value="61"/>Pineapple</label>
           <label><input type="checkbox" name="ingredients[]" value="62"/>Pear</label>
           <label><input type="checkbox" name="ingredients[]" value="63"/>Passion fruit</label>
           <label><input type="checkbox" name="ingredients[]" value="64"/>Plum</label>
           <label><input type="checkbox" name="ingredients[]" value="65"/>Pomogranate</label>
           <label><input type="checkbox" name="ingredients[]" value="66"/>Rambutan</label>
           <label><input type="checkbox" name="ingredients[]" value="67"/>Raspberry</label>
           <label><input type="checkbox" name="ingredients[]" value="68"/>Strawberry</label>
           <label><input type="checkbox" name="ingredients[]" value="69"/>Tangerine</label>
           <label><input type="checkbox" name="ingredients[]" value="70"/>Tender Coconut</label>
           <label><input type="checkbox" name="ingredients[]" value="71"/>Waterrmelon</label>
          </div>
         <hr>
  <label style="color: #e63946;">SPICES & CONDIMENTS</label><hr>
   <div class="checkbox-grid">
  <label><input type="checkbox" name="ingredients[]" value="77">Allspice</label>
  <label><input type="checkbox" name="ingredients[]" value="78">Asafoetida</label>
  <label><input type="checkbox" name="ingredients[]" value="74">Bay Leaf</label>
  <label><input type="checkbox" name="ingredients[]" value="75">Black Cardamom</label>
  <label><input type="checkbox" name="ingredients[]" value="76">Black Pepper</label>
  <label><input type="checkbox" name="ingredients[]" value="77">Black Salt</label>
  <label><input type="checkbox" name="ingredients[]" value="78">Caraway Seeds</label>
  <label><input type="checkbox" name="ingredients[]" value="79">Cardamom</label>
  <label><input type="checkbox" name="ingredients[]" value="80">Chaat Masala</label>
  <label><input type="checkbox" name="ingredients[]" value="81">Chili Flakes</label>
  <label><input type="checkbox" name="ingredients[]" value="82">Cinnamon</label>
  <label><input type="checkbox" name="ingredients[]" value="83">Clove</label>
  <label><input type="checkbox" name="ingredients[]" value="84">Coriander Powder</label>
  <label><input type="checkbox" name="ingredients[]" value="85">Coriander Seeds</label>
  <label><input type="checkbox" name="ingredients[]" value="86">Cumin Powder</label>
  <label><input type="checkbox" name="ingredients[]" value="87">Cumin Seeds</label>
  <label><input type="checkbox" name="ingredients[]" value="88">Curry Powder</label>
  <label><input type="checkbox" name="ingredients[]" value="89">Dried Fenugreek Leaves</label>
  <label><input type="checkbox" name="ingredients[]" value="90">Dry Ginger Powder</label>
  <label><input type="checkbox" name="ingredients[]" value="91">Fennel Seeds</label>
  <label><input type="checkbox" name="ingredients[]" value="92">Fenugreek Seeds</label>
  <label><input type="checkbox" name="ingredients[]" value="93">Garam Masala</label>
  <label><input type="checkbox" name="ingredients[]" value="94">Garlic Paste</label>
  <label><input type="checkbox" name="ingredients[]" value="95">Ginger Paste</label>
  <label><input type="checkbox" name="ingredients[]" value="96">Green Cardamom</label>
  <label><input type="checkbox" name="ingredients[]" value="97">Mustard Powder</label>
  <label><input type="checkbox" name="ingredients[]" value="98">Mustard Seeds</label>
  <label><input type="checkbox" name="ingredients[]" value="99">Nutmeg</label>
  <label><input type="checkbox" name="ingredients[]" value="100">Onion Powder</label>
  <label><input type="checkbox" name="ingredients[]" value="101">Mixed Five-Spice</label>
  <label><input type="checkbox" name="ingredients[]" value="102">Red Chili Powder</label>
  <label><input type="checkbox" name="ingredients[]" value="103">Rock Salt</label>
  <label><input type="checkbox" name="ingredients[]" value="104">Saffron</label>
  <label><input type="checkbox" name="ingredients[]" value="105">Salt</label>
  <label><input type="checkbox" name="ingredients[]" value="106">Sesame Seeds</label>
  <label><input type="checkbox" name="ingredients[]" value="107">Star Anise</label>
  <label><input type="checkbox" name="ingredients[]" value="108">Tamarind Paste</label>
  <label><input type="checkbox" name="ingredients[]" value="109">Tandoori Masala</label>
  <label><input type="checkbox" name="ingredients[]" value="110">Turmeric Powder</label>
  <label><input type="checkbox" name="ingredients[]" value="111">White Pepper</label>
</div>



<hr>

  <label style="color: #e63946;">DAIRY PRODUCTS</label><hr>
  <div class="checkbox-grid">
  <label><input type="checkbox" name="ingredients[]" value="112">Butter</label>
  <label><input type="checkbox" name="ingredients[]" value="113">Buttermilk</label>
  <label><input type="checkbox" name="ingredients[]" value="119"> All type of Cheese</label>
  <label><input type="checkbox" name="ingredients[]" value="115">Condensed Milk</label>
  <label><input type="checkbox" name="ingredients[]" value="116">Cream</label>
  <label><input type="checkbox" name="ingredients[]" value="117">Curd</label>
  <label><input type="checkbox" name="ingredients[]" value="118">Evaporated Milk</label>
  <label><input type="checkbox" name="ingredients[]" value="119">Ghee</label>
  <label><input type="checkbox" name="ingredients[]" value="120">Milk</label>
  <label><input type="checkbox" name="ingredients[]" value="121">Paneer</label>
  <label><input type="checkbox" name="ingredients[]" value="122">Powdered Milk</label>
  <label><input type="checkbox" name="ingredients[]" value="123">Cottage Cheese</label>
  <label><input type="checkbox" name="ingredients[]" value="124">Cream Cheese</label>
  <label><input type="checkbox" name="ingredients[]" value="125"> Greek Yogurt</label>
  <label><input type="checkbox" name="ingredients[]" value="126">Ice cream</label>
</div>
<hr>
<label style="color: #e63946;">GRAINS & PULSES</label><hr>
<div class="checkbox-grid">
  <label><input type="checkbox" name="ingredients[]" value="127">Barley</label>
  <label><input type="checkbox" name="ingredients[]" value="128">Black Gram</label>
  <label><input type="checkbox" name="ingredients[]" value="129">Bulgur</label>
  <label><input type="checkbox" name="ingredients[]" value="130">Chickpeas</label>
  <label><input type="checkbox" name="ingredients[]" value="131">Green Gram</label>
  <label><input type="checkbox" name="ingredients[]" value="132">Kidney Beans</label>
  <label><input type="checkbox" name="ingredients[]" value="133">Lentils</label>
  <label><input type="checkbox" name="ingredients[]" value="134">Millet</label>
  <label><input type="checkbox" name="ingredients[]" value="135">Oats</label>
  <label><input type="checkbox" name="ingredients[]" value="136">Quinoa</label>
  <label><input type="checkbox" name="ingredients[]" value="137">Rajma</label>
  <label><input type="checkbox" name="ingredients[]" value="138">Red Lentils</label>
  <label><input type="checkbox" name="ingredients[]" value="139">Rice</label>
  <label><input type="checkbox" name="ingredients[]" value="140">Sago</label>
  <label><input type="checkbox" name="ingredients[]" value="141">Semolina/Rava</label>
  <label><input type="checkbox" name="ingredients[]" value="142">Sorghum</label>
  <label><input type="checkbox" name="ingredients[]" value="143">Soybeans</label>
  <label><input type="checkbox" name="ingredients[]" value="144">Split Peas</label>
  <label><input type="checkbox" name="ingredients[]" value="145">Wheat</label>
  <label><input type="checkbox" name="ingredients[]" value="146">White Urad Dal</label>
</div>
<hr>
  <label style="color: #e63946;">HERBS & GREENS</label><hr>
  <div class="checkbox-grid">
  <label><input type="checkbox" name="ingredients[]" value="147">Basil/Thulasi</label>
  <label><input type="checkbox" name="ingredients[]" value="148">Bay Leaves</label>
  <label><input type="checkbox" name="ingredients[]" value="149">Celery Leaves</label>
  <label><input type="checkbox" name="ingredients[]" value="150">Coriander Leaves</label>
  <label><input type="checkbox" name="ingredients[]" value="151">Curry Leaves</label>
  <label><input type="checkbox" name="ingredients[]" value="152">Dill Leaves</label>
  <label><input type="checkbox" name="ingredients[]" value="153">Fenugreek Leaves (Fresh)</label>
  <label><input type="checkbox" name="ingredients[]" value="154">Lettuce</label>
  <label><input type="checkbox" name="ingredients[]" value="155">Mint Leaves</label>
  <label><input type="checkbox" name="ingredients[]" value="156">Parsley</label>
  <label><input type="checkbox" name="ingredients[]" value="157">Spinach</label>
</div>

<hr>
<label style="color: #e63946;">RICES</label><hr>
<div class="checkbox-grid">
  <label><input type="checkbox" name="ingredients[]" value="158">Basmati</label>
  <label><input type="checkbox" name="ingredients[]" value="158">Gobindobhog</label>
   <label><input type="checkbox" name="ingredients[]" value="159 ">Indrayani </label>
   <label><input type="checkbox" name="ingredients[]" value="160">Joha Rice</label>
   <label><input type="checkbox" name="ingredients[]" value=" 161"> Kaima</label>
   <label><input type="checkbox" name="ingredients[]" value="162 ">Kalijira </label>
   <label><input type="checkbox" name="ingredients[]" value="163">Matta</label>
   <label><input type="checkbox" name="ingredients[]" value="164">Parboiled Rice</label>
   <label><input type="checkbox" name="ingredients[]" value="165">Ponni</label>
   <label><input type="checkbox" name="ingredients[]" value="166">Sharbati</label>
   <label><input type="checkbox" name="ingredients[]" value="167">Sona Masoori</label>
  <label><input type="checkbox" name="ingredients[]" value="168">Tulsi Rice</label>
</div>

<hr>
<label style="color: #e63946;">OILS & FATS</label><hr>
<div class="checkbox-grid">
  <label><input type="checkbox" name="ingredients[]" value="175">Almond Oil</label>
  <label><input type="checkbox" name="ingredients[]" value="170">Avocado Oil</label>
   <label><input type="checkbox" name="ingredients[]" value="171 ">Coconut Oil </label>
   <label><input type="checkbox" name="ingredients[]" value="172">Mustard Oil</label>
   <label><input type="checkbox" name="ingredients[]" value="173"> Olive Oil</label>
   <label><input type="checkbox" name="ingredients[]" value="174">Palm Oil </label>
   <label><input type="checkbox" name="ingredients[]" value="175">Peanut Oil</label>
   <label><input type="checkbox" name="ingredients[]" value="176">Sesame Oil</label>
   <label><input type="checkbox" name="ingredients[]" value="177">Sunflower Oil</label>
   <label><input type="checkbox" name="ingredients[]" value="178">Vegetable Oil </label>
   <label><input type="checkbox" name="ingredients[]" value="179">Walnut Oil</label>
  <label><input type="checkbox" name="ingredients[]" value="180">Flaxseed Oil</label>
</div>

<hr>
<label style="color: #e63946;">FLOURS</label><hr>
<div class="checkbox-grid">
  <label><input type="checkbox" name="ingredients[]" value="187">All purpose flour</label>
  <label><input type="checkbox" name="ingredients[]" value="182">Maida</label>
   <label><input type="checkbox" name="ingredients[]" value="189">Arrowroot flour </label>
   <label><input type="checkbox" name="ingredients[]" value="184 ">Atta </label>
   <label><input type="checkbox" name="ingredients[]" value="184"> Banana flour</label>
   <label><input type="checkbox" name="ingredients[]" value="185 ">Bean flour </label>
   <label><input type="checkbox" name="ingredients[]" value="186 ">Besan </label>
   <label><input type="checkbox" name="ingredients[]" value="187">Buckwheat flour</label>
   <label><input type="checkbox" name="ingredients[]" value="188">Chestnut flour</label>
   <label><input type="checkbox" name="ingredients[]" value="189">Chickpea flour </label>
   <label><input type="checkbox" name="ingredients[]" value="190">Coconut flour</label>
  <label><input type="checkbox" name="ingredients[]" value="191">Corn flour</label>
  <label><input type="checkbox" name="ingredients[]" value="192">Graham flour</label>
   <label><input type="checkbox" name="ingredients[]" value="193">Millet flour</label>
   <label><input type="checkbox" name="ingredients[]" value="194">Oat flour</label>
   <label><input type="checkbox" name="ingredients[]" value="195">Rice flour</label>
   <label><input type="checkbox" name="ingredients[]" value="196 ">Ragi </label>
   <label><input type="checkbox" name="ingredients[]" value="197">Semolina flour</label>
   <label><input type="checkbox" name="ingredients[]" value="198">Sorghum flour</label>
   <label><input type="checkbox" name="ingredients[]" value="199">Tapioca flour</label>
   <label><input type="checkbox" name="ingredients[]" value="200">Wheat all-purpose flours</label>
</div>
 <br>
  <button type="submit" id="search-btn">Find Recipes</button>
 </form>
     <div class="results" id="resultsContainer">
</div>

<script>
document.getElementById("searchForm").addEventListener("submit", function(e) {
  e.preventDefault();
  
  const formData = new FormData(this);
  
  fetch("fetch_recipes.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    document.getElementById("resultsContainer").innerHTML = data;
  })
  .catch(err => console.error("Error:", err));
});
</script>

</body>
</html>

