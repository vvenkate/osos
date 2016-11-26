// Finance Management activity Document
var hostname = "s442410310.onlinehome.us/osos";

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

		$.ajax({url: "http://"+hostname+"/OSOS/index.php/"+parturl, success: function(result){
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

	$("input[name$='exp_type']").change(function(){
		var value = $(this).val();
		
		if(value == "property"){
			divDisplay("#propexpopt");
			divDisplay("#villa");
		}
		if(value == "office"){
			divNoDisplay("#flat");
			divNoDisplay("#warehouse");	
			divNoDisplay("#villa");
			divNoDisplay("#propexpopt");
		}
	});
	
	$("select[name$='inpayment_mode']").change(function(){
		var value = $(this).val();
		
		if(value == "Cheque"){
			divDisplay("#incheque");
		}else {
			divNoDisplay("#incheque");
		}
	});
	
	
	
	//change the fields to show
	$("input[name$='prop_ftype']").change(function(){
			var value = $(this).val();
			
			if(value == "2"){
				divDisplay("#villa");
				divNoDisplay("#flat");
				divNoDisplay("#warehouse");	
				getListBoxUpdate('#villa_no',"property/getlbvilla");
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
				getListBoxUpdate('#wh_no',"property/getlbwarehouse");
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
		getListBoxUpdate('#flat_no',"ticket/getlbflat?id="+val);
	});
	
	$("#expense_save").click(function(){
		var msg = "";
		
		var exp_val = $("input[name='exp_type']:checked"). val();
		
		if(exp_val == "property"){
			//var prop_val = $("#prop_ftype ").val();
			var prop_val = $("input[name='prop_ftype']:checked"). val();
			if(prop_val != ""){
				if(prop_val == "Villa" || prop_val == 2){
					if($("#villa_no option:selected").val().length == 0){
						msg += "Please select Villa";
						$("#villa_no").addClass("textborderred");
					}else{
						$("#villa_no").removeClass("textborderred");
					}
				}
				if(prop_val == "Building" || prop_val == 1){
					if($("#flat_name option:selected").val().length == 0){
						msg += "Please select Building";
						$("#flat_name").addClass("textborderred");
					}else{
						$("#flat_name").removeClass("textborderred");
					}
				}
				if(prop_val == "Warehouse" || prop_val == 3){
					if($("#wh_no option:selected").val().length == 0){
						msg += "Please select Warehouse";
						$("#wh_no").addClass("textborderred");
					}else{
						$("#wh_no").removeClass("textborderred");
					}
				}
			}
		}
		
		
		if($("#expense_date").val().length <=1){
			msg += "Expense Date is missing";
			$("#expense_date").addClass("textborderred");
		}else{
			$("#expense_date").removeClass("textborderred");
		}
		
		if($("#pay_date").val().length <=1){
			msg += "Payment Date is missing";
			$("#pay_date").addClass("textborderred");
		}else{
			$("#pay_date").removeClass("textborderred");
		}
		
		if($("#exp_amt").val().length <1){
			msg += "Payment Date is missing";
			$("#exp_amt").addClass("textborderred");
		}else{
			$("#exp_amt").removeClass("textborderred");
		}
		
		if(msg.length >=1){
			return false;
		}
	});
	
	
	$("#income_save").click(function(){
		var msg = "";
		var prop_val = $("input[name='prop_ftype']:checked"). val();
		if(prop_val != ""){
			if(prop_val == "Villa" || prop_val == 2){
				if($("#villa_no option:selected").val().length == 0){
					msg += "Please select Villa";
					$("#villa_no").addClass("textborderred");
				}else{
					$("#villa_no").removeClass("textborderred");
				}
			}
			if(prop_val == "Building" || prop_val == 1){
				if($("#flat_name option:selected").val().length == 0){
					msg += "Please select Building";
					$("#flat_name").addClass("textborderred");
				}else{
					$("#flat_name").removeClass("textborderred");
				}
			}
			if(prop_val == "Warehouse" || prop_val == 3){
				if($("#wh_no option:selected").val().length == 0){
					msg += "Please select Warehouse";
					$("#wh_no").addClass("textborderred");
				}else{
					$("#wh_no").removeClass("textborderred");
				}
			}
		}
		
		if($("#rent_date").val() <= 0){
			msg += "Please select Actual Rent Date";
			$("#rent_date").addClass("textborderred");
		}else{
			$("#rent_date").removeClass("textborderred");
		}
		
		if($("#inc_amt").val() <= 0){
			msg += "Please select Income Amount";
			$("#inc_amt").addClass("textborderred");
		}else{
			$("#inc_amt").removeClass("textborderred");
		}
		
		if(msg.length >=1){
			return false;
		}
	});
	
	

});