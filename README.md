
## About This Application

### Welcome to test Laravel 9 application.

This application implements a simple Rest API with a minimal connection of the User Interface.

To run this application in a local environment, it is necessary (highly recommended) that you have PHP, Composer, Docker and Docker Compose installed on your computer.

Installation and setup.

This application is written based on the latest (9) version of the Laravel framework. To start the developer environment:
- open terminal and navigate to application folder
- execute the command "composer install"
- execute the command "docker-compose up -d --build" This command will download the necessary docker images and raise the application in the development environment.
- After that, it will be necessary to execute the command to install the necessary PHP and Node JS dependencies inside the container. You can do this in two ways:
1. While in the current state, execute commands via the sail command (you can create a command line alias „alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'“) and by running the commands "sail npm install"
2. You can go inside the container with the command "docker-compose exec -ti laravel.test bash" and execute commands inside the container without the command "sail"  "npm install"
   Next, you need to perform migrations with the standard Laravel command "php artisan migrate"
   Next, you need to run the command "php artisan pokemon:fetch_data_from_pokemon_api" which will download the data of 151 pokemon from the remote API and save them to the local database. Also, this command can be used to subsequently download Pokemon one by one if you call it with the option "--only_that_id={here is the ID of the Pokemon from the resource pokeapi.co}"
   Note: A timeout of approximately 5 seconds is set between requests. The entire command will take approximately 10 minutes to complete. Great opportunity to have a coffee break
   Note: if the given id is already present in the local database, the download will not occur.

The web application will be available at "http://localhost:8097" - the standard welcome page

Test application main page: "http://localhost:8097/pokemons"

API Endpoints are also implemented: 

- GET: "http://localhost:8097/pokemons/api/v1/pokemons" - API index page.
- POST: "http://localhost:8097/pokemons/api/v1/pokemons" - creation
- GET: "http://localhost:8097/pokemons/api/v1/pokemons/{pokemjn_id}" - get one resource
- PUT/PATCH: "http://localhost:8097/pokemons/api/v1/pokemons/{pokemjn_id}" - update one resource
- DELETE: "http://localhost:8097/pokemons/api/v1/pokemons/{pokemjn_id}" - delete one resource
API endpoints are only available for *Ajax* requests!

All the back-end code for the application is located in the "app/Packages/Pokemon" folder. The folder structure in this package is the same as for Laravel developers.

The frontend that I managed to implement is located in the standard folder "/resources/js"

PS. Unfortunately, it was not possible to implement API documentation through the OpenAPI library due to lack of time.
Also, to dive into the implementation of the user interface, I also need more time ((
