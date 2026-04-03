## **E-Voting Web Apps**
## Regenerasi PCC 2026

Instalasi : 

atur variabel database:
```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_
DB_USERNAME=root
DB_PASSWORD=
```

atur variabel email sender:
```.env
MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
atur variabel credential admin:
```.env
ADMIN_NAME="Administrator"
ADMIN_USERNAME="admin"
ADMIN_PASSWORD="password"
```


instal npm package :
```
npm install
```
jalankan vite server : 
```
npm run dev
```

install composer dependency: 
```
composer install
```
jalankan aplikasi : 
```
php artisan serve
```


