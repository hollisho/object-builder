# object-builder
Generic object builder


## install
```
composer require hollisho/object-builder
```

## usage

```php
$objectBuilder = ObjectBuilder::build(User::class, [
    'id' => 1,
    'username' => 'Hollis'
]);

//get username
var_dump($objectBuilder->username);
```