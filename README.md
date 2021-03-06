# eLibrary - Online library management
Opensource project based on Laravel 5

## Features
* Management of multiple Libraries
* Multiple users in each library
* Access levels for library management (Creator is **owner**, can add members with **read** or **read+write** accesss)
* Securely stored documents that can't be accessed if the user/request is not authorized.
* User invitations to the libraries
* User approvals/removal to the libraries
* Gravatar integration
* more...

##### See demo [here](http://elibrary.apps.darkog.com/), login with the credentials listed [here](https://github.com/gdarko/eLibrary/blob/master/database/seeds/UserSeeder.php)

## Requirements

##### In order to install this script you need web server with PHP & MySQL and also installed composer.

* Composer, see [how to install composer](https://github.com/gdarko/eLibrary#composer-install).
* PHP >= 5.6
* MySQL Database
* git (optional)

## Installation

#####Clone the git repository or alternatively download it directly from there
```
git clone https://github.com/gdarko/eLibrary.git
```
#####Enter the cloned repository

```
cd eLibrary
```

#####Install the composer dependencies

```
composer install
```

#####Copy the .example env config file to .env which will be used for the environment constants
```
cp .env.example .env
```

#####In this step you can setup the database connection here before migrating the database.
``` 
nano .env
```

#####Migrate the database, make sure you have correct setup in ```.env```
```
php artisan migrate
```

#####**[Optional]** Install the demo data (user: dg@darkog.com, pass: 123456)
``` 
php artisan db:seed
```

## Composer Install
``` 
wget https://getcomposer.org/composer.phar
```
``` 
sudo mv composer.phar /bin/composer 
```
``` 
sudo chmod +x /bin/composer
```

## Project
* OpenSource
* Not Heavily tested
* Contributions welcome

## Author
Developed by [Darko Gjorgjijoski](http://github.com/gdarko) as a project work for the **Digital Libraries** course at **[Faculty of Computer Science and Engineering](http://www.finki.ukim.mk/en)** in Skopje, Macedonia.

## License
[The MIT License](https://opensource.org/licenses/MIT)

