# Connecteur Laravel Monetico

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pmilinvest/monetico.svg?style=flat-square)](https://packagist.org/packages/pmilinvest/monetico)
[![Total Downloads](https://img.shields.io/packagist/dt/pmilinvest/monetico.svg?style=flat-square)](https://packagist.org/packages/pmilinvest/monetico)
![GitHub Actions](https://github.com/pmilinvest/monetico/actions/workflows/main.yml/badge.svg)

Facilite l'utilisation de l'API Monetico sous Laravel

## Installation

Vous pouvez installer le package avec composer:

```bash
composer require pmilinvest/monetico
```

## Configuration
Vous devez renseigner les identifiants API grâce aux fichier .env de votre application.


```php
MONETICO_EPT_CODE=
MONETICO_SECURITY_KEY=
MONETICO_COMPAGNY_CODE=
```

##Usage

### Monetico
```php
use Pmilinvest\Monetico\Monetico;

$monetico = new Monetico(
'EPT_CODE',
'SECURITY_KEY',
'COMPANY_CODE'
);

```


### Purchase
```php
use PmilInvest\Monetico\Monetico;
use PmilInvest\Monetico\Requests\PurchaseRequest;
use PmilInvest\Monetico\Resources\BillingAddressResource;
use PmilInvest\Monetico\Resources\ShippingAddressResource;
use PmilInvest\Monetico\Resources\ClientResource;

$monetico = new Monetico(
'EPT_CODE',
'SECURITY_KEY',
'COMPANY_CODE'
);

$purchase = new PurchaseRequest([
'reference' => 'ABCDEF123',
'description' => 'Documentation',
'language' => 'FR',
'email' => 'john@snow.stark',
'amount' => 42,
'currency' => 'EUR',
'dateTime' => new DateTime(),
'successUrl' => 'http://localhost/thanks',
'errorUrl' => 'http://localhost/oops',
]);

$billingAddress = new BillingAddressResource([
'name' => 'dans ma culotte',
'addressLine1' => '42 rue des serviettes',
'city' => 'Coupeville',
'postalCode' => '42000',
'country' => 'FR',
]);
$purchase->setBillingAddress($billingAddress);

$shippingAddress = new ShippingAddressResource([
'name' => 'dans ma culotte',
'addressLine1' => '42 rue des serviettes',
'city' => 'Coupeville',
'postalCode' => '42000',
'country' => 'FR',
]);
$purchase->setShippingAddress($shippingAddress);

$client = new ClientResource([
'civility' => 'Mr',
'firstName' => 'John',
'lastName' => 'Snow',
]);
$purchase->setClient($client);

$url = PurchaseRequest::getUrl();
$fields = $monetico->getFields($purchase);
```

```php
use PmilInvest\Monetico\Monetico;
use PmilInvest\Monetico\Responses\PurchaseResponse;
use PmilInvest\Monetico\Receipts\PurchaseReceipt;

$data = json_decode([/* bank request body */], true);

$monetico = new Monetico(
'EPT_CODE',
'SECURITY_KEY',
'COMPANY_CODE'
);

$response = new PurchaseResponse($data);

$result = $monetico->validate($response);

$receipt = new PurchaseReceipt($result);
```

### Recovery
```php
use PmilInvest\Monetico\Monetico;
use PmilInvest\Monetico\Requests\RecoveryRequest;
use PmilInvest\Monetico\Responses\RecoveryResponse;

$monetico = new Monetico(
'EPT_CODE',
'SECURITY_KEY',
'COMPANY_CODE'
);

$recovery = new RecoveryRequest([
'reference' => 'AXCDEF123',
'language' => 'FR',
'amount' => 42.42,
'amountToRecover' => 0,
'amountRecovered' => 0,
'amountLeft' => 42.42,
'currency' => 'EUR',
'orderDate' => new DateTime(),
'dateTime' => new DateTime(),
]);

$url = RecoveryRequest::getUrl();
$fields = $monetico->getFields($recovery);

$client = new Http\Client();
$data = $client->request('POST', $url, $fields);

// $data = json_decode($data, true);

$response = new RecoveryResponse($data);
```
###Cancel
```php
use PmilInvest\Monetico\Monetico;
use PmilInvest\Monetico\Requests\CancelRequest;
use PmilInvest\Monetico\Responses\CancelResponse;

$monetico = new Monetico(
'EPT_CODE',
'SECURITY_KEY',
'COMPANY_CODE'
);

$cancel = new CancelRequest([
'dateTime' => new DateTime(),
'orderDate' => new DateTime(),
'reference' => 'ABC123',
'language' => 'FR',
'currency' => 'EUR',
'amount' => 100,
'amountRecovered' => 0,
]);

$url = CancelRequest::getUrl();
$fields = $monetico->getFields($cancel);

$client = new GuzzleHttp\Client();
$data = $client->request('POST', $url, $fields);

// $data = json_decode($data, true);

$response = new CancelResponse($data);
```
###Refund
```php
use PmilInvest\Monetico\Monetico;
use PmilInvest\Monetico\Requests\RefundRequest;
use PmilInvest\Monetico\Responses\RefundResponse;

$monetico = new Monetico(
'EPT_CODE',
'SECURITY_KEY',
'COMPANY_CODE'
);

$refund = new RefundRequest([
'dateTime' => new DateTime(),
'orderDatetime' => new DateTime(),
'recoveryDatetime' => new DateTime(),
'authorizationNumber' => '1222',
'reference' => 'ABC123',
'language' => 'FR',
'currency' => 'EUR',
'amount' => 100,
'refundAmount' => 50,
'maxRefundAmount' => 80,
]);

$url = RefundRequest::getUrl();
$fields = $monetico->getFields($refund);

$client = new GuzzleHttp\Client();
$data = $client->request('POST', $url, $fields);

// $data = json_decode($data, true);

$response = new RefundResponse($data);
```

## Crédits

-   [PMIL Invest](https://github.com/pmilinvest)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
