### 1. Introduction:

Bagisto GDPR will help customers to Send Data Requests for Changing name , email ID , many more as well as customer can also send request for delete a particular data. Through this module customer can also see their all detaills like personal Details , Address Details , Order Details in pdf & html formate. If admin is satisfied with the GDPR Data Request of the customer then admin could proceed the request of change a particular info or delete a  particular info of the customer.

* Customers can send Data Request for Changing information in their acccount.
* Customers can send Data Request for deleteing a particular information in their acccount.
* After sending any Request customer recieves a mail on their registered email id.
* Customer can see thier all details like Personal Detail, Address Detail , Order detail through just one click in pdf and html formats.
* Admin can Enable/Disable GDPR Module.
* Admin can Enable/Disable Customer Agreement in GDPR Module.
* Admin can Enable/Disable Cookie Management in GDPR Module.
* Admin can Enable/Disable Cookie Management in GDPR Module.
* Admin can see the list of all Data Request.
* Admin can solve the Data Request and can change the status of the request.


### 2. Requirements:

* **Bagisto**: v1.1.2

### 3. Installation:

* Unzip the respective extension zip and then merge "packages" folder into project root directory.
* Goto config/app.php file and add following line under 'providers'

~~~
Webkul\GDPR\Providers\GDPRServiceProvider::class
~~~

* Goto composer.json file and add following line under 'psr-4'

~~~
"Webkul\\GDPR\\": "packages/Webkul/GDPR"
~~~

* Run these commands below to complete the setup

~~~
composer dump-autoload
~~~
~~~
php artisan migrate
~~~
~~~
php artisan db:seed --class=Webkul\\GDPR\\Database\\Seeders\\GdprTableSeeder
~~~
~~~
php artisan route:clear
~~~
~~~
php artisan config:cache
~~~

~~~
php artisan vendor:publish

-> Press 0 and then press enter to publish all assets and configurations.
~~~

* Enable the GDPR Module from the Admin Panel

 Simply place this url in the

 For Default theme
~~~
Admin->Settings->GDPR->Edit Channel->Footer Content->goto Code view->Add this line of url as you want
~~~

~~~
<li><a href="yourfronturl/public/guest/login">RMA Returns</a></li>
~~~

 For Velocity theme

~~~
Admin->Velocity->Meta Data->Footer->Footer Middle Content->goto Code view->Add this line of url as you want
~~~




> That's it, now just execute the project on your specified domain.
