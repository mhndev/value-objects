# Common Value Objects

##### Common mostly used Value Objects I confronted through my own Projects


##### sample codes

```php

use mhndev\valueObjects\implementations\Email;
use mhndev\valueObjects\implementations\MobilePhone;
use mhndev\valueObjects\implementations\Token;
use mhndev\valueObjects\implementations\Version;

$mobileObject = MobilePhone::fromOptions('989124444444');

echo $mobileObject->format(MobilePhone::WithZero);

### output : 09124444444

echo $mobileObject->format(MobilePhone::WithoutZero);

### output : 9124444444

echo $mobileObject->isMCI(MobilePhone::WithoutZero);

### output : true

echo $mobileObject->isMTN(MobilePhone::WithoutZero);

### output : false

$emailObject = new Email('info@example.com');

echo $emailObject->getDomain();

### output : example.com

echo $emailObject->getLocal();

### output : info


$tokenObject = new Token(
    'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImVhMTY3OTQ',
    Token::SCHEMA_Bearer,
    6000
);

echo $tokenObject->getType();

### output : Bearer

echo $tokenObject->getExpiresAt()->format('Y-m-d H:i:s');

### output : 2018-12-03 08:05:22


$port = Version::fromString('6.5.0');


echo $port->getMajor();
### output : 6


echo $port->getMinor();
### output : 0


echo $port->getPatch();
### output : 5


```

#### you can find more examples by digging in source.