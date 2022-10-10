# Message API #

This is an API Rest developed with Laravel, PHP and Clean Architecture.

* laravel version: 14.17.6
* php version: 8.1
* Database: Mysql
* Tests made with Pest
* Containers with Sail

### How do I get set up? ###

* .env
  
  Rename or copy the .env.example to .env

        cp .env.example .env

  The .env is configured to use docker database setup

* build app

    In the app root (the same dir where is located the package.json and this README) run:

        docker compose up --build -d

    Just to make sure node_modules was really installed run npm install

        docker exec task-manager-api npm i

    To check docker live logging:

        docker-compose logs -f --tail 10
    
    You should see the following containers active:

    ![alt text](./docs/dockerps.png)


### Database Setup ###

Before start to test the application you should run the migrations and seeder to setup the development database and the test database as well to run the integration tests

* Running migration for development 
        
        docker exec task-manager-api npx sequelize-cli db:migrate

    ![alt text](./docs/migration.png)

* Running migration for test

        docker exec task-manager-api npx sequelize-cli db:migrate --env test

* Running seeders for development 
        
        docker exec task-manager-api npx sequelize-cli db:seed:all

    ![alt text](./docs/seed.png)

* Running seeders for test

        docker exec task-manager-api npx sequelize-cli db:seed:all --env test

* The final result:
  
    ![alt text](./docs/database.png)

### How to run unit tests? ###

* Normal test  
        
        docker-compose exec task-manager-api npx jest

    ![alt text](./docs/tests.png)

* With coverage

        docker-compose exec task-manager-api npx jest --coverage
    
    Terminal version

    ![alt text](./docs/tests-coverage.png)

    Html version

    ![alt text](./docs/tests-coverage-html.png)

* Postman Project

    See [Postman Collection](./docs/collection.json)
  
### Who do I talk to? ###

* Lucas sahdo - lucassahdo@gmail.com