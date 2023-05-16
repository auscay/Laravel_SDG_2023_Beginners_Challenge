# Laravel 2023 SDG Beginner's Task

This project is a simple Laravel task API that allows users to create, retrieve, update, and delete tasks. The API is built using Laravel and SQlite for data storage.

## Prerequisites

- PHP
- Laravel Framework
- Composer

## Installation

1. Clone the repository and navigate to the project root directory:

   ```shell
   git clone https://github.com/InventorsDev/Laravel_SDG_2023_Beginners_Challenge.git

2. Install dependencies using Composer:

   ```shell
   composer install

3. Set up the environment:

   ```shell
   Navigate to database folder create a file named challengedb.sqlite
   Copy the .env.example file and rename it to .env.
   Configure the necessary environment variables in the .env file.
   Set the following:
   DB_CONNECTION=sqlite
   DB_HOST=127.0.0.1
   DB_PORT=3306

## Task Instructions

You have been provided with the apiResource endpoints for basic CRUD and also the unit test which can be found in `your_project_directory\tests\Feature\TaskControllerTest.php` .
Your work is to perform the following:

- Create a TaskController then ensure to link it to your api.php file to work well
- Create all the functions needed by for the test to run perfectly
- Run your test and ensure it works perfectly

## Tests
     ```shell
    Run php artisan test

    A successful test should look like this in your Vs code terminal

 ![A successful test should look like this in your Vs code terminal](public\Screenshottest.png)


## Notes
     Test Cases
The following test cases are included in this repository:

`test_can_list_all_tasks`
This test verifies that the API endpoint for listing all tasks returns a valid response with a status code of 200 and the expected JSON structure.

`test_can_show_a_task`
This test verifies that the API endpoint for retrieving a specific task by its ID returns a valid response with a status code of 200 and the expected JSON structure.

`test_can_create_a_task`
This test verifies that the API endpoint for creating a new task returns a valid response with a status code of 201 and the expected JSON structure.

`test_can_update_a_task`
This test verifies that the API endpoint for updating an existing task returns a valid response with a status code of 200 and the expected JSON structure.

`test_can_delete_a_task`
This test verifies that the API endpoint for deleting an existing task returns a valid response with a status code of 204, and the task is no longer present in the database.
