function requestNSFFundingJSONP()
{
	author = g_data.author_fullname;
	var splitAuthorName = author.split(" ");
	var firstname = splitAuthorName[0];
	var normFund = "";
	var lastname = "";
	var middleInitial = ""

	if( splitAuthorName.length > 1 ) {
		lastname = splitAuthorName[ splitAuthorName.length - 1 ];
	}
	
	if( splitAuthorName.length > 2 ) {
		middleInitial = (splitAuthorName[ splitAuthorName.length - 2 ]).substring(0, 1);
	}
	// alert('F:' + firstname + ' M:' + middleInitial + ' L:' +lastname);

	// Get Total Amount of NSF Funding
	var jsonURLNSF = "./src/nsf.php?firstname=" + firstname + "&middleInitial=" + middleInitial + "&lastname=" + lastname;

	nsf_data = [];
	nsf_details_by_year = [];

	$.getJSON(jsonURLNSF,'jsoncallback=?',function(res){

		if( res.Summary != null )
		{
			nsf_summary = [];

			for( var i = 0, j = 0; i < res.Summary.length ; i ++ )
			{
				if ( res.Summary[i].Year >= minYear )
				{
					nsf_summary.push(res.Summary[i]);
					j++;
				}
			}
			for (var i = 0 ; i < nsf_summary.length ; i++)
			{
				if( nsf_summary[i].Year >= minYear )
				{
					normFund = log2(parseFloat(nsf_summary[i].SumOfYear));
					nsf_data.push({x: nsf_summary[i].Year, y: normFund });
				}
			}

			nsf_details = res.Details;
			if( nsf_summary[0] != undefined )
				currentTempYear = nsf_summary[0].Year;
			else
				currentTempYear = minYear;

			push_details = "";
			temp = "";

			for( idx=0 ; idx < nsf_details.length ; idx++ )
			{
				if( nsf_details[idx].Year >= minYear )
				{
					temp = "Year: " + nsf_details[idx].Year +
					"<br>Award ID: " + nsf_details[idx].AwardID +
					"<br>" + nsf_details[idx].AwardAmount +
					"<br>Role: " + nsf_details[idx].Role +
					"<br><br>";

					if( currentTempYear == nsf_details[idx].Year )	// If same year, details information should be concatenated.
					{
						push_details = push_details.concat(temp);
					}
					else
					{
						nsf_details_by_year.push(push_details);
						push_details = temp;
						currentTempYear = nsf_details[idx].Year;
					}
				}
			}
			nsf_details_by_year.push(push_details);	// the ladt entry should be pushed
		}
		requestNIHFundingJSONP(firstname, middleInitial, lastname);//getFundingDetails(firstname,lastname);
	});
}

function requestNIHFundingJSONP(firstname, middleInitial, lastname)
{
	// Get Total Amount of NIH Funding

	var jsonURLNIH = "./src/nih.php?firstname=" + firstname + "&middleInitial=" + middleInitial + "&lastname=" + lastname;

	nih_data = [];
	nih_details_by_year = [];
	total_fund = [];
	total_details_by_year = [];

	$.getJSON(jsonURLNIH,'jsoncallback=?',function(res){
		
		if( res.Summary != null )
		{
			nih_summary = [];

			for( var i = 0, j = 0; i < res.Summary.length ; i ++ )
			{
				if ( res.Summary[i].Year >= minYear )
				{
					nih_summary.push(res.Summary[i]);
					j++;
				}
			}

			for (var i = 0 ; i < nih_summary.length ; i++)
			{
				if( nih_summary[i].Year >= minYear )
				{
					normFund = log2(parseFloat(nih_summary[i].SumOfYear));
					nih_data.push({x: nih_summary[i].Year, y: normFund });
				}
			}

			nih_details = res.Details;
			if( nih_summary[0] != undefined )
				currentTempYear = nih_summary[0].Year;
			else 
				currentTempYear = minYear;

			push_details = "";
			temp = "";

			for (var idx=0 ; idx < nih_details.length ; idx++ )
			{
				if( nih_details[idx].Year >= minYear )
				{

					temp = "Year: " + nih_details[idx].Year +
					"<br>Award ID: " + nih_details[idx].AwardID +
					"<br>" + nih_details[idx].AwardAmount +
					"<br>Role: " + nih_details[idx].Role +
					"<br><br>";

					if( currentTempYear == nih_details[idx].Year )
					{
						push_details = push_details.concat(temp);
					}
					else
					{
						nih_details_by_year.push(push_details);

						push_details = temp;
						currentTempYear = nih_details[idx].Year;
					}
				}
			}
			nih_details_by_year.push(push_details);
		}
		//console.log("total fund = " + total_fund);

		totalSumAmountOfFunding();
	});
}

function totalSumAmountOfFunding()
{
	if( nih_data.length == 0 )
	{
		total_fund = nsf_data;
		total_details_by_year = nsf_details_by_year;
	}
	else if ( nsf_data.length == 0 )
	{
		total_fund = nih_data;
		total_details_by_year = nih_details_by_year;
	}
	else
	{
		var nsf_idx = 0;
		var nsf_idx2 = 0;
		var nih_idx = 0;
		var nih_idx2 = 0;
		var sum = 0;

		while( nsf_idx < nsf_data.length && nih_idx < nih_data.length )
		{
			if ( nsf_data[nsf_idx].x < minYear )
			{
				nsf_idx++;
				continue;
			}
			else if ( nih_data[nih_idx].x < minYear )
			{
				nih_idx++;
				continue;
			}

			if( nsf_data[nsf_idx].x < nih_data[nih_idx].x )
			{
				total_fund.push({ x: nsf_data[nsf_idx2].x, y: nsf_data[nsf_idx2].y });
				total_details_by_year.push('<b>NSF</b><br/>' + nsf_details_by_year[nsf_idx]);
				nsf_idx++;
				nsf_idx2++;
			}
			else if( nsf_data[nsf_idx].x > nih_data[nih_idx].x )
			{
				total_fund.push({ x: nih_data[nih_idx2].x, y: nih_data[nih_idx2].y });
				total_details_by_year.push('<b>NIH</b><br/>' + nih_details_by_year[nih_idx]);
				nih_idx++;
				nih_idx2++;
			}
			else
			{	// Sum = NSF + NIH of same year

				sum = log2(parseFloat(nsf_summary[nsf_idx].SumOfYear) + parseFloat(nih_summary[nih_idx].SumOfYear));
				// if( sum < -4.5 )
				// sum = -4.5;
				total_fund.push({ x: nih_summary[nih_idx].Year, y: sum });

				var temp_combined_details = '<b>NSF</b><br/>' + nsf_details_by_year[nsf_idx] + '<b>NIH</b><br/>' + nih_details_by_year[nih_idx];
				total_details_by_year.push( temp_combined_details );

				nsf_idx++;
				nsf_idx2++;

				nih_idx++;
				nih_idx2++;
			}
		}

		while( nsf_idx2 < nsf_data.length )
		{
			total_fund.push({ x: nsf_data[nsf_idx2].x, y: nsf_data[nsf_idx2].y })
			total_details_by_year.push('<b>NSF</b><br/>' + nsf_details_by_year[nsf_idx]);
			nsf_idx2++;
		}

		while( nih_idx2 < nih_data.length )
		{
			total_fund.push({ x: nih_data[nih_idx2].x, y: nih_data[nih_idx2].y })
			total_details_by_year.push('<b>NIH</b><br/>' + nih_details_by_year[nih_idx]);
			nih_idx2++;
		}

	}

	//console.log(total_fund);
	dfd.resolve();

	if( isSaveAction == true ) {
		$.post( "./src/Insert-Google-Info-Scholar-Autocomplete.php", { gid: document.searchForm.gid.value, gname: document.saveForm.gname.value } );
		$('.dialog').slideToggle();
		isSaveAction = false;
	}

	$.unblockUI();

	// Clear the 'gid' and 'displayname'
	document.searchForm.gid.value = "";
	document.searchForm.displayname.value = "";
	document.saveForm.gid.value = "";

	document.getElementById("save_as_svg").style.display = "block";
}