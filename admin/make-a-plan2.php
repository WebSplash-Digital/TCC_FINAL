<?php
session_start();
include('shop_include/config.php');



if(strlen($_SESSION['alogin'])==0)
{	
	header('location:index.php');
}
else
{
	date_default_timezone_set('Asia/Kolkata');// change according timezone
	$currentTime = date( 'd-m-Y h:i:s A', time () );
	if(isset($_POST['submit']))
	{
		
		$feature = '';
		if(isset($_POST['feature']) ) {
			$feature = $_POST['feature'][0];
			//echo "<h1>#$feature#</h1>";
		}
		 	$plan_id = 	$_POST['plan_id'];
	//	SELECT max* FROM `plan_details
		$sql = "SELECT max(sub_id) as max_id FROM `plan_details` where plan_id = '".$_POST['plan_id']."'"; //
		$result =mysqli_query($con,$sql);
		$row=mysqli_fetch_array($result);
		$max_id = $row['max_id'];
	  	$sub_id = ($max_id+1);
		// Add the  Headers

		for ($y = 1; $y <= $_POST['col']; $y++) {
				$data = $_POST["option$y"];
			//echo  " $plan_id |  $sub_id ";
			
			 $new_id = $sub_id;
			 foreach($data as $ok => $ov) {
				//echo "<h1> $y | $ok</h1>";
				//echo "<br>Record - <b> Key --  $ok </b>  value  $ov ";
				if($y == $feature) {
					$featured = 1;
				} else {
					$featured = 0;
				}
				$sql_insert  = "insert into plan_details (plan_id, sub_id, plan_option, plan_value, featured) values ('$plan_id', '".$new_id."', '".$_POST['option'][$y-1]."', '".$ov."',$featured)";  //".$_POST['val'][$ok]."
				mysqli_query($con,$sql_insert);
				$new_id++;
			}
		
		}	
		header('location:view-plans.php?id='.$plan_id);
		die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Make A Plan</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="css/custom.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <style>
		html,body,.container {
    height:100%;
}
.container {
    display:table;
    width: 100%;
    margin-top: -50px;
    padding: 50px 0 0 0; /*set left/right padding according to needs*/
    box-sizing: border-box;
}
header {
    background: green;
    height: 50px;
}

.row {
    height: 100%;
    display: table-row;
}

.row .cell {
  display: table-cell;
  float: none;
}

.cell-1 {   
   
  width: 25%;
  padding:5px;
}
.cell-2 {
    background: yellow; 
  width: 60%;
}
.header-col{
	width: 170px;
}
.value-col{
	width: 150px;
}
		</style>
</head>
<body>
<?php include('shop_include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
			<?php include('shop_include/sidebar.php');?>				
				<div class="span9">
					<div class="content">
						<div class="module">
							<div class="module-head">
								<h3>Add Plan Details </h3>
							</div>
							<div class="module-body">
							<div class="control-group">
									<label class="control-label" for="basicinput">Select the nos of Columns required</label>
									<div class="controls">
										<select class="span8" name="col" id="col" required>
										<option value="2" <?php if($_GET['col'] == 2){ echo 'selected'; }?>>2</option>
										<option value="3" <?php if($_GET['col'] == 2){ echo 'selected'; }?>>3</option>
										<option value="4" <?php if($_GET['col'] == 4){ echo 'selected'; }?>>4</option>
										<option value="5" <?php if($_GET['col'] == 5){ echo 'selected'; }?>>5</option>
										<option value="6" <?php if($_GET['col'] == 6){ echo 'selected'; }?>>6</option>
										<option value="7" <?php if($_GET['col'] == 7){ echo 'selected'; }?>>7</option>

										</select>
									</div>
									</div>
                                
								 <form class="form-horizontal row-fluid" name="category" action="<?=$_SERVER['PHP_SELF']?>" method="post" > 

								 <div class="control-group">
										<label class="control-label" for="basicinput">Plan</label>
										<div class="controls">
                                        <input type="hidden" name="plan_id" value="<?=$_GET['plan_id']?>" id="plan_id"> 
										</div>
									</div>

									<div class="control-group">
										<div class="container">
											<div class="row">
												<?php
												$col_cnt = $_GET['col'];
												for($i=1; $i<= $_GET['col'];$i++) {?>
												<div class="cell cell-1">
												<label class="control-label" for="basicinput">Header Name</label>
												<input type="radio" name="feature[]" value="<?=$i?>"> 
												<input type="text" name="option[]" placeholder="Header <?=$i?> Name" class="header-col">
												</div>
													<?php }?>
											</div>
										</div>
									</div>

									
									<div class="control-group" id="rowid1">
										<div class="container">
											<div class="row">
												<?php
												for($i=1; $i<= $_GET['col'];$i++) {?>
												<div class="cell cell-1">
													<input type="text" name="option<?=$i?>[]" placeholder="Value <?=$i?>" class="value-col">
												</div>
													<?php }?>
											</div>
										</div>
									</div>									<div class="control-group">
										


                                    <div class="control-group" >
										<div class="controls">
											<div>
										<span id="MoreROW" style="font-color:blue!important;margin-left:5px;margin-right:100px">Add More Row</span>
										
												
                                        <input type= "hidden" name="row" value="1" id="row_cnt" >
										<input type= "hidden" name="col" value="<?=$_GET['col']?>" id="col_cnt">
											<button type="submit" name="submit" class="btn" style="background:blue;color:#FFF;" value="add_more">Save Details</button>

											<span id="DeleteROW" style="display:none;font-color!important:red;margin-left:100px">Delete the Last Row</span>
										</div>
									</div>
								</form>
							</div>
						</div>  
					
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	<?php include('shop_include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');

        $("#MoreROW").click(function(){

           var row_cnt =  $("#row_cnt").val();
          // alert(row_cnt);
           var newcnt = parseInt(row_cnt) +1;
           $("#row_cnt").val(newcnt);
		   if(newcnt > 1) {
			$("#DeleteROW").show();
			}
		   var str = '<div class="control-group" id="rowid'+newcnt+'" style="padding-top:8px;padding-top:4px;"><div class="container"><div class="row"><?php for($i=1; $i<= $col_cnt;$i++) {?><div class="cell cell-1"><input type="text" name="option<?=$i?>[]" placeholder="Value <?=$i?>" class="value-col"></div><?php }?></div></div></div>';
 			// alert(str);
 		  $("#rowid"+row_cnt).append(str);
		});

		$("#DeleteROW").click(function(){
			var row_cnt =  $("#row_cnt").val();
         	// alert(row_cnt);
			 var newcnt = parseInt(row_cnt) -1;
			 if(newcnt < 2) {
				$("#DeleteROW").hide();
			 }
           $("#row_cnt").val(newcnt);
		  
			 // $(this).parent('div').remove();
			//	 $('#rowid'+row_cnt).('div').remove();
			$('#rowid'+row_cnt).remove();
		});	

		$("#col").change(function() {
			var category= $('select[name=col]').val() 
			var plan_id =  $("#plan_id").val();
			window.location = 'make-a-plan2.php?plan_id='+plan_id+'&col=' + category;
    	});
	} );
	</script>

</body>
<?php } ?>