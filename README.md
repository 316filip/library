## Instructions for web deployment

This website is almost prepared to be deployed, there are just a few things to do before:

- Copy the `.env.example` file as `.env`
    - Update `APP_URL` in app details
    - Update database credentials for development
    - Update opening hours
- On your development server, run `php artisan migrate`
- Export your MySQL database
- In `.env` file, update database credentials once more, this time for production
- Upload project files to the hosting service
- Import the exported database to your hosting
- Set up CRON task to visit `/work` as frequently as possible
- Test everything
