<p align="center"><img src="https://topdev.vn/blog/wp-content/uploads/2018/01/1510639420mceclip0.png" width="400"></p>

## 1. Cài đặt

```
cp .env.example .env
```

```
composer install
```

```
npm install
```

```
php artisan key:generate
```

```
php artisan storage:link
```

## 2. Khởi chạy

Để khởi chạy ứng dụng cần mở song song 2 terminal

1. Terminal thứ nhất

```
php artisan serve
```

2. Terminal thứ hai

```
npm run watch
```

## 3. Cấu trúc thư mục

-   Cấu trúc tương tự như Laravel 8
-   Tuy nhiên trong thư mục resources/js sẽ có cấu trúc của vuejs và ứng dụng sẽ chạy giao diện theo cấu trúc vuejs
