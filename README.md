# Bagisto GDPR

[![Latest Stable Version](https://poser.pugx.org/bagisto/bagisto-gdpr/v)](//packagist.org/packages/bagisto/bagisto-gdpr)
[![Total Downloads](https://poser.pugx.org/bagisto/bagisto-gdpr/downloads)](//packagist.org/packages/bagisto/bagisto-gdpr)
[![License](https://poser.pugx.org/bagisto/bagisto-gdpr/license)](https://github.com/bagisto/bagisto-gdpr/blob/master/LICENSE)

## 1. Introduction:

Bagisto GDPR will help customers to Send Data Requests for Changing name , email ID , many more as well as customer can also send request for delete a particular data. Through this module customer can also see their all detaills like personal Details , Address Details , Order Details in pdf & html formate. If admin is satisfied with the GDPR Data Request of the customer then admin could proceed the request of change a particular info or delete a  particular info of the customer.

* Customers can send Data Request for changing information in their acccount.
* Customers can send Data Request for deleting a particular information in their acccount.
* After sending any Request customer recieves a mail on their registered email id.
* Customer can see thier all details like Personal Detail, Address Detail , Order detail through just one click in pdf and html formats.
* Admin can Enable/Disable GDPR Module.
* Admin can Enable/Disable Customer Agreement in GDPR Module.
* Admin can Enable/Disable Cookie Management in GDPR Module.
* Admin can see the list of all Data Request.
* Admin can solve the Data Request and can change the status of the request.


## 2. Requirements:

* **Bagisto**: v1.3.1

## 3. Installation:

Go to the root folder of **Bagisto** and run the following commands:

```
composer require bagisto/bagisto-gdpr
```

```
php artisan gdpr:install
```

* Enable the GDPR Module from the Admin Panel
 
```
Admin->Settings->GDPR
```
