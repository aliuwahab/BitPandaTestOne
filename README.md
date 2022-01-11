## About BitPanda Test One

This is a simple project given as part of the hiring process.

## Set Up
1. Save .env.example as .env
2. Create a database call `bitpanda_test_one_db` in your mysql local server (you can use tools like sequel pro or mysql workbench to make it easier)
3. In your terminal, cd into root of this project and run `php artisan serve`
4. Copy the url as display in your terminal after the command you run in step 3. (It is always in the form: `http://127.0.0.1:8000`). Pay attention to the port



##

1. `GET` REQUEST: Filter Endpoint: http://127.0.0.1:8000/api/users?status=1&nationality=AT The filter parameters are optional. You can be optional filter by status or nationality
2. `PATCH` REQUEST:  Update Users:  http://127.0.0.1:8000/api/users/2     You can post any of the following fields with their values: `citizenship_country_id, first_name, last_name, phone_number` to update a user details
3. `DELETE` REQUEST: Delete a user without user details record: http://127.0.0.1:8000/api/users/60
