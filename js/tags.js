function send(term){
	$.ajax({
		url: 'suggestTags',
		type:'GET',
		data :{
			term: term
		},
		dataType:'json', /*most important**/ 
		success:function(data, status){

			$( "#Tags" ).autocomplete({
				source: data
			});
			$( "#Tags" ).autocomplete("search",$("#Tags").val().split(",")[($("#Tags").val().split(",").length)-1]);
			$( "#Tags" ).on( "autocompleteselect", function( event, ui ) {
				var arr = $("#Tags").val().split(",");
				if(arr.indexOf(ui.item.value)==(-1)){
					arr [arr.length-1] = ui.item.value;
					$("#Tags").val(arr);
				}
				event.preventDefault();
			});
			$( "#Tags" ).on( "autocompletefocus", function( event, ui ) {
				var arr = $("#Tags").val().split(",");
				if(arr.indexOf(ui.item.value)==(-1)){
					arr [arr.length-1] = ui.item.value;
					$("#Tags").val(arr);
				}
				event.preventDefault();
			});
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest.responseText);
		}
	});
}
var sender="";

$(document).ready(function(){
	$("#Tags").unbind("keyup").keyup(function(e){
		clearTimeout(sender);
		sender = setTimeout(function(){
			send($("#Tags").val().split(",")[($("#Tags").val().split(",").length)-1])
		},650);
	});
});
