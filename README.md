# object-builder
Generic object builder


## install
```
composer require hollisho/object-builder
```

## usage

```php
$objectBuilder = User::build([
    'id' => 1,
    'username' => 'Hollis Ho'
]);

//get username
var_dump($objectBuilder->username);
```