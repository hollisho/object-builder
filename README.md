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

//or 
$user = HUser::build([
    'id' => 2,
    'username' => 'Hollis Ho'
]);

//get username
var_dump($user->username);
```

## Unit Test

1. 执行指定目录所有用例

```sh
$ ./vendor/phpunit/phpunit/phpunit --configuration phpunit.xml
```

2. 执行指定文件

```sh
$ ./vendor/phpunit/phpunit/phpunit --configuration phpunit.xml --test-suffix TemplateTest.php
```

3. 执行 TemplateTest 用例

```sh
$ ./vendor/phpunit/phpunit/phpunit --configuration phpunit.xml --filter TemplateTest
```

4. 执行 TemplateTest::test01 用例

```sh
$ ./vendor/phpunit/phpunit/phpunit --configuration phpunit.xml --filter TemplateTest::test01
```
