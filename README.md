## LaravelMortgage
[![Latest Stable Version](https://poser.pugx.org/mhiggster/laravel-mortgage/version)](https://packagist.org/packages/mhiggster/laravel-mortgage)
[![Total Downloads](https://poser.pugx.org/mhiggster/laravel-mortgage/downloads)](https://packagist.org/packages/mhiggster/laravel-mortgage)
[![Latest Unstable Version](https://poser.pugx.org/mhiggster/laravel-mortgage/v/unstable)](//packagist.org/packages/mhiggster/laravel-mortgage)
[![License](https://poser.pugx.org/mhiggster/laravel-mortgage/license)](https://packagist.org/packages/mhiggster/laravel-mortgage)

A simple mortgage calculator for Laravel.
Laravel-mortgage allows you to calculate the mortgage in two ways:

#### Annuity

An annuity is a series of payments made at equal intervals. Examples of annuities are regular deposits to a savings account, monthly home mortgage payments, monthly insurance payments and pension payments. Annuities can be classified by the frequency of payment dates.

#### Differentiated payment

Differentiated payment - this is an unequal monthly tranche proportionally reduced during the loan term. The largest payments - in the fourth quarter. “Median” payments are usually comparable to annuities.

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
* [Example](#example)
* [Change log](#Change-log)
* [License](#license)

## Usage


the Mortgage gives you two facades: 
`Annuity` and `Differentiated`
These facades gives you the following methods to use:

### Annuity::getLoanTerm()

Simple getter which retrieves the loan term. Period for which the debtor must repay the loan

```php
Annuity::getLoanTerm() // 48
```

### Annuity::getLoanAmount()

Simple getter which retrieves the loan amount. The method allows you to find out 
how much the debtor took a loan

```php
Annuity::getLoanAmount() // 8000000
```

### Annuity::getInterestRate()

Simple getter which retrieves the interest rate. at what interest rate did the lender give a loan

```php
Annuity::getInterestRate() // 18
```

### Annuity::getMainDept()

Simple getter which retrieves the main dept. You can round them as you want

```php
Annuity::getMainDept() // 166666.66666667
```

### Annuity::showRepaymentSchedule()

This method returns a collection, which helps to find out `termInMonth`, `totoalDept`, `percentDept`, `mainDept`, `indebtedness` using this data you can build a repayment schedule. an example you can see below

```php
Annuity::showRepaymentSchedule()
```

### Annuity::getPercentAmount()

Amount accrued as a percentage

```php
Annuity::getPercentAmount()
```

### Annuity::effectiveRate()

The effective annual interest rate is the interest rate that is actually earned or paid on an investment.

```php
Annuity::effectiveRate()
```

### Annuity::getTotalamount()

The total amount payable to the debtor

```php
Annuity::getTotalamount()
```
Similarly, all of these methods are available on the Differentiated facade.

## Example

Below is a little example of how to list the cart content in a table:

```php
 TODO
```


## Change log

Detailed changes for each release [changelog](https://github.com/Mhiggster/laravel-mortgage/blob/master/changelog.md)

## License

[MIT](https://github.com/Mhiggster/laravel-mortgage/blob/master/LICENSE)

Copyright (c) 2019-present, Miras Nurmukhanbetov