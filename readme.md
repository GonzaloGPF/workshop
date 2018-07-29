## Workshop

A simple App made with [Laravel](https://laravel.com) 5.6 and [Vue](https://vuejs.org/) 2.5 SPA. An admin can create, edit and delete Users.

## Goodness

This project has the following characteristics

- Complete Vue SPA with [JWT](https://github.com/tymondesigns/jwt-auth) and [i18n](https://github.com/kazupon/vue-i18n). It has setup localized currencies and dates too.
- Frontend made with [VueMaterial](https://vuematerial.io). Using [Vuelidate](https://monterail.github.io/vuelidate) for validations.
- Vue SPA using [VueRouter 3](http://router.vuejs.org/), [Vuex 3](http://vuex.vuejs.org/) and [Axios](https://github.com/mzabriskie/axios). 
- A small Database structure and Seeders are ready with Users and basic Roles.
- Has a complete User's admin panel. An Administrator has access to a CRUD interface over Users.
- Implementation of i18n with English and Spanish languages.
- Linters are setup for Style (stylelint), Javascript (eslint) and php (codesniffer).

## Setup

- First, copy .env.example to .env file. Modify it to your needs.

- Then, install dependencies:

``composer install``

``npm install``

- Setup the app key with:

``php artisan key:generate``

``php artisan jwt:secret``

- You can create a database and populate it with:

``php artisan migrate:fresh --seed``

- Generate i18n messages:

``php artisan vue-i18n:generate``

- Compile front end:

``npm un dev``

## Tests

All test run by PHPUnit. You can execute them by typing:

``vendor/bin/phpunit``

## Linters

To fix php code

``vendor/bin/php-cs-fixer fix``

To fix js and vue code

``npm run lint -- --fix`` 

## License

The Workshop is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
