// Unit Management activity Document
$(document).ready( function() {

	$("#save1").click(validate);
	$("#save1n").click(validate);
	
	function validate(){
		var msg = "";

		fname = $("#first_name").val();
		if(fname.length <= 1){
			$("#first_name").addClass("textborderred");
			msg = "Please fill the First Name";
		}else{
			$("#first_name").removeClass("textborderred");
		}
		
		lname = $("#last_name").val();
		if(lname.length <= 1){
			$("#last_name").addClass("textborderred");
			msg += "Please fill the Last Name";
		}else{
			$("#last_name").removeClass("textborderred");
		}
		
		dob = $("#dob").val();
		if(dob.length <= 8){
			$("#dob").addClass("textborderred");
			msg += "Please fill the DOB";
		}else if(dob.length >= 8){
			//check for date format
			if(!isDate(dob)){
				$("#dob").addClass("textborderred");
				msg += "Please fill the DOB";
			}
		}else{
			$("#dob").removeClass("textborderred");
		}
		
		mob = $("#contact_no").val();
		if(mob.length < 10){
			$("#contact_no").addClass("textborderred");
			msg += "Please fill the mobile";
		}else if(isNaN(mob)){
			//check for date format
				msg += "Please fill the mobile";
		}else{
			$("#contact_no").removeClass("textborderred");
		}
		
		addr = $("#address1").val();
		if(addr.length <= 1){
			$("#address1").addClass("textborderred");
			msg = "Please fill the Address Line 1";
		}else{
			$("#address1").removeClass("textborderred");
		}
		
		city = $("#city").val();
		if(city.length <= 1){
			$("#city").addClass("textborderred");
			msg = "Please fill the City";
		}else{
			$("#city").removeClass("textborderred");
		}
		
		state = $("#state").val();
		if(state.length <= 1){
			$("#state").addClass("textborderred");
			msg = "Please fill the State";
		}else{
			$("#state").removeClass("textborderred");
		}
		
		zipcode = $("#zipcode").val();
		if(zipcode.length <= 1){
			$("#zipcode").addClass("textborderred");
			msg = "Please fill the Zipcode";
		}else{
			$("#zipcode").removeClass("textborderred");
		}
		
		addr = $("#caddress1").val();
		if(addr.length <= 1){
			$("#caddress1").addClass("textborderred");
			msg = "Please fill the Address Line 1";
		}else{
			$("#caddress1").removeClass("textborderred");
		}
		
		city = $("#ccity").val();
		if(city.length <= 1){
			$("#ccity").addClass("textborderred");
			msg = "Please fill the City";
		}else{
			$("#ccity").removeClass("textborderred");
		}
		
		state = $("#cstate").val();
		if(state.length <= 1){
			$("#cstate").addClass("textborderred");
			msg = "Please fill the State";
		}else{
			$("#cstate").removeClass("textborderred");
		}
		
		zipcode = $("#czipcode").val();
		if(zipcode.length <= 1){
			$("#czipcode").addClass("textborderred");
			msg = "Please fill the Zipcode";
		}else{
			$("#czipcode").removeClass("textborderred");
		}
		
		empid = $("#empid").val();
		if(empid.length <= 1){
			$("#empid").addClass("textborderred");
			msg = "Please fill the Employee ID";
		}else{
			$("#empid").removeClass("textborderred");
		}
		
		
		if(msg.length>=1){
			$("#errorfields").removeClass("div_disable");
			$("#errorfields").addClass("div_enable");	
			return false;
		}
	}
	
	$("#save2").click(validatesecond);
	$("#save2n").click(validatesecond);
	
	function validatesecond(){
		alert('dd');
	}
	
	function isDate(txtDate)
	{
		var currVal = txtDate;
		if(currVal == '')
			return false;
		
		var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
		var dtArray = currVal.match(rxDatePattern); // is format OK?
		
		if (dtArray == null) 
			return false;
		
		//Checks for dd/mm/yyyy format.
		dtMonth = dtArray[3];
		dtDay= dtArray[1];
		dtYear = dtArray[5];        
		
		if (dtMonth < 1 || dtMonth > 12) 
			return false;
		else if (dtDay < 1 || dtDay> 31) 
			return false;
		else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31) 
			return false;
		else if (dtMonth == 2) 
		{
			var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
			if (dtDay> 29 || (dtDay ==29 && !isleap)) 
					return false;
		}
		return true;
	}
});