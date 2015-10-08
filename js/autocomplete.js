$(document).ready(function()
{



}); // document.ready()

// autocomplet : this function will be executed every time we change the text
function autocomplet(param) {

	// param.parentElement.id == "name_list_id";

	// var min_length = 1; // min caracters to display the autocomplete
	// var keyword = param.displayname.value;
	// var list_id = param.getElementsByTagName("ul");

	var min_length = 1; // min caracters to display the autocomplete

	if ( param != 2 )
	{
		var str_displayname = '#displayname';
		var str_name_list_id = '#name_list_id';
	}
	else
	{
		var str_displayname = '#displaynameSecondary';
		var str_name_list_id = '#name_list_id_Secondary';
	}

	var keyword = $(str_displayname).val(); // default for Primary
	//var keyword = $('#displaynameSecondary').val();

	if (keyword.length >= min_length) {
		$.ajax({
			url: './src/autocomplete.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				// list_id.name_list_id.style.display = 'block';
				$(str_name_list_id).show();

				// list_id.name_list_id.dataset = data;
				$(str_name_list_id).html(data);
			},
			focus: function (event, ui) {
				this.value = ui.item.label;
				event.preventDefault(); // Prevent the default focus behavior.
			},
			select: function (event, ui) {
				var originalEvent = event;
				while ( originalEvent )
				{
					if (originalEvent.keyCode == 13)
						originalEvent.stopPropagation();
					if (originalEvent == event.originalEvent)
						break;
					originalEvent = event.originalEvent;

				}
			}

		});
	} else {
		// list_id.name_list_id.style.display = 'none';
		$(str_name_list_id).hide();
	}
}



// set_item : this function will be executed when we select an item
function set_item(google) {
	// change input value
	var googleID = google.getAttribute("data-google-id");
	var googldName = google.getAttribute("data-google-name");

	if(google.parentElement.id == "name_list_id")
	{
		$('#displayname').val(googldName);
		$('#gid').val(googleID);
		$('#name_list_id').hide();
		$("#displaynameSecondary").prop('disabled', false);
	}
	else
	{
		$('#displaynameSecondary').val(googldName);
		$('#gidSecondary').val(googleID);
		$('#name_list_id_Secondary').hide();
	}

}


