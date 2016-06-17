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
* When floating the cursor over a coauthor name, joint papers with focual author should light up to indicate the pattern and placement of coauthors papers


## Changelog
**06/17/2016** Changes:
* Updated the Academic Garden with cloude and have tooltips fixed.
![screen shot 2016-06-17 at 2 29 25 pm](https://cloud.githubusercontent.com/assets/5505099/16162292/1e701e8a-3498-11e6-8e96-8a2492c8c094.png)


## Changelog
**06/16/2016** Changes:
* 441 records updated for funding bug fixes due to min year and name

**06/14/2016** Changes:
* Group Compare released

**06/07/2016** Changes:
* Academic Garden released
* ![](https://cloud.githubusercontent.com/assets/5505099/14969574/adf952d0-1088-11e6-8975-94df6a0b40d4.png)

**04/25/2016** Changes:
* All new updates released.
* CSS / HTML / Contents are all updated.

## Changelog
**04/12/2016** Changes:
* Search for schools and summary
![Fig](https://cloud.githubusercontent.com/assets/5505099/14481886/c6539e80-00fc-11e6-8c2d-b4ce4c289350.png)


## Changelog
**03/28/2016** Changes:
* Release the department and college plot
![Fig](https://cloud.githubusercontent.com/assets/5505099/14094419/c7ffd42a-f51b-11e5-97c0-443c459abc38.png)

**02/22/2016** Changes:
* Data collection starts

**02/19/2016** Changes:
* New schema design `Scholar-dept` and `Scholar-author`

**02/08/2016** Changes:
* Data collection form design and refinement

**01/18/2016** Changes:
* Pie charts (rearranged, subtitle)
![Fig](https://cloud.githubusercontent.com/assets/5505099/12399152/d107055e-bddd-11e5-8fc0-00c7709ac568.png)

**12/13/2015** Changes:
* Boxplot updated
* 5 new charts

**12/18/2015** Changes:
* Departmental Compare and new Menu - Boxplot
![Boxplot](https://cloud.githubusercontent.com/assets/5505099/11938891/9d5e6e6e-a7e3-11e5-9b85-a3baec09cf1e.png)
![Boxplot2](https://cloud.githubusercontent.com/assets/5505099/11938908/b9e94da6-a7e3-11e5-8e4c-03e374d7c0c5.png)

**12/11/2015** Changes:
* Complete Departmental Plot is and new Menu
* Departmental Plot is Out
* http://www.scholarplot.com/blog/index.html
![New Menu](https://cloud.githubusercontent.com/assets/5505099/11642054/79924d62-9d01-11e5-8bf4-ec8d35bede32.png)

**12/01/2015** Changes:
* Added the mean IF value in PHP and HTML
* Rename the variable and add the variables

**11/25/2015** Changes:
* Open an issue to avoid overlapping series: https://github.com/nvd3-community/nvd3/issues/92
![Down](https://cloud.githubusercontent.com/assets/5505099/11411101/74e19cdc-9392-11e5-90a9-9d7287c8dade.png)


**11/15/2015** Changes:
* Setup cookies for avoding Google Server Error
* Issues closed https://github.com/Kyeongan/ScholarPlot/issues/7
* Department plot draft - Need idea what data and charts are useful.

**11/13/2015** Changes:
* Google Scholar gives an errors when it is being requested with privite browsing.
![Down](https://cloud.githubusercontent.com/assets/5505099/11165876/d3bc0110-8ae2-11e5-8ef0-124f0bd89093.png)

**11/11/2015** Changes:
* Updated images for the help page.

**11/10/2015** Changes:
* Remove `... et al.` when Top 5 Most Cited Paper and Top 5 Journals
* Remove the horizontal line in panel by adjusiting `margin-right: 5em` in CSS

**11/09/2015** Changes:
* Departmental visualization initial design
* Fixed the height size of publicatio plot when legends interact
* ScatterChart.js (Line 206)

**11/04/2015** Changes:
* Add 5 meta tages for sharing Best Practices for Websites & Mobile Apps
* https://developers.facebook.com/tools/debug/og/object/
* Adjected the footer section

**11/01/2015** Changes:
* Deploy the features to the production server.
* Top 5 Journals by Impact Factor
* Top 5 Most Cited Papers
* Better way to deal with space of middle efficiently

**10/27/2015** Changes:
* Removed the horizontal scroll of page by adjusting `text-align:center; margin: 0 auto;` and `width:99%` in `main.css`
* In order to adjust panel sizes, change the number multiplied by count
* `(sorted[index].count * 2.0) -> 1.5` in 324 line
* Forced no line break of the authors name and bar charts section by new CSS
* `.nowrap {white-space: nowrap};`
* 102 entries to `scholar_autocomplete`
* Started Facebook ADs

**10/26/2015** Changes:
* Update php for ordering by Impact Factor (Put `-` value down)
* Update piwik to the new version 2.15.0
* Database Upgrade from 2.14.3 to the new version 2.15.0
* `php E:\sites\cpl\kyeongan\projects\piwik/console core:update`
* Different alignment of Journal Panels

![Type 1](https://cloud.githubusercontent.com/assets/5505099/10747182/5db95524-7c20-11e5-85b6-85494b842b7c.png)
![Type 2](https://cloud.githubusercontent.com/assets/5505099/10747183/5dd4e258-7c20-11e5-880c-0618ae038df6.png)

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
