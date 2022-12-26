# DakiaLite

Dakia (Hindi word for postman/mailer, pronounced `/daa-ki-yaa/`) is a tiny feature clone of MailerLite built using Laravel 9, Vue3 and TailwindCSS.

## Table of Contents

- [Live Demo](#live-demo)
- [Tech Stack](#tech-stack)
- [Features](#features)
- [How to Setup and Run the Project](#how-to-setup-and-run-the-project)


### Live Demo
- Frontend: https://dakia-lite.vercel.app/
- Backend: https://projects.pratikrane.com/api


### Tech Stack

1. Backend
   - Laravel 9
   - Sqlite 3
   - AWS EC2 and Nginx

2. Frontend
   - Vue 3
   - Tailwind CSS
   - Vercel


### Features
- View Subscriber List
- View Subscriber Details
- Create Subscriber
- Edit Subscriber
- Delete Subscriber
- Pagination


### How to Setup and Run the Project

**Note:** Minimum **PHP 8.1** and **Node 18.0** is required to run this project.

##### Backend
1. `git clone https://github.com/pratik149/dakia-lite.git`
2. `cd dakia-lite/backend/`
3. `composer install`
4. `touch database/database.sqlite`
5. `php artisan migrate`
6. `php artisan db:seed`
7. `php artisan serve`

##### Frontend
1. `cd dakia-lite/frontend/`
2. `npm i`
3. `npm run dev`
