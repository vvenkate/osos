// Maintenance Ticket Mgmt JS Document
// Unit Management activity Document
//funciton to display the hiddent div or element
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
	
	//change the value of property on chnage of the Property type
	$("input[name$='prop_type']").change(function(){
		var value = $(this).val();
		divNoDisplay("#maint_prop_flat_no");
		divNoDisplay("#label_flat");
		
		
		//adding Building details
		if(value == 1){
			divDisplay("#maint_prop_flat_no");
			divDisplay("#label_flat");			
			getListBoxUpdate('#maint_prop_unit_no',"property/getlbbuilder");
		}
		
		//adding Villa details
		if(value == 2){
			getListBoxUpdate('#maint_prop_unit_no',"property/getlbvilla");
		}
		
		//adding Warehouse details
		if(value == 3){
			getListBoxUpdate('#maint_prop_unit_no',"property/getlbwarehouse");
		}
	});
	//-- END --
	
	
	//on load just remove the dummy option and get the real value from DB.
	getListBoxUpdate('#maint_prop_unit_no',"property/getlbvilla");
	//--- END --
	
	getListBoxUpdate('#issue_type',"ticket/getlbissuetype");
	
	//--during add building give option to select the flat
	$("#maint_prop_unit_no").click(function (){
		var prop_type = $("input[name$='prop_type']:checked").val();
		if(prop_type == 1){
			var build_id = $(this).val();
			if(build_id.length > 0){
				getListBoxUpdate('#maint_prop_flat_no',"ticket/getlbflat?id="+build_id);
			}
		}
		return true;
	});
	//-- END --
	
	//validation on form submission
	$("#main_ticket_btn").click(ticketvalidate);
	
	function ticketvalidate(){
		var msg = "";
		
		if($("#ticket_sum").val().length <=1){
			msg += "Ticket No is missing.";
			$("#ticket_sum").addClass("textborderred");
		}else{
			$("#ticket_sum").removeClass("textborderred");
		}
		
		
		
		if($("#ticket_desc").val().length <=1){
			msg += " Ticket Desc is missing.";
			$("#ticket_desc").addClass("textborderred");
		}else{
			$("#ticket_desc").removeClass("textborderred");
		}
		
		
		//var prop_val = $("#prop_ftype ").val();
		var prop_val = $("input[name='maint_prop_type']:checked"). val();
		if(prop_val != ""){
			if(prop_val == "Villa" || prop_val == 2){
				if($("#maint_prop_unit_no option:selected").val().length == 0){
					msg += "Please select Villa";
					$("#maint_prop_unit_no").addClass("textborderred");
				}else{
					$("#maint_prop_unit_no").removeClass("textborderred");
				}
			}
			if(prop_val == "Building" || prop_val == 1){
				if($("#maint_prop_unit_no option:selected").val().length == 0){
					msg += "Please select Building";
					$("#maint_prop_unit_no").addClass("textborderred");
				}else{
					$("#maint_prop_unit_no").removeClass("textborderred");
				}
			}
			if(prop_val == "Warehouse" || prop_val == 3){
				if($("#maint_prop_unit_no option:selected").val().length == 0){
					msg += "Please select Warehouse";
					$("#maint_prop_unit_no").addClass("textborderred");
				}else{
					$("#maint_prop_unit_no").removeClass("textborderred");
				}
			}
		}
		
		if(msg.length >=1){
			return false;
		}
	}
	//-- END --
});