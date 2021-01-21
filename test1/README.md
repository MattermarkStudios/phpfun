AET PHP Aptitude Test

 * Scenario: 
 
 We are working with an outside data service company named Fakebook.
  
 Their api is a well formed RESTful api, but they change their api format without notice all the time.
 While their data is always valid json string, and the data will always have two fields “text” and “creation_date”,
 the structure of the data is always changing.
 
 One time they had rows like 
 
 {“text”: COMPANY DATA, “creation_date” : DATE}
 
 Later they updated to 
 {“id”: 1, “data”: 
     {
     “text”: COMPANY DATA, 
     “creation_date” : DATE
     }
 }
 

 Later they updated to 
 {“response” : 
     {
         “id”: 1, 
         “data”: 
         {
             “text”: COMPANY DATA, 
             “creation_date” : DATE
         }
     }
 }
 
 Later they emitted like 
 {
     “id”: 1, 
     “text”: COMPANY DATA, 
     “data”: {
         “creation_date”: DATE
     }
 }
 
 Later they added more layers to identify all the protocols and metadata.
 
 They do these updates without any notification.
 
 They also escape the “text” field. 
 
 Our company name, American Estate &amp; Trust,is written as American Estate &amp;amp; Trust  in their database. 
 When we read the data and make an update to the outside data service, 
 our company name is now saved as American Estate &amp;amp;amp; Trust. 
 Eventually we are going to have a very long company name that we had to edit manually. 
 We do not know how many times we updated our own data, as we have several bots that do the work. 
 We may have other html entity escape issues in the “text” string, 
 such as &amp;lpar;  &amp;gt;
 


* Task:
 Write a code that will parse the outside response into clean arrays that shows just the creation date and the text.
 The result should be sorted by the creation date showing the oldest first.

