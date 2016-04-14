<?php
function testFill($form)
{
	if(empty($_POST[$form]))
		return false;
	else
		return true;
}

function isFilled($formName)
{
	if(!testFill($formName))
	{
	?>
		<img id="errorPng" src="milker-X-icon.png" alt="Error" draggable="false">
	<?php
	}
}

function cCardSelect($formName)
{
	if(isset($_POST["cCard"]) && $_POST["cCard"] == $formName)
		print "checked";
}

function provSelect($prov)
{
	if(isset($_POST["prov"]) && $_POST["prov"] == $prov)
		print "selected";
}
?>
<!-- Francisco Da Costa
Student ID: 5026516
Lab Assignment 6 - Tree Branches Unlimited Forms PHP -->


<html lang="en">

	<head>
	
		<title> LabAss3FormPage </title>
		<meta charset="UTF-8"/>
		<meta name="Author" content="Francisco Da Costa" />
		<meta name="keywords" content="Tree Branches Unlimited, tree, branches, wood" />
		<meta name="discription" content="Tree Banches Unlimited's online branch store."/>
		<link rel="stylesheet" type="text/css" href="Tree_Branches_Unlimited.css" />
		<script src="OrderForm.js" type="text/javascript"></script>
	
	</head>

	<body>
	
		<header>
			
			<img id="Banner" src="Tree_Branches_Unlimited_Banner.jpg" alt="Tree_Branches_Unlimited_Banner.jpg" draggable="false" />

			
			<nav id="menu">
				<a href="index.html"> Home </a>
				<a href="Branch_Page.html"> Browse Our Branches </a>
				<a href="Order_Form_Page.html"> Order </a>
				<a href="ErrorPage.html"> Frequently Asked Questions </a>
				<a href="ErrorPage.html"> Contact Us </a>
			</nav>		
			
			<img id="Branch" src="Tree_Branches_Unlimited_Image.jpg" alt="" draggable="false" />
			
			<noscript>
				<p class="error"> Warning: This site requires JavaScript to function as intended. Please 
				visit this site with JavaScript enabled.</p>
			</noscript>
			
		</header>

<?php
$valid = 1;
if($_SERVER['REQUEST_METHOD'] == 'POST' and 
testFill("sName") and testFill("gName") and testFill("add") and 
testFill("city") and testFill("prov") and testFill("hPhone") and
testFill("cPhone") and testFill("cCard") and testFill("cCNum")
)
{
	if (isset($_POST["mailY"]))
	{
		if(testFill("email"))
			$valid = 1;
		else
			$valid = 0;
	}
	else
		$valid = 1;
}
else{
	$valid = 0;
}
if($valid == 0){ ?>

		<main>
			
			<form id="orderForm" action="OrderSubmit.php" method="post">
				
				<br/>
				<h1> Tree Branches Order <?php print $valid?></h1>
				
				<div class="formCol">
					<p> Surname: </p>
					<input type="textbox" name="sName" value="<?=$_POST["sName"]?>" />
					<?php isFilled("sName");?>
				</div>
				
				<div class="formCol">
					<p> Given name:  </p>
					<input type="textbox" name="gName" value="<?=$_POST["gName"]?>" />
					<?php isFilled("gName");?>
				</div>
				
				<div class="formCol"> 
					<p> Address:  </p> 
					<input type="textbox" name="add" value="<?=$_POST["add"]?>" />
					<?php isFilled("add");?>
				</div>
				
				 <div class="formCol">
					<p> City: </p> 
					<input type="textbox" name="city" value="<?=$_POST["city"]?>" />
					<?php isFilled("city");?>
				</div>
				
				<div class="formCol">
					<p> Province: </p>

					<?php $prov = file("provInfo.txt", FILE_IGNORE_NEW_LINES)?>
					<select name="prov" >
						<?php for($i = 0; $i < count($prov); ++$i){ ?>
						<option <?php provSelect($prov[$i]);?> > <?php echo $prov[$i];?></option> <?php }?>
					</select>
					<?php isFilled("prov");?>
				</div>
				
				<fieldset>
					<legend> Phone </legend>
					<div class="formRow">
						Home: 
						<input type="tel" name="hPhone" value="<?=$_POST["hPhone"]?>" />
						<?php isFilled("hPhone");?>
						Cell: 
						<input type="tel" name="cPhone" value="<?=$_POST["cPhone"]?>" />
						<?php isFilled("cPhone");?>
					</div>
				</fieldset>
				
				<div class="formCol">
				 <p> Email: </p> 
					<input type="textbox" name="email" value="<?=$_POST["email"]?>" />
					<?php if(isset($_POST["mailY"])) isFilled("email"); ?>
				</div>
				
				<div class="formCol">
					<div>
					
						<p> Do you wish to be added to out mailing list? </p>
						
						<label>
							<input type="checkbox" name="mailY" id="mailY" onchange="mailList('mailY')" /> Yes
						</label>

						<label>
							<input type="checkbox" name="mailN" id="mailN" onchange="mailList('mailN')" "/> No
						</label>
						
						<?php if(empty($_POST["mailY"]) && empty($_POST["mailN"])){ ?>
							<img id="errorPng" src="milker-X-icon.png" alt="Error" draggable="false">
						<?php }	?>
						
					</div>
				</div>
					
				<h2> Order (Maximum 3) </h2>
					
				<div>	
					
					<div class="formCol">
						<p> Type: </p>
						<?php $branch = file("branchInfo.txt", FILE_IGNORE_NEW_LINES)?>
						<select id="o1_type" onclick="calSubtotal('o1');" >
							<?php for($i = 0; $i < count($branch); ++$i){?>
							<option><?php echo $branch[$i]?></option><?php }?>
						</select>
						
						<select id="o2_type" onclick="calSubtotal('o2');" >
							<?php for($i = 0; $i < count($branch); ++$i){?>
							<option><?php echo $branch[$i]?></option><?php }?>
						</select>						
						
						<select id="o3_type" onclick="calSubtotal('o3');" >
							<?php for($i = 0; $i < count($branch); ++$i){?>
							<option><?php echo $branch[$i]?></option><?php }?>
						</select>						
						
					</div>
					
					<div class="formCol">
						<p> Quantity: </p> 
						<input type="number" id="o1_quan" onchange="calSubtotal('o1');" min="0" max="1000000" />
						<input type="number" id="o2_quan" onchange="calSubtotal('o2');" min="0" max="1000000" />
						<input type="number" id="o3_quan" onchange="calSubtotal('o3');" min="0" max="1000000" />
					</div>
					
					<div class="formCol">
						<p> Unit/Price: </p> 
						<input type="textbox" id="o1_uPrice" readonly />
						<input type="textbox" id="o2_uPrice" readonly />
						<input type="textbox" id="o3_uPrice" readonly />
					</div>
					
					<div class="formCol">
						<p> Subtotal: </p> 
						<input type="textbox" id="o1_subtotal" readonly />
						<input type="textbox" id="o2_subtotal" readonly />
						<input type="textbox" id="o3_subtotal" readonly />
					</div>
				
				</div>
				
				<fieldset id="creditBox">
					<legend> Mode Of Payment </legend>
					<div class="formRow">
						<label> <input type="radio" name="cCard" value="Master Card" <?php cCardSelect("Master Card") ?> /> Master Card </label>
						<label> <input type="radio" name="cCard" value="Visa" <?php cCardSelect("Visa") ?> /> Visa </label>
						<label> <input type="radio" name="cCard" value="Amex" <?php cCardSelect("Amex") ?> /> Amex </label>
						<?php isFilled("cCard");?>
					</div>
					
					<div class="formRow">
						Number:
						<input type="textbox" name="cCNum" value="<?= $_POST["cCNum"]?>" />
						<?php isFilled("cCNum");?>
					</div>
				</fieldset>
			
				
				<div id="payments">
					<div class="formRow">
						Subtotal:
						<input name="payments" type="textbox" id="subtotal" onclick="calTotal();" readonly />
					</div>
					
					<div class="formRow">
						GST:
						<input name="payments" type="textbox" id="gst" onclick="calTotal();" readonly />
					</div>
					
					<div class="formRow">
						Total:
						<input name="payments" type="textbox" id="total" onclick="calTotal();" readonly />
					</div>
				</div>
				
				<div id="subcan">
				<input type="submit" value="Submit Order" />
				<input type="reset" value="Clear Order" />
				</div>
				
			</form>
	</main>
	<?php } else {?>
		<main>
			<h1> Receipt </h1>
			<ul>
				<li> Surname: <?php print($_POST["sName"])?> </li>
				<li> Given Name: <?php print($_POST["gName"])?> </li>
				<li> Address: <?php print($_POST["add"])?> </li>
				<li> City: <?php print($_POST["city"])?> </li>
				<li> Province: <?php print($_POST["prov"])?> </li>
				<li> Home Phone: <?php print($_POST["hPhone"])?> </li>
				<li> Cell Phone: <?php print($_POST["cPhone"])?> </li>
				<li> Email: <?php print($_POST["email"])?> </li>
				<li> Credit Card Type: <?php print($_POST["cCard"])?> </li>
				<li> Total Payment: <?php print($_POST["payments"])?> </li>
			</ul>
			<p> Thank you very much for you patronage!</p>
		</main>
	<?php }?>
		<footer>
		
		</footer>
		
	</body>

	
</html>
