// Tenant Management activity Document
var hostname = "s442410310.onlinehome.us";

function divDisplay(elementid){
	$(elementid).removeClass("div_disable");
	$(elementid).addClass("div_enable");
}

//function to hidden the display div or element
function divNoDisplay(elementid){
	$(elementid).addClass("div_disable");
	$(elementid).removeClass("div_enable");
}
//GEneric ajax call update.
	//url value should be get after "index.php/"
	//listboxid - should be id of the select/listbox
	function getListBoxUpdate(listboxid,parturl){
		$(listboxid+' option').remove();
		$(listboxid).append($('<option/>',{value:"",text:"---None---"}));

		$.ajax({url: "http://"+hostname+"/osos/OSOS/index.php/"+parturl, success: function(result){
		var arrBuilder = jQuery.parseJSON(result);
		$.each(arrBuilder, function (index, value) {
				$(listboxid).append($('<option/>', { 
					value: value.key,
					text :  value.val
				}));
			}); 
		}});
	}
$(document).ready( function() {

	
	//change the fields to show
	$("input[name$='prop_ttype']").change(function(){
			var value = $(this).val();
			
			if(value == "2"){
				divDisplay("#villa");
				divNoDisplay("#flat");
				divNoDisplay("#warehouse");	
				getListBoxUpdate('#villa_no',"property/getlbvilla?occupy=2");
			}
			if(value == "1"){
				divNoDisplay("#villa");
				divDisplay("#flat");
				divNoDisplay("#warehouse");
				getListBoxUpdate('#flat_name',"property/getlbbuilder");
			}
			if(value == "3"){
				divNoDisplay("#villa");
				divNoDisplay("#flat");
				divDisplay("#warehouse");
				getListBoxUpdate('#wh_no',"property/getlbwarehouse?occupy=2");
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
	
	$("#flat_name").change(function(){
		var val = $(this).val();
		getListBoxUpdate('#flat_no',"ticket/getlbflat?id="+val+"&occupy=2");
	});
	
	$("#tenant_save").click(function(){
		var msg = "";
		
		//var prop_val = $("#prop_ttype").val();
		var prop_val = $('input[name=prop_ttype]:checked').val();
		if(prop_val != ""){
			if(prop_val == "Villa" || prop_val == 2){
				if($("#villa_no option:selected").val().length <= 0){
					msg += "Please select Villa";
					$("#villa_no").addClass("textborderred");
				}else{
					$("#villa_no").removeClass("textborderred");
				}
			}
			if(prop_val == "Building" || prop_val == 1){
				if($("#flat_name option:selected").val().length <= 0){
					msg += "Please select Building";
					$("#flat_name").addClass("textborderred");
				}else{
					$("#flat_name").removeClass("textborderred");
				}
			}
			if(prop_val == "Warehouse" || prop_val == 3){
				if($("#wh_no option:selected").val().length <= 0){
					msg += "Please select Warehouse";
					$("#wh_no").addClass("textborderred");
				}else{
					$("#wh_no").removeClass("textborderred");
				}
			}
		}
		
		var fn = $("#first_name").val();
		if($("#first_name").val().length <=1){
			msg += "First Name is missing";
			$("#first_name").addClass("textborderred");
		}else{
			$("#first_name").removeClass("textborderred");
		}
		
		if($("#last_name").val().length <=1){
			msg = "Last Name is missing";
			$("#last_name").addClass("textborderred");
		}else{
			$("#last_name").removeClass("textborderred");
		}

		if($("#dob").val().length <=1){
			msg = "DOB is missing";
			$("#dob").addClass("textborderred");
		}else{
			$("#dob").removeClass("textborderred");
		}
		
		if($("#contact_no").val().length <=1){
			msg = "Contant No is missing";
			$("#contact_no").addClass("textborderred");
		}else{
			$("#contact_no").removeClass("textborderred");
		}
		
		if($("#nationality").val().length <=1){
			msg = "Nationality is missing";
			$("#nationality").addClass("textborderred");
		}else{
			$("#nationality").removeClass("textborderred");
		}
		
		if($("#tentcont_sd").val().length <=1){
			msg = "Start Date is missing";
			$("#tentcont_sd").addClass("textborderred");
		}else{
			$("#tentcont_sd").removeClass("textborderred");
		}
		
		if($("#tentcont_ed").val().length <=1){
			msg = "End Date is missing";
			$("#tentcont_ed").addClass("textborderred");
		}else{
			$("#tentcont_ed").removeClass("textborderred");
		}
		
		if($("#tenant_rent").val().length <=1){
			msg = "Rent value is missing";
			$("#tenant_rent").addClass("textborderred");
		}else{
			$("#tenant_rent").removeClass("textborderred");
		}
		
		
		if(msg.length >=1){
			return false;
		}
	});
	

});