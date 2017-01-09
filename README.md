# eLibrary - Online library management

### Installation

Clone the git repository
```
git clone https://github.com/gdarko/eLibrary.git
```
Enter the cloned repository

```
cd eLibrary
```

Install the composer dependencies

```
composer install
```

Copy the .example env config file to .env which will be used for the environment constants
```
cp .env.example .env
```

In this step you can setup the database connection here before migrating the database.
``` 
nano .env
```

Migrate the database, make sure you have correct setup in ```.env```
```
php artisan migrate
```

**[Optional]** Install the demo data (user: dg@darkog.com, pass: 123456)
``` 
php artisan db:seed
```

### Requirements

##### In order to install this script you need web server with PHP & MySQL and also installed composer.

* Composer
* PHP >= 5.6
* MySQL Database

#### Composer Install
``` 
wget https://getcomposer.org/composer.phar
```
``` 
sudo mv composer.phar /bin/composer 
```
``` 
sudo chmod +x /bin/composer
```


### Project
* OpenSource
* Not Heavily tested
* Contributions welcome


### Author
* [Darko Gjorgjijoski](http://github.com/gdarko)
