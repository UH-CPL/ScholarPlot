## Dataset explained!

### JCR Impact Factor
* 11,867 records in our database.
* 35% increase in the number of journals compared to previous data

### NSF - National Science Foundation
* FY 1985 - FY 2013 (29 years, 312311 rows, 10,769/year)


### NIH - National Institutes of Health
* FY 2000 - FY 2013 (14 years, 777657 rows, 55,456/year)

### NASA
* FY 2007 - FY 2015 (9 years, 16,670 rows, 1,852/year)
* Can download CSV for NSF and NASA
* https://www.research.gov/research-portal/appmanager/base/desktop?_nfpb=true&_eventName=viewQuickSearchFormEvent_so_rsr

## More Agencies

### DHS
### DOD
### Department of Engergy
### Department of Education
### Department of Transforation


## function in Excel
FirstName
=LEFT(F2,FIND("[",SUBSTITUTE(F2," ","[",LEN(F2)-LEN(SUBSTITUTE(F2," ",""))))-1)

LastName
=RIGHT(F2,LEN(F2)-FIND("*",SUBSTITUTE(F2," ","*",LEN(F2)-LEN(SUBSTITUTE(F2," ","")))))
