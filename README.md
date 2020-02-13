# Mantis BT

A simple Object Oriented library for 
[Mantis REST API](https://documenter.getpostman.com/view/29959/mantis-bug-tracker-rest-api/7Lt6zkP?version=latest)

## Installation
You can simply Download the Release, and to include the autoloader
```php
require_once '/path/to/your-project/vendor/autoload.php';
```

## Configuration
API utilizes the DotEnv PHP library by Vance Lucas. In the root directory of your application will contain a .env file. 

Set your prometheus URL

    MANTIS_URL='test.domain.com'

Detect an AJAX request
    
    MANTIS_TOKEN='dlfsdf24id3ch5840ivhf05rg8vyh5rt'
    
Tells whether script error messages should be logged library log. Default "true".

    LOG=true
   
## Basic usage
We need to create api object so that we can run it and send the responses back.
```php
$api = new MantisBT();
```
Then We can send request 
```php
$api->getIssuesForProject(1);
```

