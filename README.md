# Geneo Contact App
This app allows you to send messages to GENEO's support team (fake, I get the emails). Click on the contact link to see the form. Enter your information and send an offer letter 😊.

##### Requirements:
- PHP: ^8.0
- MySql 8

#### Install Dependencies

```bash
$ composer install
$ npm install
```

#### Configure the Environment
Create `.env` file and setup tables by running migrations
```
$ cat .env.example > .env
$ php artisan migrate:fresh 
```

#### Configure SMTP in .env
```
MAIL_MAILER=smtp
MAIL_DRIVER=mailgun
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=25
MAIL_USERNAME=postmaster@domain.tld
MAIL_PASSWORD=****
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=Geneo
MAIL_FROM_NAME="${APP_NAME}"
```

## Setup Instructions
For the best experience, use docker to start up environment by running the command below in the root of your project
```bash
./vendor/bin/sail up -d
``` 
The command above launches the website on http://localhost

Alternatively, If you have all the requirements, you can use laravel built-in server by running:

```bash
php artisan serve --port 90
``` 
This command means you will launch the website on http://localhost:90

## Tests
To run the test cases, make sure you are at the root of the application and run
```bash 
php artisan test
```



Regards.

