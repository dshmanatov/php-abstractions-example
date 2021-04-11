# PHP OOP Abstractions

## Summary
This sample was built using Laravel 8.12 & Vue.js 2.5.

Можно было полностью "запилить" на DDD :/

Demo: https://www.youtube.com/watch?v=AZHa2_yBia8

## Usage instructions
- clone this repository
- `cd` to the repository folder
- run `cp .env.example .env`. **Make sure you do this before the next step!**
- run `composer install`
- run `vendor/bin/sail up` (add `-d` flag to daemonize)
- run `vendor/bin/sail artisan migrate` to run migrations
- run `vendor/bin/sail artisan db:seed` to populate the database
- visit `http://localhost` in your browser (you'll be asked to generate an app key)

## Notes
The UI to manage entities is in the early development stage, e.g. missing ability
to edit entities, to create/edit complex/related entities. The main
goal was to demonstrate some basic usage of Vue.js components.

## TODO:
- Add unit tests (sorta boring atm)
