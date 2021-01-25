# JSON API Test

## The Problem
 
We are working with an outside data service company named `Fakebook`. You are a developer at AET that needs to parse responses from `FakeBook's` API endpoint. Unfortunately, `Fakebook` updates their API response JSON without notification :(

For example...
 
Initially, their response data was formatted as
```
{ 
    "text": COMPANY DATA, 
    "creation_date": DATE
}
```

First, they updated to their json data to
```
{
    "id": 1, 
    "data": 
    {
        "text": COMPANY DATA, 
        "creation_date" : DATE
    }
}
```

Later, they updated to:
```
{
    "response" : 
    {
        "id": 1, 
        "data": 
        {
            "text": COMPANY DATA, 
            "creation_date" : DATE
        }
    }
}
```

And then, they updated their response data to
```
{
    "id": 1, 
    "text": COMPANY DATA, 
    "data": {
        "creation_date": DATE
    }
}
```

You can assume the following about their response data:
 
1. The response data is always valid json string 
1. The response data will always have two fields: "text" and "creation_date"
1. The structure of the data is always changing

## Instructions

+ Ensure php74 and composer is installed on your system
+ Run `composer install`
+ Run the command `./vendor/bin/phpunit` - ensure that you can see the failing unit tests

## Goal 

There are five method stubs in `src/Parser.php`

+ `checkDecoded`
+ `htmlDecode`
+ `locate`
+ `sortDate`
+ `parse`
 
Create these methods and ensure that they pass the unit tests in `test/ParserTest.php`.

When you are done, commit you changes to `src/Parser.php`.
