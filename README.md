# Library Management System
This repository will show the features of the Laravel framework with a project.
I developed a RESTful API for the Library Management System.

## Roadmap

- [x] Repository Pattern
- [x] Strategy Design Pattern
- [x] Dependency Inversion Principle
- [x] Database Design
- [x] Migration
- [x] Seeding
- [x] Factory
- [x] Relationships
- [x] Controllers
- [x] Requests
- [x] API Resources 
- [x] HTTP Responses
- [x] Routing
- [x] Views
- [x] Blade Templates
- [x] Validations
- [x] Custom Validation Rules
- [x] Writing Artisan command
- [x] Queues & Jobs
- [x] Task Scheduling
- [x] Mail
- [x] Authentication
- [x] Testing
- [x] API documentation with Postman
- [ ] API documentation with Swagger
- [ ] Code Documentation
- [ ] Error Handling
- [ ] Logging
- [ ] GraphQL
- [ ] Dockerized
- [ ] Define more endpoints

## Why did I create Shifts table?
Every librarian has many shifts

The first scenario - today is 2023-01-01
- Librarian(id = 1) has a shift (date = 2023-01-01)
- This librarian will be selected for all borrowing.

The second scenario - today is 2023-01-01
- Librarian(id = 1) has a shift (date = 2023-01-03)
- Librarian(id = 1) wants leave for (date = 2023-01-03)
- Librarian(id = 2) is supposed to replace librarian(id = 1)
- Add a new record in the shifts table (id = 2, date = 2023-01-03)
- With this query, we can get Librarian(id = 2)

  ``
Shift::where('date', Carbon::now()->toDateString())->orderBy('id', 'desc')->first()->librarian_id
  ``
- We don't update (Librarian(id = 1) has a shift (date = 2023-01-03)), this is a log for us.
- We can assign shifts to every librarian by scheduled command or manually.

## Installation

- Clone the repo
- `composer install`
- Create a database and set in .env
- ``php artisan migrate --seed``
- ``php artisan route:list``
- ``php artisan test``
- ``php artisan serv``
- Run Manually ``php artisan report:best-librarian`` 
- Scheduled monthly ``$schedule->command('report:best-librarian')->lastDayOfMonth('23:50');``