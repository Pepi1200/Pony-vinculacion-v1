<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<style type="text/css">
		footer{
				width: 100%;
				min-height: 280px;
				font-family: arial;
				color: #FFFFFF;
				/*background: rgb(0,74,173);
				background: linear-gradient(90deg, rgba(0,74,173,1) 100%, rgba(82,113,255,1) 26%);*/
				background: #1A386A;
				text-align: center;
			}
			#address{
				text-align: center;
				font-size: 18px;
			}
			p{
				font-size: 20px;
				font-weight: bold;
			}
			.box {
			  display: flex;
			  flex-wrap: wrap;
			  align-items: center;
 			  justify-content: space-evenly;
			}	
		</style>

		<?php
			$address1=[["Campus I", "Avenida Tecnólogico", "#1500","Col. Lomas de Santiaguito","Morelia","Michoacán"],["Campus II", "Camino de la Arboleada", "S/N", "Residencial San Jose de la Huerta","Morelia","Michoacán"]];
		?>
	</head>

	<body>
		<footer>
			<img src="images/EducacionBlancotecnm.png"  style="height: 80px; width: 586px; margin-top: 20px;">

			<div id="address">
				<div class="box">
					<script type="text/javascript">
						var address=<?php echo json_encode($address1); ?>;
						var distance=window.innerWidth/(address.length*2);

						function printAddress(address,distance) {
							document.write("<div>");
							document.write("<p>"+address[0]+"</p>");
							document.write(address[1]+" ");
							document.write(address[2]+",<br>");
							document.write(address[3]+",<br>");
							document.write(address[4]+", ");
							document.write(address[5]+"<br>");
							document.write("</div>");
						}

						for(i=0;i<address.length; i++){
							printAddress(address[i],distance-(50.34*i));
						}
					</script>
				</div>
			</div>

		</footer>
	</body>

</html>

