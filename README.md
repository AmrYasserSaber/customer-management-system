

# Customer Invoice Management API

Welcome! This project is a Laravel-based API for managing customer and invoice data with user authorization. The API includes CRUD functionality, data filtering, pagination, and secure access control with Laravel Sanctum.

## Project Overview

This API handles three main data entities:
1. **Customers**
2. **Invoices**
3. **Users** (used for authorization purposes)

### Key Features
- CRUD operations for Customers, Invoices, and Users.
- Filtering and pagination support for customized data retrieval.
- Authorization controls to restrict data access and modification.
- API versioning setup (initially starting with "V1" for future extendability).

---

## Setup Instructions

### 1. Environment Setup
1. Install [Laravel](https://laravel.com/docs/10.x/installation) and set up a new project.
2. Set up a local development environment using [XAMPP](https://www.apachefriends.org/) or similar.
3. Configure the environment variables in the `.env` file, including database settings.


### 2. API Versioning
This is versioned project with the first version implemented but can easily expand and implement other updates.

---

## Core Functionalities

### 1. Routes
- Routes are defined based on provided screenshots. Use `api.php` to organize routes for `Customers`, `Invoices`, and `Users`.

### 2. Response Formatting
- Used **Eloquent Resources** to format JSON responses for better consistency.

### 3. CRUD Operations
- CRUD operations for Customers, Invoices, and Users:
  - **POST/PUT/PATCH** for creating and updating.
  - **DELETE** for deleting records (admin-only for user deletions).

### 4. Data Filtering and Pagination
- **Filtering**: Query parameters support filtering for fields such as name and amount. Example: `customers?name[eq]=Jamie`.
- **Pagination**: Paginate responses to handle large datasets.

### 5. Fetching Related Data
- Used the parameter `includeInvoices=true` to include a customer’s invoices in a response.

### 6. Bulk Insertion
- Supports bulk insertion for invoices by accepting an array of invoice JSON objects in the request body.

---

## Security and Authorization

- **Laravel Sanctum**: Protected API routes and enforce access restrictions.
  - **Public Access**: View customers and invoices.
  - **User Access**: Edit customers and invoices, view other users by ID.
  - **Admin Access**: View all users and delete any user.
  
- Used `tokenCan` method for authorization checks, ensuring data protection based on user roles.

---

## API References

Refer to the following resources for additional guidance:
- [Laravel Installation](https://laravel.com/docs/10.x/installation)
- [API Versioning](https://blog.hubspot.com/website/api-versioning)
- [Eloquent Resources](https://laravel.com/docs/10.x/eloquent-resources)
- [Pagination](https://laravel.com/docs/10.x/pagination)
- [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum)

---

## Testing

For API testing, used [Postman](https://www.postman.com/). Key scenarios include:
- Verifying CRUD operations across endpoints.
- Ensuring filters and pagination work as expected.
- Testing role-based access to protected routes.



---

