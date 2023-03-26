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
