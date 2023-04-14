# graduation_report-45k14
# Hướng dẫn cách sử dụng dự án source repo_API-main

## Step 1: Khởi tạo, kết nối database
Hiệu chỉnh file .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_pojo
DB_USERNAME=root
DB_PASSWORD=
```

## Step 2: Tạo database, thực hiện migrate
- Tạo database <project_pojo>
- Thực thi câu lệnh khởi tạo cấu trúc bảng
```
php artisan migrate
```

## Step 3: tạo dữ liệu mẫu
- Thực thi câu lệnh
```
php artisan db:seed
```

## Step 5: khởi chạy môi trường, thư viện 
- Thực thi câu lệnh
```
composer i
```

## Step 6: khởi chạy source 
- Thực thi câu lệnh
```
php artisan serve
```
## Step 7: thông tin tài khoản truy cập hệ thống
Tài khoản Admin:
admin@test.com / password

# Hướng dẫn cách sử dụng dự án source repo_user-master
## Step 1: khởi chạy môi trường, thư viện 
- Thực thi câu lệnh
```
npm i
```

## Step 2: khởi chạy source 
- Thực thi câu lệnh
```
npm run serve
```