# Getmobil Backend Case Study

## [Postman Collection](https://github.com/perrie85/Getmobil-Backend-Case-Study/blob/main/Getmobil%20Backend%20Case%20Study.postman_collection.json)

## Requirements
- Docker
- Docker Compose
- MongoDB Compass - To display your mongodb database - optional
- Any SQL Client Software - To display your mysql database - optional

## Setup
- Copy .env-example as .env
    - macOS/Linux: `cp .env.example .env`
    - Windows: `cp .\.env.example .\.env`

- Run the commands below to initialize the docker containers 

```
docker-compose build
docker-compose run php composer install
```

- To deploy the development server

```
docker-compose up -d
```

- After this is completed, your services should look like below
    - app: main application service
        - host -> http://127.0.0.1
        - port -> 8000
    - payment: a copy of app service on a different port to simulate payment requests (still will work for other requests as well - but payment will not)
        - host -> http://127.0.0.1
        - port -> 8001
    - mysql: main database service
        - host -> http://127.0.0.1
        - port -> 3306
    - mongodb: for management of order data
        - host -> http://127.0.0.1
        - port -> 27017
    - redis: for management of order data
        - host -> http://127.0.0.1
        - port -> 6379

- To connect to your application service, run the command below.
```
docker exec -it app sh
```

- Run the command below to generate the application key
```
php artisan key:generate
```

- While you are still connected to your application service via sh, run the command below to run the migrations.
```
php artisan migrate
```

- While you are still connected to your application service via sh, run the command below to generate default clients.
```
 php artisan passport:install
```

- While you are still connected to your application service via sh, run the command below to generate products.
```
 php artisan db:seed
```