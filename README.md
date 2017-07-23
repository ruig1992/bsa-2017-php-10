# BSA Task :: "Car Hire Deals"

## Before install

Attention! Before you start, make sure that you have a working environment:
 - PHP 7.1 (http://php.net/)
 - MySQL Database (https://www.mysql.com/). Create your database _"your_database_name"_ if you want.
 - Composer (https://getcomposer.org/)

Recommended to use Vagrant and the virtual machine Homestead. Read more here: https://laravel.com/docs/5.4/homestead

## Install
    
1. Clone or download this repository
   ```bash
   git clone git@github.com:ruig1992/bsa-2017-php-10.git
   ```
2. Install project dependencies
   ```bash
   path/to/project/$ sudo composer install
   ```
3. Check file _.env_ in the root directory and put database settings, if you created it
   ```bash
   DB_CONNECTION = mysql
   DB_HOST = your host
   DB_PORT=3306
   DB_DATABASE = "your_database_name"
   DB_USERNAME = "your_username"
   DB_PASSWORD = "your_password"
   ```
4. Generate the new Laravel application key
   ```bash
   path/to/project/$ php artisan key:generate
   ```
5. Make database migration and fill database by data
   ```bash
   path/to/project/$ php artisan migrate --seed
   ```
6. You can browse the project on ```http://localhost:8000```

***

## Browser Usage

For **login** to the system there are test users by default:
 - **common** (email - ```test@example.com```, password - ```secret```)
 - **admin** (email - ```admin@example.com```, password - ```secret```)
   
**Common users, _unlike administrators_, can not modify content** (add new, change, delete cars). 

You can **register** in the system as a common user using the **form** or **social networks (services)**.

For the second case, you need to edit the end of the ```.env``` file - enter ```..._CLIENT_ID``` and ```..._CLIENT_SECRET``` for all necessary services (now available _GitHub, Bitbucket, Facebook, Twitter, Google, LinkedIn_).
    
You can get ```..._CLIENT_ID``` and ```..._CLIENT_SECRET``` after registering your applications (accounts) in social services.
    
For example:
       
   https://github.com/               for GitHub,  
   https://developers.facebook.com/  for Facebook,  
   https://apps.twitter.com/         for Twitter  

***

## API Usage

There are 2 routes:
  - ```/api/cars``` and ```/api/cars/{car_id}``` - for all authentificated users  
  - ```/api/admin/cars``` and ```/api/admin/cars/{car_id}``` - for only administrators  
  
You can specify advanced parameters for routes, such as:
  - ```per_page={number}``` - the number of records (_cars_, in this case) per one request (page) 
  - ```include={entity_data_1,entity_data_2,...,entity_data_N}``` - the sequence through the comma of entities whose data is displayed in the query (for cars ```?include=user``` displays the information about the user of this car)

## Running the tests
   ```bash
   path/to/project/$ ./vendor/bin/phpunit
   
   path/to/project/$ php artisan dusk
   ```
   
- read more https://laravel.com/docs/5.4/dusk

### Running the tests from Homestead (for Laravel Dusk)
1. Go to the virtual machine via ssh from the folder where Homestead is installed
   ```bash
   vagrant ssh
   ```
2. Run the following commands before running the tests
    ```bash
    wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add -
    
    sudo sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list'
    
    sudo apt-get update && sudo apt-get install -y google-chrome-stable
    
    sudo apt-get install -y xvfb
    ```
    
3. In a separate terminal window:
    ```bash
    Xvfb :0 -screen 0 1280x960x24 &
    ```

4. Now you can run the tests
    ```bash
    php artisan dusk
    ```

- read more https://github.com/laravel/dusk/issues/50#issuecomment-275155974
