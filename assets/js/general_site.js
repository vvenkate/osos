// General Site activity Document
$(document).ready( function() {
	var edurow = 2;
	
	//to add education details
	$("#addEdu").click(function(){
			var edu_input1name = "edu_degree"+edurow;
			var edu_input2name = "edu_year"+edurow;
			var edu_input3name = "edu_college"+edurow;
			
			edu_column1= document.createElement("div");
			edu_column1.className = "col-xs-6 col-md-4 group-mail";
			
			//input label
			edu_inputcol1lab = document.createElement("label");
			edu_inputcol1lab.setAttribute("for",edu_input1name);
			edu_inputcol1lab.innerHTML = "Degree";
			
			//input text
			edu_inputcol1 = document.createElement("input");
			edu_inputcol1.type = "text";
			edu_inputcol1.name = edu_input1name;
			edu_inputcol1.id = edu_input1name;
			edu_inputcol1.className = "form-control";
			edu_inputcol1.setAttribute("placeholder","B.Sc or B.S");
			
			edu_column1.appendChild(edu_inputcol1lab);
			edu_column1.appendChild(edu_inputcol1);
			
			edu_column2= document.createElement("div");
			edu_column2.className = "col-xs-6 col-md-4 group-mail";
			
			//input label2
			edu_inputcol2lab = document.createElement("label");
			edu_inputcol2lab.setAttribute("for",edu_input2name);
			edu_inputcol2lab.innerHTML = "Year of Passing";
						
			//input text2
			edu_inputcol2 = document.createElement("input");
			edu_inputcol2.type = "text";
			edu_inputcol2.name = edu_input2name;
			edu_inputcol2.id = edu_input2name;
			edu_inputcol2.className = "form-control";
			edu_inputcol2.setAttribute("placeholder","YYYY");
			
			edu_column2.appendChild(edu_inputcol2lab);
			edu_column2.appendChild(edu_inputcol2);
			
			edu_column3= document.createElement("div");
			edu_column3.className = "col-xs-6 col-md-4 group-mail";
			
			//input label3
			edu_inputcol3lab = document.createElement("label");
			edu_inputcol3lab.setAttribute("for",edu_input2name);
			edu_inputcol3lab.innerHTML = "University/College";
			
			//input text3
			edu_inputcol3 = document.createElement("input");
			edu_inputcol3.type = "text";
			edu_inputcol3.name = edu_input3name;
			edu_inputcol3.id = edu_input3name;
			edu_inputcol3.className = "form-control";
			edu_inputcol3.setAttribute("placeholder","YYYY");
			
			edu_column3.appendChild(edu_inputcol3lab);
			edu_column3.appendChild(edu_inputcol3);
			
			//div education row.
			edu_rows_div = document.createElement("div");
			edu_rows_div.className = "row";
			edu_rows_div.appendChild(edu_column1);
			edu_rows_div.appendChild(edu_column2);
			edu_rows_div.appendChild(edu_column3);
			
			$("#edu_rows").append(edu_rows_div);
			
			edurow++;
			$("#edurows").val(edurow-1);
		}
	);
		
	var deprow = 2;
	var rel_array = [{val:'', text: '-- Select one --'},{val:'Spouse', text: 'Spouse'},{val:'Father', text: 'Father'},{val:'Mother', text: 'Mother'},{val:'Boy Child', text: 'Boy Child'},{val:'Girl Child', text: 'Girl Child'}];
	
	//to add Dependents
	$("#addDep").click(function(){
			var edu_input1name = "dep_name"+deprow;
			var edu_input2name = "dep_rel"+deprow;
			var edu_input3name = "dep_age"+deprow;
			
			edu_column1= document.createElement("div");
			edu_column1.className = "col-xs-6 col-md-4 group-mail";
			
			//input label
			edu_inputcol1lab = document.createElement("label");
			edu_inputcol1lab.setAttribute("for",edu_input1name);
			edu_inputcol1lab.innerHTML = "Full Name";
			
			//input text
			edu_inputcol1 = document.createElement("input");
			edu_inputcol1.type = "text";
			edu_inputcol1.name = edu_input1name;
			edu_inputcol1.id = edu_input1name;
			edu_inputcol1.className = "form-control";
			edu_inputcol1.setAttribute("placeholder","Full Name");
			
			edu_column1.appendChild(edu_inputcol1lab);
			edu_column1.appendChild(edu_inputcol1);
			
			edu_column2= document.createElement("div");
			edu_column2.className = "col-xs-6 col-md-4 group-mail";
			
			//input label2
			edu_inputcol2lab = document.createElement("label");
			edu_inputcol2lab.setAttribute("for",edu_input2name);
			edu_inputcol2lab.innerHTML = "Relationship";
						
			//select text2
			var edu_inputcol2 = document.createElement("select")
			edu_inputcol2.name = edu_input2name;
			edu_inputcol2.id = edu_input2name;	
			edu_inputcol2.className = "form-control1";
			
			
			$(rel_array).each(function() {
				var option = document.createElement("option");
				option.text = this.text;
				option.value = this.val;
				edu_inputcol2.add(option);
			 //edu_inputcol2.append($("<option>").attr('value',this.val).text(this.text));
			});
						
			//edu_inputcol2.name = edu_input2name;
			//edu_inputcol2.id = edu_input2name;		
			edu_column2.appendChild(edu_inputcol2lab);
			edu_column2.appendChild(edu_inputcol2);
			
			edu_column3= document.createElement("div");
			edu_column3.className = "col-xs-6 col-md-4 group-mail";
			
			//input label3
			edu_inputcol3lab = document.createElement("label");
			edu_inputcol3lab.setAttribute("for",edu_input2name);
			edu_inputcol3lab.innerHTML = "Age";
			
			//input text3
			edu_inputcol3 = document.createElement("input");
			edu_inputcol3.type = "text";
			edu_inputcol3.name = edu_input3name;
			edu_inputcol3.id = edu_input3name;
			edu_inputcol3.className = "form-control";
			edu_inputcol3.setAttribute("placeholder","22");
			
			edu_column3.appendChild(edu_inputcol3lab);
			edu_column3.appendChild(edu_inputcol3);
			
			//div education row.
			edu_rows_div = document.createElement("div");
			edu_rows_div.className = "row";
			edu_rows_div.appendChild(edu_column1);
			edu_rows_div.appendChild(edu_column2);
			edu_rows_div.appendChild(edu_column3);
			
			$("#dep_rows").append(edu_rows_div);
			
			deprow++;
			$("#deprows").val(deprow-1);
		}
	);

	var werow = 2;
		
	//to add workexperience
	$("#addwe").click(function(){
			var edu_input1name = "we_fdt"+werow;
			var edu_input4name = "we_tdt"+werow;
			var edu_input2name = "we_role"+werow;
			var edu_input3name = "we_name"+werow;
			
			edu_column1= document.createElement("div");
			edu_column1.className = "col-xs-6 col-md-4 group-mail";
			
			//input label
			edu_inputcol1lab = document.createElement("label");
			edu_inputcol1lab.setAttribute("for",edu_input1name);
			edu_inputcol1lab.innerHTML = "Duration";
			
			edu_fgrp = document.createElement("div");
			edu_fgrp.className = "input-group";
						
			//input text
			edu_inputcol1 = document.createElement("input");
			edu_inputcol1.type = "text";
			edu_inputcol1.name = edu_input1name;
			edu_inputcol1.id = edu_input1name;
			edu_inputcol1.className = "form-control";
			edu_inputcol1.setAttribute("placeholder","DD-MM-YYYY");
			
			
			edu_tgrp = document.createElement("div");
			edu_tgrp.className = "input-group";
			//to input text
			edu_inputcol4 = document.createElement("input");
			edu_inputcol4.type = "text";
			edu_inputcol4.name = edu_input4name;
			edu_inputcol4.id = edu_input4name;
			edu_inputcol4.className = "form-control";
			edu_inputcol4.setAttribute("placeholder","DD-MM-YYYY");
			
			
			edu_column1.appendChild(edu_inputcol1lab);
			edu_column1.innerHTML += "<br/>From:";
			edu_fgrp.appendChild(edu_inputcol1);
			edu_fgrp.innerHTML += '<span class="input-group-addon"><a href="#"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>';
			
			edu_column1.appendChild(edu_fgrp);
			edu_column1.innerHTML += "To:";
			edu_tgrp.appendChild(edu_inputcol4);
			edu_tgrp.innerHTML +=  '<span class="input-group-addon"><a href="#"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>';
			edu_column1.appendChild(edu_tgrp);
			
			edu_column2= document.createElement("div");
			edu_column2.className = "col-xs-6 col-md-4 group-mail";
			
			//input label2
			edu_inputcol2lab = document.createElement("label");
			edu_inputcol2lab.setAttribute("for",edu_input2name);
			edu_inputcol2lab.innerHTML = "Designation";
						
			edu_inputcol2 = document.createElement("input");
			edu_inputcol2.type = "text";
			edu_inputcol2.name = edu_input2name;
			edu_inputcol2.id = edu_input2name;
			edu_inputcol2.className = "form-control";
			edu_inputcol2.setAttribute("placeholder","Role");
						
			//edu_inputcol2.name = edu_input2name;
			//edu_inputcol2.id = edu_input2name;		
			edu_column2.appendChild(edu_inputcol2lab);
			edu_column2.appendChild(edu_inputcol2);
			
			edu_column3= document.createElement("div");
			edu_column3.className = "col-xs-6 col-md-4 group-mail";
			
			//input label3
			edu_inputcol3lab = document.createElement("label");
			edu_inputcol3lab.setAttribute("for",edu_input2name);
			edu_inputcol3lab.innerHTML = "Company Name";
			
			//input text3
			edu_inputcol3 = document.createElement("input");
			edu_inputcol3.type = "text";
			edu_inputcol3.name = edu_input3name;
			edu_inputcol3.id = edu_input3name;
			edu_inputcol3.className = "form-control";
			edu_inputcol3.setAttribute("placeholder","Company Name");
			
			edu_column3.appendChild(edu_inputcol3lab);
			edu_column3.appendChild(edu_inputcol3);
			
			//div education row.
			edu_rows_div = document.createElement("div");
			edu_rows_div.className = "row";
			edu_rows_div.appendChild(edu_column1);
			edu_rows_div.appendChild(edu_column2);
			edu_rows_div.appendChild(edu_column3);
			
			$("#we_rows").append(edu_rows_div);
			
			werow++;
			$("#workrows").val(werow-1);
		}
	);
	
	var orgval = 1;
	$("#orgdet").click(function(){
		if(orgval == 1){
			$("#org_det").removeClass("div_disable");
			$("#org_det").addClass("div_enable");
			$("#orgdet_arrow").removeClass("fa-arrow-down");
			$("#orgdet_arrow").addClass("fa-arrow-up");
			orgval = 0;
		}else{
			$("#org_det").removeClass("div_enable");
			$("#org_det").addClass("div_disable");
			$("#orgdet_arrow").removeClass("fa-arrow-up");
			$("#orgdet_arrow").addClass("fa-arrow-down");
			orgval = 1;
		}
		
	});
	
	
	var leaval = 1;
	$("#leadet").click(function(){
		if(leaval == 1){
			$("#lea_det").removeClass("div_disable");
			$("#lea_det").addClass("div_enable");
			$("#leadet_arrow").removeClass("fa-arrow-down");
			$("#leadet_arrow").addClass("fa-arrow-up");
			leaval = 0;
		}else{
			$("#lea_det").removeClass("div_enable");
			$("#lea_det").addClass("div_disable");
			$("#leadet_arrow").removeClass("fa-arrow-up");
			$("#leadet_arrow").addClass("fa-arrow-down");
			leaval = 1;
		}
		
	});
});