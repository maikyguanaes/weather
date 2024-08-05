
## Setup Development

Clone repository

```bash
git clone git@github.com:maikyguanaes/weather.git
```

### Install composer dependencies (without install PHP and Composer)

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
### Alias
I suggest you to create some helpers (shortcut) to be more easy to call some commands.
You can add on **`.zshrc`** or **`.bashrc`**

```bash
alias sail='[ -f sail ] && sh sail || sh ./vendor/bin/sail'
````
### Load applicantion

```bash
cd weather

cp .env.example .env

sail up
```
Run migration

```bash
sail php artisan migrate
```
## Test && Lints

To run tests you can run:
```bash
sail composer run tests
```
```bash
sail composer tests:coverage
````
To check code base style you can run:
```bash
sail composer run pint-check && sail composer run pint-fix
```