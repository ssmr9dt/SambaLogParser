# SambaLogParser

# Quick start

## Installation
```
composer require  ssmr9dt/sambalogparser
```

Reference test/start.php

## How to Use
```php
require __DIR__ . "/../vendor/autoload.php";

$SambaLogParser = new ssmr9dt\SambaLogParser();

$SambaLogParser->addFile("/var/log/samba/log.ssmr9dt");
$logs = $SambaLogParser->getTimestamps();

for ($i=0; $i<count($logs); $i++)
{
  echo $logs[$i] . "\n";
}
```

# License
This software is released under the MIT License, see LICENSE.
