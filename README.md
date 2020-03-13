# Moz Api V2 - PHP Library

MozAPIV2-PHP is an open source PHP library to get query data out of Moz's API v2. 

MozAPIV2-PHP is used to retrieve information out of Moz's API such as Anchor Text Metrics, Final Redirect, Global Top Pages, Global Top Root Domains, Index Meta Data, Link Intersects, Link Status, Linking Root Domains, Link Metrics, Top Pages Metrics, URL Metrics and Usage Data from over 36.5 Trillion different links.

This library is for anyone that is looking to build an SEO tool set for any purpose.

## Dependencies

This library was written on PHP 7.2 and was written using file_get_contents so as not to incur the requirement of PHP-CURL. It does require PHP-JSON however.

## Installation

Download the zip file from the repository and add Moz.php to your php applications path.

Retrieve an access_id and secret from Moz.com. If you dont' have one you can signup for a free account here: https://moz.com/products/api

## Usage

### Table of Contents

* <a href='#configuration'>Brief Example of Use</a>
<hr>

### Brief Example of Use
```php
<?php
// This require_once will vary depending on your php applications specific directory structure
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Moz' . DIRECTORY_SEPARATOR . 'Moz.php';

//initialize the library
$moz = new Moz(your_access_id,your_secret);

//query some data
$result = $moz->urlMetrics("https://www.mediagiantdesign.com/");

//dump the result 
var_dump($result);
```
More detailed examples can be found here <a href="https://www.mediagiantdesign.com/documentation/moz-api-v2-php-library/">Moz API v2 Libaray for PHP</a>.

<hr>

## License

(c) 2020 - Present, Rick Simnett rick@mediagiantdesign.com   
License: MIT
URL: https://www.mediagiantdesign.com/  
