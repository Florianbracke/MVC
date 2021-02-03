<?php ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <style>
 .navbar {
     
     display: flex;
     flex-direction: row;
    justify-content: center; 
     
 } 
 a {
     border: 2px, black;
     border-radius: 40%;
     color: black;
     text-decoration: none;
     
 }

 </style>
 <body>

    <div class="navbar">

        <form method="get" action="/MVC/closet.php">
            <button type="submit">Your Closet</button>
        </form>

        <form method="get" action="/MVC/addClothes.php">
            <button type="submit">Expand Closet</button>
        </form>
        
        <form method="get" action="/MVC/index.php">
            <button type="submit">Homepage</button>
        </form>
    
    </div>
 </body>
 </html>
 