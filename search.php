<!DOCTYPE html>
<html>
	

<head>
	<title>SEARCH</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

	<style type="text/css">
		.square {
			display: grid;
			height: 700px;
			width: 500px;
			background-color: #FFEE88;
			margin-left: 500px;

		}

		img {
			width: 100%;
		}



		p {
			font-size: 30px;
			text-align: left;
			margin-left: 30px;
		}

		.i1 {
			width: 30px;
			height: 30px;
			margin-top: -40px;
			margin-left: 450px;

		}

		.line {
			color: black;
			margin-top: -500px;
			width: 300px;
			margin-left: 100px;
		}

		.c1 {
			width: 300px;
			margin-top: -350px;
			margin-left: 100px;
		}

		.pizza {
			width: 80px;
			height: 40px;
			margin-bottom: 600px;
		}

		.burger {
			width: 80px;
			height: 40px;
			margin-top: -646px;
			margin-left: 85px;
		}

		.pasta {
			width: 80px;
			height: 40px;
			margin-top: -640px;
			margin-left: 170px;
		}

		.salad {
			width: 80px;
			height: 40px;
			margin-top: -640px;
			margin-left: 255px;
		}

		.soup {
			width: 80px;
			height: 40px;
			margin-top: -645px;
			margin-left: 337px;
		}

		.steak {
			width: 80px;
			height: 40px;
			margin-top: -649px;
			margin-left: 420px;
		}

		.remove {
			width: 100px;
			height: 50px;
			margin-top: -450px;
			margin-left: 40px;
		}

		.add {
			width: 100px;
			height: 50px;
			margin-top: -450px;
			margin-left: 150px;
		}


		.types {
			width: 500px;
			margin-left: 500px;
			margin-top: -300px;
		}

		.a{
			width: 100%;
			height:2px;
			background-color:grey;
			margin-top:5px;
		
		}

		

		table, td, th {
  		border: 1px solid black;
		  margin-left:auto;
		  margin-right:auto;
		  margin-top:10%;
		}		

table {
  border-collapse: collapse;
}
#searchInput{
	margin-right: 80px;	
	margin-left: 80px;
}


	</style>

	
</head>

<body>
	

<?php
	include("config/headcustomer.php");
	?>
	<div class="square">

	
		<div style="margin-top:80px; ">


			<div id ="searchInput">
			<div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping">🔎</span>
  <input type="text" class="form-control search" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" onkeyup="myFunction()>
</div>				
			</div>

			<div class="a">

			</div>

			<div class="row">
			<div class="form-check">
  <input name="myRadio" class="Check form-check-input" type="radio" value="Pizza">
  <label class="form-check-label" for="flexRadioDefault1">
    pizza
  </label>
</div>
  <div class="form-check">
  <input name="myRadio" class="Check form-check-input" type="radio"  style="margin-left:20px;" value="">
  <label class="form-check-label">
else  </label>
</div>

</div>
		
<table>
	<thead>
		<th>item name</th>
		<th>item price</th>
		<th>item time to cook</th>
		<th>item kcal</th>
		<th>item weight</th>
    </thead>
	
	<tbody id = "tbody"></tbody>
</table>
		</div>
	</div>



		
</body>


<!--jquery and API added by mhamad and sara-->
<script>
	var cbox = $('.Check');
cbox.on('change',function(){
    if (cbox.is(':checked')){
      var radioValue = $(this).val();

      
        $('#tbody tr').filter(function(){
          $(this).toggle($(this).text().indexOf(radioValue) > -1);
        });
      
    }

  });




var xmlhttp = new XMLHttpRequest();
        $('#searchInput').on('keyup', function(){
            $('#tbody').html("");
            var input =   $('.search').val();
            var tmp = '';
            xmlhttp.onload = function(){
				
		
                var myData = JSON.parse(this.responseText);
				$('.b').innerHTML = myData;
                $.each(myData, function(){
                    $('#tbody').append(
                        `
                        <tr>
                            <td>${this["item_name"]}</td>
                            <td>${this["price"]}</td>
                            <td>${this["time_cook"]}</td>
                            <td>${this["kcal"]}</td>
                            <td>${this["gr"]}</td>
                        </tr>
                        `
                    );
                });
            };
            xmlhttp.open("GET","serverget.php?search="+ input, true);
            xmlhttp.send();
        });




</script>



</html>