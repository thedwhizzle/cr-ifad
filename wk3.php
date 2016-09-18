<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/db_connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php include("./includes/layouts/header.php"); ?>

<script>
$(window).load(function() {
    if (window.location.href.indexOf('reload')==-1) {
         window.location.replace(window.location.href+'?reload');
    }
});
</script>

	<div class="wrapper">
		<?php table_date3();  ?>
		<div id="current_wk_head" >
			<?php week3_table(); ?>
		</div>
	</div> 

	<div class="wrapper">
		<h4 id="directions">Mark the days you want to play:</h4>
		<form name="input" action="wk3.php" method="post">
		<?php week3_changes(); ?>

		<div id="submit_section">
			
				<input type="submit" name="playdaz" value="SUBMIT" class="button" />

			<form name="input" action="wk3.php" method="post">
				<input type="submit" name="goback" value="BACK" class="button" />
			</form>
		<p> When you click SUBMIT all days are submitted so, each day should be appropriately checked.</p>
		<p> No updates within 24hrs of next play day.</p>
		</div>
	</div>
<div class="wrapper" style="background:#f2f2f2;">
	<iframe id="forecast_embed" type="text/html" frameborder="0" height="245" src="http://forecast.io/embed/#lat=35.795925&lon=-79.228608&name=Chapel Ridge&color=#6BB9F0&font=Open+Sans"> </iframe>
</div>
</div> 	<!--End container div-->
</body>
</html>

<?php 
	// 5. Close database connection
mysqli_close($connection);
?>





