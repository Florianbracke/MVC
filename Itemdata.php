
<div class="topnav">
  <h3>Upload Item</h3> 
  <ul>
  <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
    <li><a href="addClothes.php"><i class="fas fa-file-upload"></i></a></li>
    <li><a href="outfit.php"><i class="fas fa-calendar-day"></i></a></li>
    <li><a href="favorites.php"><i class="fas fa-heart"></i></a></li>
  </ul>
</div>

<div class="container"> 

<?php echo $uploadConfirm?>

<div class="col-lg-6 col-lg-offset-3">

<div class="p-5 text-center bg-image" style="
      background-image: url('images/photo-1574258495973-f010dfbb5371.jpg');
      height: 100vh;
		width: 100%;
		background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
    ">
               
               <div class="edit-text"> 
               <div class="form" style="width: 80%; opacity:0.8; color:black; margin:0 auto;">
                <form method='post' action='' enctype='multipart/form-data'>
                    <input type='file' name='files[]' multiple /> <br>
                    <br>
                    <br>
                   <label for="item_type"> Type of item: </label>
                   <select name="item_type" class="custom-select">
                       <option value="outer wear">Outer Wear</option>
                       <option value="pants">Pants</option>
                       <option value="skirts">Skirts</option>
                       <option value="jeans">Jeans</option>
                       <option value="dress">Dress</option>
                       <option value="shorts">Shorts</option>
                       <option value="blouse">Blouse</option>
                       <option value="knits">Knits</option>
                       <option value="tshirt">T-shirt</option>
                       <option value="jewelry">Jewelry</option>
                       <option value="glasses">Glasses</option>
                       <option value="accessory">Accessory</option>
                       <option value="sneakers">Sneakers</option>
                       <option value="heels">Heels</option>
                       <option value="shoes">Shoes</option>
                       <option value="hat">Hats</option>
                   </select> <br>
                   <label for="item_weather"> Weather type: </label>
                   <select name="item_weather" class="custom-select">
                   
                       <option value="hot">Hot</option>
                       <option value="cold">Cold</option>
                       <option value="rain">Rain</option>
                       <option value="all">All</option>
                   </select> <br>
                   <label for="item_ocassion"> Ocassion: </label>
                   <select name="item_ocassion" class="custom-select">
                
                       <option value="casual">Casual</option>
                       <option value="classy">Classy</option>
                       <option value="party">Party</option>
                       <option value="sporty">Sporty</option>
                       <option value="business">Business</option>
                       <option value="beach">Beach</option>
                   </select>   <br>                 
                   <label for="item_colour"> Colour: </label>
                   <select name="item_colour" class="custom-select">

                       <option value="red">Red</option>
                       <option value="orange">Orange</option>
                       <option value="yellow">Yellow</option>
                       <option value="green">Green</option>
                       <option value="blue">Blue</option>
                       <option value="purple">Purple</option>
                       <option value="black">Black</option>
                       <option value="white">White</option>
                       <option value="pink">Pink</option>
                       <option value="off white">Off White</option>
                       <option value="grey">Grey</option>
                       <option value="print">Print</option>
                   </select>   <br>                  
                   <label for="item_time"> Time of Day: </label>
                   <select name="item_time" class="custom-select">
                      
                       <option value="day">Day</option>
                       <option value="evening">Evening</option>
                       <option value="night">Night</option>
                   </select>   
                   <br>  <br> 
                   <input type='submit' value='Submit' name='submit' />
               </form>
       </div>
</div>
</div>
</div>
