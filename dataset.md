## Dataset explained!

#### JCR Impact Factor
* 11,867 records in our database.
* 35% increase in the number of journals compared to previous data

#### NSF - National Science Foundation
* FY 1985 - FY 2013 (29 years, 312,311 rows, 10,769/year)
* http://www.nsf.gov/awardsearch/download.jsp


#### NIH - National Institutes of Health
* FY 2000 - FY 2013 (14 years, 777,657 rows, 55,456/year)
* http://exporter.nih.gov/ExPORTER_Catalog.aspx

#### NASA - National Aeronautics and Space Administration
* FY 2007 - FY 2015 (9 years, 16,670 rows, 1,852/year)
* https://www.research.gov/research-portal/appmanager/base/desktop?_nfpb=true&_eventName=viewQuickSearchFormEvent_so_rsr

## More Agencies

#### DHS
#### DOD
#### DARPA
#### Department of Engergy
#### Department of Education (ED)
#### Department of Transforation
http://www.grants.gov/web/grants/learn-grants/grant-making-agencies.html


## Function in Excel to split First and Last name
FirstName
* =LEFT(F2,FIND("[",SUBSTITUTE(F2," ","[",LEN(F2)-LEN(SUBSTITUTE(F2," ",""))))-1)

LastName
* =RIGHT(F2,LEN(F2)-FIND("*",SUBSTITUTE(F2," ","*",LEN(F2)-LEN(SUBSTITUTE(F2," ","")))))
