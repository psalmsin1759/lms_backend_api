## LMS Platform

A scalable Learning Management System (LMS) backend built with Laravel, following Clean Architecture and Domain-Driven Design (DDD) principles.

This API powers course creation, modular learning, lesson content delivery (video, audio, PDF, text), and instructor-based access control with flexible cloud file storage.

### Architecture Overview

This project strictly separates business logic from framework concerns.

```bash
app/
├── Domain/              # Pure business rules (framework-agnostic)
│   ├── Entities/
│   ├── Enums/
│   └── Repositories/
│
├── Application/         # Use cases & orchestration
│   ├── UseCases/
│   └── Services/
│
├── Infrastructure/     # Framework & external integrations
│   ├── Persistence/
│   └── Files/
│
├── Http/               # Controllers & Form Requests
│
└── Models/             # Eloquent models (infra only)

```

### Layer Responsibilities

```bash

| Layer              | Responsibility                               |
| ------------------ | -------------------------------------------- |
| **Domain**         | Core business rules, entities, enums         |
| **Application**    | Use cases and workflows                      |
| **Infrastructure** | Database, file storage, third-party services |
| **HTTP**           | API interface, validation, auth              |

```

### Core Domain Model

Course

Represents a learning program created by an instructor.

Core Domain Model
Course

Represents a learning program created by an instructor.

```bash
Course
- id
- instructor_id
- title
- description
- slug
- level (beginner, intermediate, advanced)
- duration (minutes)
- price
- status (draft, published)
- modules []

```

### Module

Logical grouping of lessons within a course.

```bash
Module
- id
- course_id
- title
- order
- lessons []

```

### Authentication

- Uses Laravel Sanctum

- Instructor context derived via Auth::id()

- No instructor IDs are passed from the client

### File Storage System

UploadFileProcessor

- A centralized file handling service that:

- Accepts files from HTTP requests

- Stores them on Local / S3 / Cloudflare R2

- Generates public URLs

- Handles cleanup on updates/deletes

```bash
FILES_DEFAULT_PROVIDER=local
# or
FILES_DEFAULT_PROVIDER=s3
# or
FILES_DEFAULT_PROVIDER=r2

```

Supported disks are configured in config/filesystems.php.

### File Lifecycle

- File uploaded on lesson creation

- Old file deleted on lesson update

- File removed automatically when lesson is deleted

### API Endpoints

Courses

```bash
GET    /api/courses
GET    /api/courses/{id}
POST   /api/courses
PUT    /api/courses/{id}
PATCH  /api/courses/{id}/status
DELETE /api/courses/{id}

```

Supports:

- Pagination

- Search

- Filter by status, level, instructor

- Ordering (date, title, price, duration)

### Validation Strategy

- All requests validated via FormRequest

- Enum validation enforced using Illuminate\Validation\Rules\Enum

- File validation based on content_type

### Design Principles Used

- Clean Architecture

- Domain-Driven Design

- SOLID principles

- CQRS-style use cases

- Dependency inversion

- No framework coupling in domain

### Tech Stack

- PHP 8.2+

- Laravel 12

- MySQL / PostgreSQL

- Laravel Sanctums

- AWS S3 / Cloudflare R2

- UUID-safe file handling

### Getting Started

```bash
git clone <repo>
cd backend-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

```
