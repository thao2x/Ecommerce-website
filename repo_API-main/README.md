# Refresh the database and run all database seeds...
php artisan migrate:refresh --seed

### Passport
php artisan passport:install

### Sau khi chạy xong lệnh [php artisan passport:install]
# Copy
Personal access client created successfully.
Client ID: 98fe6e9d-5fc5-46c6-a007-f46211c8e815
Client secret: fB7FUzP4JClntTBE6nXQznEjy1Eh5KSyRbjRFrq2

# Vào .env
PASSPORT_PERSONAL_ACCESS_CLIENT_ID=98fe6e9d-5fc5-46c6-a007-f46211c8e815
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=fB7FUzP4JClntTBE6nXQznEjy1Eh5KSyRbjRFrq2

### Minio – Object storage server như AWS S3
https://laravel.com/docs/10.x/filesystem#main-content
https://viblo.asia/p/minio-object-storage-server-nhu-aws-s3-LzD5d0AW5jY	
https://laravel-news.com/minio-s3-compliant-storage
https://dev.to/gjrdiesel/set-up-minio-w-laravel-local-s3-2cj4