# Scholar Plot
Visualize a scholar's accomplishments at a glance!

![Publication](https://cloud.githubusercontent.com/assets/5505099/10435182/e6efd28e-70e3-11e5-9e95-90fed7a29275.png "An example of ScholarPlot Publication")

![Funding](https://cloud.githubusercontent.com/assets/5505099/10527953/f34c897e-7358-11e5-9e19-3d26dc0f19e1.png "An example of ScholarPlot Funding")

## Supported Browsers
Scholar Plot runs best on following browsers.

* Google Chrome: latest version
* Safari: latest version
* Firefox: latest version
* Internet Explorer: 10+
* Opera 15+

## Funding dataset
* NSF: FY 1985 - FY 2013 (29 years, 312,311 rows, 10,769/year)
* NIH: FY 2000 - FY 2013 (14 years, 777,657 rows, 55,456/year)
* NASA: FY 2007 - FY 2015 (9 years, 16,670 rows, 1,852/year)

## Changelog

**10/20/2015** Changes:
* Redesigned the getSortedCoAuthorString prototype
* getSortedCoAuthorString(coAuthorArray, displayCount)
* Created two DIV pannels at bottom of Publiction plot
* <div id="panel" class="panel" style="display:none">
		<div id="AuthorPanel" class ='left'></div>
		<div id="JournalPanel" class ='right'></div>
	</div>
* Added JSON output


## Changelog

**10/18/2015** Changes:
* Released the new version with NASA dataset and Facebook Social Plugins.
![Funding](https://cloud.githubusercontent.com/assets/5505099/10566490/d3210bb4-75ad-11e5-9254-856c36882df6.png "An example of ScholarPlot Funding with NASA")
* ScholarPlot v1.4 relesed in iTunes Store
* Support for iOS 9 released
* https://itunes.apple.com/us/app/scholar-plot/id819606976?mt=8

**10/16/2015** Changes:
* Added NASA dataset: FY 2007 - FY 2015 (9 years, 16,670 rows, 1,852/year)
* Database tables: 'nasa_award', 'nasa_awardinvestigators`
* Implemented nasa.php to fetch data
* Redesigned the function for total funding amount (simpler, cleaner)
* Added Facebook Social Plugins - Like Button, Page Plugin
* Refined initial page load (hiding the dialog box for insertion)

**10/09/2015** Changes:

* Fixed Hang on invalid URLs.
* Fixed Triangle size bug.
* Fixed Special characters issues on all browsers.
* Updated JCR database.
* 2013 JCR 8812
* 2014 JCR 11867 (3055 more)
* 35% increase in the number of journals.


**07/10/2015** Changes:
* Added Log scale and funding plots in Comparison plot
* New Interface - Tab menu allows to keep the results of plots


**07/03/2015** Changes:

* Fixed new author ordering
* Finished Highlighted line on the plot
* Added dots(…) et al.
* Have deployed it to the production site
* Added Comparison plot feature

**06/26/2015** Changes:

* Author list for conference and patents
* Mouse click event to hold tooltips
* New tooltip formats (next slide)
* External link to publications' information
* Updated name disambiguation
* Updated piwik analytics tool
* Display co-author names
* Add main author to top of co author list if not present
* Visualization for number of publications
* Sort by publication count
* Sort by name
* Display max 7 authors

**04/24/2014** Changes:

* Registered the domains (scholarplot.com, scholarplot.org)
* Initial Release for Web


**03/05/2014** Changes:

* ScholarPlot v1.0 for iOS 6 released in Apple Store
* https://itunes.apple.com/us/app/scholar-plot/id819606976?mt=8

**08/2013** Changes:

* Project kickoff started with iPhone version
