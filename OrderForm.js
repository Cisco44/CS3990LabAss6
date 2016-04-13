/* Francisco Da Costa
Student ID: 5026516
Lab Assignment 6 - Tree Branches Unlimited Forms PHP */

function calSubtotal(txt)
/*
	This funtion is designed to calculate the subtotals for each item.
	It takes the identifier for the row, so that the calculations are displayed
	in the appropriate form boxes, and to maintain accuracy.
	It is event based, and occurs when the tree branch or the quantity are changed.
*/
{
	var	type = document.getElementById(txt + "_type");
	var	units = document.getElementById(txt +"_quan");	
	
	var uPrice = document.getElementById(txt +"_uPrice");
	if (type.value == "Great Basic Bristlecone Pine")
		uPrice.value = 4.99;
	else if(type.value == "European Ash")
		uPrice.value = 2.99;
	else if(type.value == "Red Oak")
		uPrice.value = 7.99;	

	var	subtotal = document.getElementById(txt + "_subtotal");
	
	var answer = uPrice.value * units.value;
	subtotal.value = answer.toFixed(2);
}

function calTotal()
/*
	This function sums the subtotals of each purchase. It also calculates the GST
	at a 5% rate, and finally sums the results and outputs the total cost.
	This function is event based, and is triggered by clicking on the subtotal, gst, 
	or total boxes.
*/
{
	var sub1 = document.getElementById("o1_subtotal").value;
	var sub2 = document.getElementById("o2_subtotal").value;
	var sub3 = document.getElementById("o3_subtotal").value;
	
	var subtotal = Number(sub1) + Number(sub2) + Number(sub3);
	document.getElementById("subtotal").value = subtotal.toFixed(2);
	var gst = (subtotal * 0.05).toFixed(2);
	document.getElementById("gst").value = gst;
	var total = Number(subtotal) + Number(gst);
	document.getElementById("total").value = total.toFixed(2);
}

function mailList(txt)
{
	var mYes = document.getElementById("mailY").checked;
	var mNo = document.getElementById("mailN").checked;
	
	if(txt == "mailY" && mNo == true)
	{
		document.getElementById("mailN").checked = false;
	}
	else if(txt == "mailN" && mYes == true)
	{
		document.getElementById("mailY").checked = false;
	}
}
