# I.R.M.A
`Inteligent Rota Management App`

### Instalation

```
git clone git@github.com:radualexandru1986/irmaV2.git
```

```
composer install
```

```
sail build --no-cache
```

```
sail up -d
```

```
php artisan  migrate:fresh --seed
```

Note:
<p><i>
Add in the .env <br>
 <b>APP_SERVICE="irma.local" <br>
 APP_PORT=80 </b> <br>
then in the /etc/hosts <br>
127.0.0.1 irma.local. <br>
Whatever name we give to the APP_SERVICE it must match with whatever is in <b>docker-compose.yml </b>.<br>
ex: services: <br>
 ______<b>irma.local</b>: <br>
 ___________build: <br>

 Source : https://stackoverflow.com/questions/67579964/laravel-sail-shell-and-sail-artisan-command-stop-working
</i> </p>
<p>
The default address is http://0.0.0.0:80 <br>
The db <b> ip </b> : 0.0.0.0 <br>
<b>port </b> : 3306</p>
<hr>
<p>

Laravel Sail:  https://laravel.com/docs/9.x/sail
</p>