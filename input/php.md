---
title: PHP good practices
created_at: 05-07-2020 20:30:00
---
# Code style – PHP

## Access modifiers

Use access modifiers everywhere possible.

In functions:

```php
// Good
public function helloWorld(){}

// Bad
function helloWorld(){}
```

In class properties:
```php

// Good
class Shop
{
    public string $name = 'Awesome Shop';
}

// Bad
class Shop
{
    string $name = 'Awesome Shop';
}
```

## Types

Use static typing everywhere possible.

```php
// Good
public function getName(int $id): string {}

// Bad
public function getName(int $id): {}

// Worse
public function getName($id): {}
```

```php
// Good
class Shop
{
    public string $name = 'Awesome Shop';
}

// Bad
class Shop
{
    public $name = 'Awesome Shop';
}
```
