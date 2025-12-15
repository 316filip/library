## Local testing

Welcome to my graduation thesis' repository! The web application was originally deployed, but due to the difficulty of
keeping it up-to-date and secure, and also my need to upgrade PHP version on the shared hosting, I decided to take it
down in December 2025.

However, that should not stop you from exploring my library system! You can get it up and running on your computer by
following these instructions:

- Set up [Docker](https://www.docker.com/)/[Podman](https://podman.io/) on your computer
- Clone this repository
- Copy the `.env.example` file as `.env`
- Run `docker compose up -d` in the root directory of the repo (wait until the command finishes)
- Open the terminal in the `library-php` container
    - Run `composer install`
    - Run `php artisan key:generate`
    - Run `php artisan migrate --seed`
- Restart the containers from the host's terminal
    - Run `docker compose down`
    - Run `docker compose up -d`

Once you're finished, you should be able to access the application on http://localhost:8080. To log in as an
administrator, use these credentials:

- Email: `library@example.com`
- Password: `password`

Following are instructions for web deployment as requested by the thesis' assignment.

## Instructions for web deployment

This website is almost prepared to be deployed, there are just a few things to do before:

- Copy the `.env.example` file as `.env`
    - Update `APP_URL` in the app details
    - Update database credentials for development
    - Update opening hours
- On your development server, run `php artisan migrate`
- Export your MySQL database
- In the `.env` file, update database credentials once more, this time for production

When deploying the website, do this:

- Upload project files to the hosting service
- Import the exported database to your hosting
- Set up CRON task to visit `/work` as frequently as possible
- Test everything
- Let the chief librarian create their account and then in MySQL database, users table, update their row with
  `librarian = 1` and `admin = 1`
