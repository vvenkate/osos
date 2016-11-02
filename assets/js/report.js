// Finance Management activity Document
var hostname = "localhost";

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

	$("#report_type").change(function(){
		var value = $(this).val();

		if(value == "Staff"){
			divDisplay("#staff");
			divNoDisplay("#finance");
			divNoDisplay("#property");
		}
		if(value == "Finance"){
			divDisplay("#finance");
			divNoDisplay("#staff");
			divNoDisplay("#property");
		}
		if(value == "Contract"){
			divNoDisplay("#finance");
			divNoDisplay("#staff");
			divNoDisplay("#property");
		}
		if(value  == "Property"){
			divNoDisplay("#finance");
			divNoDisplay("#staff");
			divDisplay("#property");
		}
	});
	
	$("#genreport").click(function(){
		msg = "";
		
		if($("#fin_data_from").val().length <=1){
			msg += "Finance Start date is missing";
			$("#fin_data_from").addClass("textborderred");
		}else{
			$("#fin_data_from").removeClass("textborderred");
		}
		
		if($("#fin_data_to").val().length <=1){
			msg += "Finance End date missing";
			$("#fin_data_to").addClass("textborderred");
		}else{
			$("#fin_data_to").removeClass("textborderred");
		}
		
		if(msg.length >=1){
			return false;
		}else{
			//$.post("http://"+hostname+"/OSOS/index.php/report/financereport");
			var frmmurl = "http://"+hostname+"/OSOSFinal/index.php/report/financereport";
			$("#genfrmreport").attr('action',frmmurl).submit();
			return true;
		}
	});
	
	$("#propgenreport").click(function(){
		msg = "";
		
		if(msg.length >=1){
			return false;
		}else{
			//$.post("http://"+hostname+"/OSOS/index.php/report/financereport");
			var frmmurl = "http://"+hostname+"/OSOSFinal/index.php/report/propertyreport";
			$("#genfrmreport").attr('action',frmmurl).submit();
			return true;
		}
	});	

});