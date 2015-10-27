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

## New Ideas
* Put servey link
* Pie charts for better insights
* When floating the cursor over a coauthor name, joint papers with focual author should light up to indicate the pattern and placement of coauthors papers
* New Plot for team and department - may be useful but need to redesign

## Changelog

**10/xx/2015** Changes:
* Ordering
** Imfact factor
** Last name
* Deploy New Panels to the production server.
* Facebook AD
* Add UH faculties in Che, Eng, etc
* Patent

**10/27/2015** Changes:
* In order to adjust panel sizes, change the number multiplied by count
* `(sorted[index].count * 2.0) -> 1.5` in 324 line
* Forced no line break of the authors name and bar charts section by new CSS
* `.nowrap {white-space: nowrap};`


**10/26/2015** Changes:
* Update php for ordering by Impact Factor (Put N/A value down)
* Update to the new version 2.15.0
* Database Upgrade from 2.14.3 to the new version 2.15.0
* `php E:\sites\cpl\kyeongan\projects\piwik/console core:update`
* Different alignment of Journal Panels

![Type 1](https://cloud.githubusercontent.com/assets/5505099/10747182/5db95524-7c20-11e5-85b6-85494b842b7c.png)
![Type 2](https://cloud.githubusercontent.com/assets/5505099/10747183/5dd4e258-7c20-11e5-880c-0618ae038df6.png)

**10/23/2015** Changes:
* Added 43 entries to `scholar_autocomplete`

**10/23/2015** Changes:
* Finished new two panels both Co-Authors and Journals
* Bug fixies - IEEE (upper case), Removed Null (`' '`) Authors
![Panel 1](https://cloud.githubusercontent.com/assets/5505099/10701618/130d6706-798a-11e5-8e81-b1693eeb1407.png)
![Panel 2](https://cloud.githubusercontent.com/assets/5505099/10701617/13096be2-798a-11e5-9af4-b1011addc56e.png)

**10/21/2015** Changes:
* Added a parameter in getSortedCoAuthorString to distinguish between author and journal name
* `getSortedCoAuthorString(coAuthorArray, displayCount, isNeedSplit)`
* Compelted Journal Panel
* Updated php script to get counts of journals
* Updated my_sql to my_sqli


**10/20/2015** Changes:
* Redesigned the getSortedCoAuthorString prototype
* `getSortedCoAuthorString(coAuthorArray, displayCount)`
* Created two DIV pannels at bottom of Publiction plot
* `<div id="panel" class="panel" style="display:none">
		<div id="AuthorPanel" class ='left'></div>
		<div id="JournalPanel" class ='right'></div>
	</div>`
* Added JSON output

**10/18/2015** Changes:
* Released the new version with NASA dataset and Facebook Social Plugins.
![Funding](https://cloud.githubusercontent.com/assets/5505099/10566490/d3210bb4-75ad-11e5-9254-856c36882df6.png "An example of ScholarPlot Funding with NASA")
* ScholarPlot v1.4 relesed in iTunes Store
* Support for iOS 9 released
* https://itunes.apple.com/us/app/scholar-plot/id819606976?mt=8

**10/16/2015** Changes:
* Added NASA dataset: FY 2007 - FY 2015 (9 years, 16,670 rows, 1,852/year)
* Database tables: `nasa_award`, `nasa_awardinvestigators`
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
* Added dots(`…`) et al.
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
