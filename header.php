<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>DOGS WORLD</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/function.js" type="text/javascript"></script>
<script src="jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("config.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
  <style>
   
    /* Formatting search box */
    .search-box{
       
        position: relative;
        display: inline-block;
        
    }
    
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
		background:#eee;
		opacity:0.8;
    }
    .search-box input[type="text"], .result{
        width: 88%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
       /* border: 1px solid #CCCCCC;*/
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="header" style="border-bottom:2px solid black;">
    
  </div>
  <div class="nav">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="services.php">Service</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact Us</a></li>
      <li><a href="cart.php">My Cart</a></li>
      <li><a href="breeder-log.php">Breeders</a></li>
      
      
      
    </ul>
	<form action="search.php" method="post">
     <div class="search-box">
		<input type="text" id="search-box" autocomplete="off" name="search-product" style="text-align:center" value="" placeholder="-- Search for Dogs - -">
	<input type="submit" id="search" name="search" value="Search">
	<div class="result" style="overflow:auto;text-align:center" ></div>
	</div> 
      
    </form>
  
  </div>
  