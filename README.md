# fruity

- composer install to install packages

- to use db edit env file your db connection details and db_name
    - DATABASE_URL="mysql://USER:PASSWORD@127.0.0.1:3306/DB_NAME?charset=utf8mb4"

- replace this line with you own mailtrap to get email
  MAILER_DSN=smtp://MAILTRAPID@sandbox.smtp.mailtrap.io:2525?encryption=tls&auth_mode=login

- run php migrate to create tables in db
    - php bin/console fruits:fetch

- Make sure you have nodejs and yarn installed already on your system
  add vue loader and dependencies
  - yarn add --dev vue vue-loader vue-template-compiler
  compile assets
  - yarn/npm install
  - yarn run encore dev --watch
  optionally if it doesnt compile you nay need to install encore
  - composer require encore
  - yarn add @symfony/webpack-encore --dev

- get the fruits to db using command
    - php bin/console doctrine:migrations:migrate

- start serve on localhost