$(document).ready(function()
{
	if(typeof tinymce !== 'undefined')
	{
		//propiedades del editor
		tinymce.init({
			selector : 'textarea',
			plugins: "noneditable table textcolor insertdatetime",
			visual_table_class: "editorTable",
			table_default_styles: {
				borderWidth: '2'
			},
			tools: "inserttable",
			noneditable_leave_contenteditable: true,
			height : 200,
			//content_css : "../css/xModifica/drag/style.css",
			statusbar: false,
			language : 'es',
			menubar: false,
			//menubar: "tools table format view insert edit",
			toolbar:[
			"backcolor forecolor source | bold italic subscript superscript underline | bullist numlist outdent indent | alignleft aligncenter alignright alignjustify | table | insertdatetime ",
			],
			insertdatetime_formats: ["%d - %m - %Y", "%I:%M:%p"]
			//plugins: "autosave"
		});
	}

	//Check if the project is initiated.
	$('.menu-link').click(function()
	{
		if($(this).attr('data-status') == 0)
		{
			var popup = confirm('Do you want to initiate this project?');

			if(popup)
			{
				$.ajax({
					url: 'project/initiate',
					type: 'POST',
					data : {
						project: $(this).text()
					},
					dataType: 'JSON',
					success: function(data, status)
					{
						if(data.status)
							window.location.replace(data.url);

						else
							alert(data.error);
					},

					error: function(XMLHttpRequest, textStatus, errorThrown)
					{
						console.log('error');
					}
				});
			}
		}

		else
			return true;

		return false;
	});
});