<?php

$data = [
    'Yes' => 'Bar, KTV, alcohol store',
    'No' => 'Boba, Juice bar, Tea',
    
    'European' => 'French, English, Swedish, Ukranian',
    'Asian' => 'Chinese, Korean, Indian, Japanese',
    'Middle East' => 'Turkish, Yemenesem Irqi, Syrian',
    'American' => 'United State, Cuba, Brazil, Mexico',
    
    'History' => 'Roman, Dinosaur, American, World',
    'Chilling' => 'Beach, Theater, water park, Spa, Juice bar, Dave and buster, Thriller park, Movie, Trampoline park',
    'Extreme Sport' => 'Skydiving, skiing, Snow boarding, racing',
    'Recreational' => 'Dave and buster, Thriller park, Movie, Trampoline park',
    
    'Wearable items' => 'Clothes, jewelery, Bags, shoes',
    'Electronics' => 'Apple, Electronic store, Best Buy, Microcenter',
    'Grocery' => 'Walmart, Costco, BJ wholesale, KRogers, 99 Cent store, Walmart, Target, Best Buy',
    'Necessities' => '99 Cent store, Walmart, Target, Best Buy',
    
    'Visit museums to learn about history' => 'Roman, Dinosaur, American, World',
    'Visit public institution' => 'Library, University, Archive, park',
    'Visit historical sites to live the moment' => 'Statue, Natural landmark, historical building, historical site',
    'Visit the nature to see the history of our planet' => 'Park, forest, mountain range, ocean',
];


$result = [];
foreach ($data as $key => $value) {
    $result[$key] = explode(', ', $value);
}
session_start();
$d = $_SESSION['recommend'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #C3B1E1;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .category {
            margin-bottom: 20px;
        }
        .subcategory-button {
            display: block;
            width: 100%;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 10px;
        }
        .subcategory-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
        <div class="container">
            <h1>Categories</h1>
            <?php foreach ($d as $category): ?>
                <div class="category">
                    <h2><?php echo ($category === 'Yes') ? 'Alcohol' : $category; ?></h2>
                    <?php foreach ($result[$category] as $subcategory): ?>
                        <button class="subcategory-button" onclick="navigateToGoogle('<?php echo $subcategory; ?>')"><?php echo $subcategory; ?></button>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    
        

    <script>
        function navigateToGoogle(category) {
            sessionStorage.setItem("key",category)
            console.log(sessionStorage.getItem("key"))

            window.location.href = `google.php`;
        }
    </script>
</body>
</html>