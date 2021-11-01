## Mobile Application Managment API

The purpose of the application is to enable the mobile applications on the device to register, purchase, cancel subscriptions and check the status through the services via the web service.

## How to use
 - git clone or download the package
    

	    php artisan migrate
	    
	    php artisan db:seed
	 
	 
 - Copy the .env.example file in the root of this repo to .env
 - Register
    - curl --location --request POST 'http://localhost/api/register'
 - Purchase
    - curl --location --request POST 'http://localhost/api/purchase'
 - Subscription Status
    - curl --location --request POST 'http://localhost/api/SubscriptionStatus'


## License

The software licensed under the [MIT license](https://opensource.org/licenses/MIT).
