## About this project

This website was created as a part of my graduation thesis. I've stopped working on this project since I finished my thesis, aiming to keep it in the same condition it was in when I finished grammar school. However, since the website is [deployed](https://knihovna.filiprund.cz), I decided to update the dependencies to keep visitors safe. According to the assignment, I also had to include the following instructions.

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
- Let the chief librarian create their account and then in MySQL database, users table, update their row with `librarian = 1` and `admin = 1`
