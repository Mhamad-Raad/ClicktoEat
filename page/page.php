<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <title>staff page</title> -->
	

<style>
.square {
  display: grid;
  height: 700px;
  width: 500px;
  background-color: #FF8C00;
  margin-left: 500px;
  grid-gap: 500px;
}

.info{
	background-color: #F0E68C;
	margin-left: 100px;
	margin-right: 100px;
	margin-top: 280px;
	margin-bottom: 200px;
     border-radius: 20px;

}

.button{
	margin-top: 100px;
    margin-left: 115px;
    margin-bottom: 10px;
    height: 30px;
    width: 70px;
}

.underline{
	  width: 90%;
	  background-color: #F0E68C;
	  border-top: none;
	  border-left: none;
	  border-right: none;
	  border-bottom: 1px solid black;

	  background-image:url('images/usericon.png');
      left:no-repeat;
}



.text{
	margin-top: 30px;
}

.required {  
   color: red;
}

</style>

</head> 


<body /*style="background-color: #FF8C00"*/>

</body>
<div class="square">
	<div class="info">
		<br><br><br>
		
		<input type="text" class="underline" name="x" placeholder="Restaurant name" required >
		  
		  <br><br><br><br>

		<input type="Password" class="underline" name="x" placeholder="password" required>
        
        <a href="page2.html">
		<button class="button" style="background-color:#FF8C00"><b> Enter</b></button></a>
	</div>

</div>



</html>