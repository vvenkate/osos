// Unit Management activity Document
$(document).ready( function() {

	
	//change the fields to show
	$("input[name$='prop_type']").change(function(){
			var value = $(this).val();
			
			if(value == "Villa"){
				$("#villa").removeClass("div_disable");
				$("#villa").addClass("div_enable");				
				
				$("#flat").addClass("div_disable");
				$("#flat").removeClass("div_enable");
				
				$("#warehouse").addClass("div_disable");
				$("#warehouse").removeClass("div_enable");
				
				$("#shop").addClass("div_disable");
				$("#shop").removeClass("div_enable");				
			}
			if(value == "Building"){
				$("#villa").addClass("div_disable");
				$("#villa").removeClass("div_enable");				
				
				$("#warehouse").addClass("div_disable");
				$("#warehouse").removeClass("div_enable");
				
				$("#flat").removeClass("div_disable");
				$("#flat").addClass("div_enable");
				
				$("#shop").addClass("div_disable");
				$("#shop").removeClass("div_enable");
			}
			if(value == "Warehouse"){
				$("#villa").addClass("div_disable");
				$("#villa").removeClass("div_enable");				
				
				$("#flat").addClass("div_disable");
				$("#flat").removeClass("div_enable");
				
				$("#warehouse").removeClass("div_disable");
				$("#warehouse").addClass("div_enable");
				
				$("#shop").addClass("div_disable");
				$("#shop").removeClass("div_enable");
			}
			if(value == "Shop"){
				$("#villa").addClass("div_disable");
				$("#villa").removeClass("div_enable");				
				
				$("#flat").addClass("div_disable");
				$("#flat").removeClass("div_enable");
				
				$("#warehouse").addClass("div_disable");
				$("#warehouse").removeClass("div_enable");
				
				$("#shop").removeClass("div_disable");
				$("#shop").addClass("div_enable");
			}
		}
	);
	
	var occ_flat = 2;
	$("#addflatocc").click(function(){
		var edu_input1name = "flat_floor_no"+occ_flat;
		var edu_input2name = "flat_flat_no"+occ_flat;
		var edu_input3name = "flat_occupied"+occ_flat;
		
		edu_column1= document.createElement("div");
		edu_column1.className = "col-xs-6 col-md-4 group-mail";
		
		//input label
		edu_inputcol1lab = document.createElement("label");
		edu_inputcol1lab.setAttribute("for",edu_input1name);
		edu_inputcol1lab.innerHTML = "Floor No";
		
		//input text
		edu_inputcol1 = document.createElement("input");
		edu_inputcol1.type = "text";
		edu_inputcol1.name = edu_input1name;
		edu_inputcol1.id = edu_input1name;
		edu_inputcol1.className = "form-control";
		edu_inputcol1.setAttribute("placeholder","1 or 2");
		
		edu_column1.appendChild(edu_inputcol1lab);
		edu_column1.appendChild(edu_inputcol1);
		
		edu_column2= document.createElement("div");
		edu_column2.className = "col-xs-6 col-md-4 group-mail";
		
		//input label2
		edu_inputcol2lab = document.createElement("label");
		edu_inputcol2lab.setAttribute("for",edu_input2name);
		edu_inputcol2lab.innerHTML = "Flat Number";
					
		//input text2
		edu_inputcol2 = document.createElement("input");
		edu_inputcol2.type = "text";
		edu_inputcol2.name = edu_input2name;
		edu_inputcol2.id = edu_input2name;
		edu_inputcol2.className = "form-control";
		edu_inputcol2.setAttribute("placeholder","1 or 2");
		
		edu_column2.appendChild(edu_inputcol2lab);
		edu_column2.appendChild(edu_inputcol2);
		
		edu_column3= document.createElement("div");
		edu_column3.className = "col-xs-6 col-md-4 group-mail";
		
		
		//div education row.
		edu_rows_div = document.createElement("div");
		edu_rows_div.className = "row";
		edu_rows_div.appendChild(edu_column1);
		edu_rows_div.appendChild(edu_column2);
		edu_rows_div.appendChild(edu_column3);
		
		$("#addflatoccupied").append(edu_rows_div);
		
		occ_flat++;
	});
	
	
	var unocc_flat = 2;
	$("#addflatunocc").click(function(){
		var edu_input1name = "flat_floor_no_un"+occ_flat;
		var edu_input2name = "flat_flat_no_un"+occ_flat;
		
		edu_column1= document.createElement("div");
		edu_column1.className = "col-xs-6 col-md-4 group-mail";
		
		//input label
		edu_inputcol1lab = document.createElement("label");
		edu_inputcol1lab.setAttribute("for",edu_input1name);
		edu_inputcol1lab.innerHTML = "Floor No";
		
		//input text
		edu_inputcol1 = document.createElement("input");
		edu_inputcol1.type = "text";
		edu_inputcol1.name = edu_input1name;
		edu_inputcol1.id = edu_input1name;
		edu_inputcol1.className = "form-control";
		edu_inputcol1.setAttribute("placeholder","1 or 2");
		
		edu_column1.appendChild(edu_inputcol1lab);
		edu_column1.appendChild(edu_inputcol1);
		
		edu_column2= document.createElement("div");
		edu_column2.className = "col-xs-6 col-md-4 group-mail";
		
		//input label2
		edu_inputcol2lab = document.createElement("label");
		edu_inputcol2lab.setAttribute("for",edu_input2name);
		edu_inputcol2lab.innerHTML = "Flat Number";
					
		//input text2
		edu_inputcol2 = document.createElement("input");
		edu_inputcol2.type = "text";
		edu_inputcol2.name = edu_input2name;
		edu_inputcol2.id = edu_input2name;
		edu_inputcol2.className = "form-control";
		edu_inputcol2.setAttribute("placeholder","1 or 2");
		
		edu_column2.appendChild(edu_inputcol2lab);
		edu_column2.appendChild(edu_inputcol2);
		
		edu_column3= document.createElement("div");
		edu_column3.className = "col-xs-6 col-md-4 group-mail";
		
		
		//div education row.
		edu_rows_div = document.createElement("div");
		edu_rows_div.className = "row";
		edu_rows_div.appendChild(edu_column1);
		edu_rows_div.appendChild(edu_column2);
		edu_rows_div.appendChild(edu_column3);
		
		$("#addflatunoccupied").append(edu_rows_div);
		
		unocc_flat++;
	});
	
	$("#exp_type").change(function(){
		if(this.value == "Maintenance"){
			$("#expdata").removeClass("div_disable");
			$("#expdata").addClass("div_enable");
			var value = $("input[name$='prop_type']:checked").val();
			
				if(value == "Villa"){
					$("#villa").removeClass("div_disable");
					$("#villa").addClass("div_enable");	
				}
				if(value == "Building"){
					$("#flat").removeClass("div_disable");
					$("#flat").addClass("div_enable");	
				}
				if(value == "Warehouse"){
					$("#warehouse").removeClass("div_disable");
					$("#warehouse").addClass("div_enable");	
				}
				if(value == "Shop"){
					$("#shop").removeClass("div_disable");
					$("#shop").addClass("div_enable");	
				}
		}else{
			$("#expdata").addClass("div_disable");
			$("#expdata").removeClass("div_enable");
			
			$("#villa").addClass("div_disable");
			$("#villa").removeClass("div_enable");				
			
			$("#flat").addClass("div_disable");
			$("#flat").removeClass("div_enable");
			
			$("#warehouse").addClass("div_disable");
			$("#warehouse").removeClass("div_enable");
			
			$("#shop").addClass("div_disable");
			$("#shop").removeClass("div_enable");
		}
	});
	
	
	$("#propsave").click(propvalidate);
	$("#propsaven").click(propvalidate);
	
	function propvalidate(){
		var msg = "";
		
		country = $("#prop_country option:checked"). val();
		if(country.length <= 1){
			msg = "Country Name is missing";
			$("#prop_country").addClass("textborderred");
		}else{
			$("#prop_country").removeClass("textborderred");
		}
		
		city = $("#prop_city"). val();
		if(city.length <= 1){
			msg = "City Name is missing";
			$("#prop_city").addClass("textborderred");
		}else{
			$("#prop_city").removeClass("textborderred");
		}
		
		propty = $("input[name='prop_type']:checked"). val();
		
		if(propty == "Building"){
			if($("#flat_name").val().length <=1){
				msg = "Building Name is missing";
				$("#flat_name").addClass("textborderred");
			}else{
				$("#flat_name").removeClass("textborderred");
			}
			
			if($("#flat_no").val().length <=1){
				msg += "Building No is missing";
				$("#flat_no").addClass("textborderred");
			}else{
				$("#flat_no").removeClass("textborderred");
			}
			
			if($("#flat_addr_line1").val().length <=1){
				msg += "Building Address Line 1";
				$("#flat_addr_line1").addClass("textborderred");
			}else{
				$("#flat_addr_line1").removeClass("textborderred");
			}
		}else if(propty == "Villa"){
			if($("#villa_name").val().length <=1){
				msg = "Villa Name is missing";
				$("#villa_name").addClass("textborderred");
			}else{
				$("#villa_name").removeClass("textborderred");
			}
			
			if($("#villa_no").val().length <=1){
				msg += "Villa No is missing";
				$("#villa_no").addClass("textborderred");
			}else{
				$("#villa_no").removeClass("textborderred");
			}
			
			if($("#villa_addr_line1").val().length <=1){
				msg += "Villa Address is missing";
				$("#villa_addr_line1").addClass("textborderred");
			}else{
				$("#villa_addr_line1").removeClass("textborderred");
			}
			
			if($("#villa_rent_amt").val().length <=1){
				msg += "Villa Rent is missing";
				$("#villa_rent_amt").addClass("textborderred");
			}else{
				if(isNaN("#villa_rent_amt").val())
				{
					msg += "Villa Rent should be numeric";
				}
				$("#villa_rent_amt").removeClass("textborderred");
			}
		}else if(propty == "Warehouse"){
			if($("#wh_name").val().length <=1){
				msg = "Warehouse Name is missing";
				$("#wh_name").addClass("textborderred");
			}else{
				$("#wh_name").removeClass("textborderred");
			}
			
			if($("#wh_no").val().length <=1){
				msg += "Warehouse No is missing";
				$("#wh_no").addClass("textborderred");
			}else{
				$("#wh_no").removeClass("textborderred");
			}
			
			if($("#wh_addr_line1").val().length <=1){
				msg += "Warehouse Address is missing";
				$("#wh_addr_line1").addClass("textborderred");
			}else{
				$("#wh_addr_line1").removeClass("textborderred");
			}
			
			if($("#wh_rent").val().length <=1){
				msg += "Warehouse Rent is missing";
				$("#wh_rent").addClass("textborderred");
			}else{
				if(isNaN("#wh_rent").val())
				{
					msg += "Warehouse Rent should be numeric";
				}
				$("#wh_rent").removeClass("textborderred");
			}
		}else if(propty == "Shop"){
			if($("#shopi_name").val().length <=1){
				msg = "Shop Name is missing";
				$("#shopi_name").addClass("textborderred");
			}else{
				$("#shopi_name").removeClass("textborderred");
			}
			
			if($("#shopi_no").val().length <=1){
				msg += "Shop No is missing";
				$("#shopi_no").addClass("textborderred");
			}else{
				$("#shopi_no").removeClass("textborderred");
			}
			
			if($("#shopi_addr_line1").val().length <=1){
				msg += "Shop Address is missing";
				$("#shopi_addr_line1").addClass("textborderred");
			}else{
				$("#shopi_addr_line1").removeClass("textborderred");
			}
		}
		
		if(msg.length >=1){
			return false;
		}
	}
	
	$("#propflsave").click(propflatvalidate);
	function propflatvalidate(){
		var msg = "";
		
		buildname = $("#prop_building option:checked").val();
		if(buildname.length < 1){
			msg = "Please enter Builder Name";
			$("#prop_building").addClass("textborderred");
		}else{
			$("#prop_building").removeClass("textborderred");
		}
		
		
		propty = $("input[name='prop_ftype']:checked"). val();
		if(propty == "Flat"){
			if($("#flat_floor_no").val().length < 1){
				msg = "Please enter Flat Floor No";
				$("#flat_floor_no").addClass("textborderred");
			}else{
				$("#flat_floor_no").removeClass("textborderred");
			}
			if($("#flat_no").val().length < 1){
				msg += "Please enter Flat No";
				$("#flat_no").addClass("textborderred");
			}else{
				$("#flat_no").removeClass("textborderred");
			}
			if($("#flatf_rent_amt").val().length < 1){
				msg += "Please enter Rental Amount";
				$("#flatf_rent_amt").addClass("textborderred");
			}else{
				$("#flatf_rent_amt").removeClass("textborderred");
			}
		}else if(propty = "6roomflat"){
			if($("#flat1_no").val().length < 1){
				msg += "Please enter Flat No";
				$("#flat1_no").addClass("textborderred");
			}else{
				$("#flat1_no").removeClass("textborderred");
			}
			if($("#flatf1_rent_amt").val().length < 1){
				msg += "Please enter Rental Value";
				$("#flatf1_rent_amt").addClass("textborderred");
			}else{
				$("#flatf1_rent_amt").removeClass("textborderred");
			}
		}
		
		if(msg.length > 0){
			return false;
		}else{
			return true;
		}
	}
	
	$("input[name$='prop_ftype']").change(function(){
			var value = $(this).val();
			
			if(value == "Flat"){
				$("#flatf").removeClass("div_disable");
				$("#flatf").addClass("div_enable");	
				
				$("#flatf1").addClass("div_disable");
				$("#flatf1").removeClass("div_enable");		
			}else if(value == "6roomflat"){
				$("#flatf1").removeClass("div_disable");
				$("#flatf1").addClass("div_enable");	
				
				$("#flatf").addClass("div_disable");
				$("#flatf").removeClass("div_enable");
			}
	});
	

});