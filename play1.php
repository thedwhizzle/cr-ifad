<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/db_connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php include("./includes/layouts/header.php"); ?>

	<div class="wrapper">
	<?php table_date(); ?>
		<div id="current_wk_head" >
			<?php current_table(); ?>
		</div>
	</div> 
	<div class="wrapper" id="czarnames">
	<?php czarnames(); ?>
	</div>
		<div class="wrapper" style="background:#f2f2f2;">
			<iframe id="forecast_embed" type="text/html" frameborder="0" height="245" src="http://forecast.io/embed/#lat=35.795925&lon=-79.228608&name=Chapel Ridge&color=#6BB9F0&font=Open+Sans"> 
			</iframe>
		</div>
	</div> 	<!--End container div-->
</body>
</html>

<?php 
	// 5. Close database connection
mysqli_close($connection);
?>