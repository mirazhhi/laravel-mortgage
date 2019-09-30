## LaravelMortgage
[![Latest Stable Version](https://poser.pugx.org/mhiggster/laravel-mortgage/version)](https://packagist.org/packages/mhiggster/laravel-mortgage)
[![Total Downloads](https://poser.pugx.org/mhiggster/laravel-mortgage/downloads)](https://packagist.org/packages/mhiggster/laravel-mortgage)
[![Latest Unstable Version](https://poser.pugx.org/mhiggster/laravel-mortgage/v/unstable)](//packagist.org/packages/mhiggster/laravel-mortgage)
[![License](https://poser.pugx.org/mhiggster/laravel-mortgage/license)](https://packagist.org/packages/mhiggster/laravel-mortgage)

A simple mortgage calculator for Laravel.

## Installation

Install the package through [Composer](http://getcomposer.org/). 

Run the Composer require command from the Terminal:

    composer require mhiggster/laravel-mortgage
    
Add a new line to the `providers` array:

    Mortgage\MortgageServiceProvider::class,

And optionally add a new line to the `aliases` array:

    'DifferentiatedPayment' => Mortgage\Facades\DifferentiatedPayment::class,
    'Annuity' => Mortgage\Facades\Annuity::class,

And then publish the config file

    php artisan vendor:publish --provider="Mortgage\MortgageServiceProvider"

Now you're ready to start using the laravel-mortgage in your application.

## Overview
Look at one of the following topics to learn more about LaravelMortgage

* [Usage](#usage)
* [Exceptions](#exceptions)
* [Example](#example)

## Usage

The mortgage gives you the following methods to use:

### Annuity::getLoanTerm() / Differentiated::getLoanTerm()

Simple getter which retrieves the loan term

```php
Annuity::getLoanTerm() // 48
```
### Annuity::getLoanAmount()

Simple getter which retrieves the loan amount

```php
Annuity::getLoanAmount() // 8000000
```

### Annuity::getInterestRate()

Simple getter which retrieves the interest rate

```php
Annuity::getInterestRate() // 18
```

### Annuity::getMainDept()

Simple getter which retrieves the main dept. You can round them as you want

```php
Annuity::getMainDept() // 166666.66666667
```

### Annuity::showRepaymentSchedule()

Rendering Schedule by periods

```php
Annuity::showRepaymentSchedule()
```

### Annuity::getPercentAmount()

Rendering Schedule by periods

```php
Annuity::getPercentAmount()
```

### Annuity::effectiveRate()

Rendering Schedule by periods

```php
Annuity::effectiveRate()
```

### Annuity::getTotalamount()

Rendering Schedule by periods

```php
Annuity::getTotalamount()
```


Lorem ipsum dolord sit amet, consectetur adipisicing elit. Ab ullam quisquam ex, quo. Molestiae accusantium ut quis libero repellat ratione dolorum, illo nulla in cumque officia, eaque quaerat suscipit perferendis.


## Exceptions

TO DO

## Example

Below is a little example of how to list the cart content in a table:

```php

```