# TAKE HOME TECHNICAL TEST  Backend Developer Coding Collective

## System Requirements

- PHP : v8.2.20
- Postgre : v17.0-1
- Framework : Laravel v11.9
- Web Browser : Microsoft Edge, Google Chrome, Mozilla Firefox


## Installation
1. Clone github repository `git clone https://github.com/rdy24/attendance-web-test.git` or download zip
2. Install dependency, run composer install in terminal
   ```bash
    composer install
    ```
3. Copy .env.example to .env manually or using command in terminal
    ```bash
    copy .env.example .env
    ```
    or
    ```bash
    cp .env.example .env
    ```

4. Set your database in .env edit this line with your database configuration
   ```bash
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=attendance_web
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. Generate App key
    ```bash
    php artisan key:generate
    ```

6. Migrate database and run seeder
    ```bash
    php artisan migrate --seed
    ```

7. Serve the application
    ```bash
    php artisan serve
    ```

## Admin Account

1. **Admin** (email: admin@mail.com | password: password)

## User Account

1. **Rendra** (email: rendragituloh@gmail.com | password: password)
2. **Khariz** (email: kharizajaah@gmail.com | password: password)
3. **Joko** (email: jokoterdepan@gmail.com | password: password)
4. **Joko** (email: maiyamyuk@gmail.com | password: password)