Instruction Guide: Installing Laravel 12

Step 1: Set Up a Local Server

To run Laravel, you need a local server such as XAMPP or WAMP. Ensure your PHP version is 8.2 or higher.

Option 1: Install XAMPP

1. Download the latest version of XAMPP from: https://www.apachefriends.org/download.html

2. Install XAMPP and follow the on-screen instructions.

3. Open the XAMPP Control Panel and start Apache and MySQL.

4. Verify PHP version by running the following command in the terminal:


Step 2: Install Composer

Composer is required to install Laravel and manage dependencies.

Steps to Install Composer:

1. Download Composer from: https://getcomposer.org/download/

2. Run the installer and select the PHP path inside XAMPP (e.g., C:\xampp\php\php.exe).

3. Complete the installation.

Step 3: Install Laravel 12

 Using Composer Create-Project

1. Open a terminal or command prompt.

2. Run the following command: composer create-project --prefer-dist laravel/laravel my-laravel-app

3. Replace my-laravel-app with your project name.


Step 4: Install Laravel 12 Using a Specific Version

If you need Laravel 12 specifically, run: composer create-project --prefer-dist laravel/laravel project_name "12.*"

Replace project_name with your desired project name. This ensures Laravel 12 is installed even if newer versions exist.

Step 5: Setup Database
1. Go to ENV file.
   
2. Add this:
    DB_CONNECTION=sqlite,
    DB_HOST=127.0.0.1,
    DB_PORT=3306
    DB_DATABASE=database/database.sqlite
    DB_USERNAME=root,
    DB_PASSWORD="qwer4321",
   
3 Type this commands: 
    cp .env.example .env,
    php artisan key:generate,
    php artisan config:clear,
    php artisan cache:clear,
    php artisan db:seed,
    php artisan migrate:fresh --seed
   
4. Run this command: php artisan migrate
 
5. type yes

Step 6: Run Laravel 12 Application

1. Navigate to your Laravel project folder

2. Start the Laravel development server: php artisan serve

3. Open the provided local URL in your browser to see your Laravel application running: http://localhost:8000

After that you will see this: 

![image](https://github.com/user-attachments/assets/380ce389-9b8c-44f6-8b78-c3aa8e3f5406)





