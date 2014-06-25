$(document).ready(function(){
	$("#Status").popover({
		html : true, 
		content: function() {
			return $('#dialogHC').html();
		},
		title: function() {
			return $('#dialogHT').html();
		},
		placement: 'left'
	});
	$(document).on("change", "#selectStatus",function() {
		status = $(this).val()
	});
	$(document).on("click", "#Status",function() {
		status = 1;
	});

	
	$(document).on("click", "#sendStatus", function() {
		$.post("",
		{
			status: status
		},
		function(data,status){
			if(status=="success"){
				console.log(data+": success");
				location.reload();
			}
			else{
				console.log("Error.");
			}
		});
	});

	//======================================================================
	url="delete/"+$("#delete").data("value")+".php";
	$("#delete").unbind("click").click(function(){
	user = $("#user").text().substring(7,$("#user").text().length);

		if(user=="Magdiel"){
			if(confirm("Está seguro que desea borrar esto?")){
			if(confirm("Está muuuuuy seguro?")){
				if(confirm("Pero muy muy seguro?")){
					if(confirm("Es contigo, Magdiel, estás SEGURO que deseas borrar?!")){
											alert("ok");
					$.post(url,
					{
						delete: "delete"
					},
					function(data,status){
						if(status=="success"){
							console.log(data+": success");
							window.location.href = '/organizer/project/'+data+'.php';
				//location.reload();
			}
			else{
				console.log("Error.");
			}
		});
					}

				}
			}
		}
		}
		else{
			if(confirm("Are you sure you want to delete this task?")){
									$.post(url,
					{
						delete: "delete"
					},
					function(data,status){
						if(status=="success"){
							console.log(data+": success");
							window.location.href = '/organizer/project/'+data+'.php';
				//location.reload();
			}
			else{
				console.log("Error.");
			}
		});
			}
		}
		


		
	});
});



