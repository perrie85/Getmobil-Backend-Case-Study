# Getmobil Backend Case Study

## Requirements
- Docker
- Docker Compose
- MongoDB Compass - To display your mongodb database - optional
- Any SQL Client Software - To display your mysql database - optional

## How To Run

- Copy .env-example as .env
    - macOS/Linux: `cp .env.example .env`
    - Windows: `cp .\.env.example .\.env`

- Run the commands below to initialize the docker containers 

```
docker-compose build
docker-compose run app composer install
docker-compose up -d
```

- Run these commands to generate the application key.

```
docker exec -it app sh
php artisan key:generate
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