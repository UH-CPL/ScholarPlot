$(document).ready(function() {

//  $('.popup').css({ opacity: 0 });
//  $('.dialog').css({ opacity: 1 });
	$('.dialog').hide();
	
	$('.form-container').submit(function() {
		
		if($('#displayname').val() == $('#displaynameSecondary').val())
		{
			return false;
		}

		if(!$('.form-container .search-field').val() || $('.form-container .search-field').val() == "Type search text here..." || $('.form-container .search-field').val().length < 5 || $('#gid').val().length != 12 ) {
			$('#name_list_id').hide();
			$('input[name="gname"]').val(document.searchForm.displayname.value);
			$('.dialog').hide();
			$('.dialog').slideToggle();

//          $('.dialog').css({ opacity: 0 });
//          $('.dialog').animate(
//              { opacity: 1 },
//              {
//                  duration: 'slow',
//                  easing: 'easeOutBounce'
//              });
			return false;
		} else {

			$.blockUI({ css: {
				border: 'none',
				padding: '15px',
				backgroundColor: '#fff',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: .7,
				color: '#000'
				},
				message: $('#blockMessage')
			});


		}

	});

	$('.form-container .search-field').focus(function() {
		if($(this).val() == "Type search text here...") {
			this.value = "";
		}
	});

	$('.form-container .search-field').keydown(function() {
//      $('.popup').css({ opacity: 0 });
		$('.dialog').hide();
	});


	// dialog close function
	$(".close-image").click(function() {
		$('.dialog').slideToggle();
	});

	// save Form blocking UI
	$("#saveForm").submit(function() {
		var url = document.saveForm.gid.value;
		var gid = getParam('user', url);

		if (gid.length != 12)
		{
			return false;
		}
		else 
		{
			$.blockUI({ css: {
				border: 'none',
				padding: '15px',
				backgroundColor: '#fff',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: .7,
				color: '#000'
				},
				message: $('#blockMessage')
			});
		}
	});


	$(document).keypress(
		function(event){
		 if (event.which == '13') {
			event.preventDefault();
		  }


	});

});

function download_svg(param)
{
	var urifunding;
	var uriplot;
	svgAsDataUri(document.getElementsByTagName("svg")[0], {}, function(uri) {
		uriplot = uri;
	});

	svgAsDataUri(document.getElementsByTagName("svg")[1], {}, function(uri) {
		urifunding = uri;
	});
	// console.log(uriplot);
	// console.log(urifunding);

	if(param == 1)
	{
		$str_url = 'src/ZipGenerator.php?';
		$location = './download/ScholarPlot-Export.zip';
	}
	else
	{
		$str_url = 'src/ZipGenerator.php?comparison=yes';
		$location = './download/ScholarCompare-Export.zip';
	}


	$.ajax({
		url: $str_url,
		type: 'POST',
		data: {"plot1": uriplot, "plot2": urifunding},
		success: function(response) {
			console.log(response);
			if(response === "success")
				window.location = $location;
			else {
				alert("oops.. error downloading... ");
			}
		}
	});
};


function log2(val)
{
	var norm = "";
	norm = Math.log(val) / Math.LN2;
	return norm < -4.5 ? -4.5 : norm ;
}

function log10(val)
{
	if( val == 0 ) return 0;
	var norm = "";
	norm = Math.log(val) / Math.log(10);
	return norm > 4 ? 4.1 : norm;
}

function isBigEnough(element)
{
  return element > 1960;
}

capitalizeFirstLetter = function(str) {
	return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}
