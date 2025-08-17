
# Book Sharing Platform

## Overview

The **Book Sharing Platform** is a web-based application that allows users to share books with others and discover books shared by users within a specific location. The platform promotes community-driven book sharing, where users can contribute books to the community and find books available near them.

### Key Features:
- **User Management**: Registration and login with user information (name, email, password, and location).
- **Book Sharing**: Users can share books with title, author, and description.
- **Nearby Books**: Users can view books shared within a 10 km radius based on their location.
- **Admin Features**: Admin can manage users, view books, and delete shared books.

## Features

### User Management
- **Register**: Users can create an account with basic details (name, email, password, latitude, longitude).
- **Login**: Users can log in to access features such as sharing books and viewing nearby books.

### Book Sharing
- **Share a Book**: Authenticated users can share books with title, author, and description.
- **View Nearby Books**: Users can view books shared within a 10 km radius of their location using geospatial queries.

### Admin Features
- **View All Users**: Admin can see all registered users in the system.
- **View All Books**: Admin can view all books shared by users.
- **Delete a Book**: Admin can delete any book shared by users.

### Location-Based Search
- Users can search for books shared near them by using their **latitude** and **longitude**. The system calculates the distance using **geospatial queries**.

### Authentication
- **JWT Authentication**: Used for user login and registration.
- **Admin Authentication**: Separate token-based authentication for admin routes to manage users and books.

## Technical Stack

- **Frontend**: (Optional) Vue.js/React for frontend development.
- **Backend**: Laravel framework for API development and user management.
  - **Laravel Passport**: For **API authentication** using **JWT tokens**.
  - **MySQL Database**: For storing user information and book details, supporting **geospatial queries**.

## Database

- **Users Table**: Stores user information (name, email, password, latitude, longitude).
- **Books Table**: Stores book details (title, author, description, user_id, latitude, longitude).
  - **Geospatial Queries**: The platform uses **`ST_Distance_Sphere`** function in **MySQL** to calculate distances between users and books within a 10 km radius.

## Deployment

- The application can be deployed on a web server with **PHP** and **MySQL** environments.
- Optionally, **Docker** can be used for containerization.

## API Authentication

- **JWT Authentication**: Ensures secure login and session management for users.
- **Admin Routes**: Protected by token-based authentication via **Laravel Passport**, ensuring only authenticated admins can manage users and books.

## Installation

### Prerequisites:
- **PHP** >= 7.4
- **Composer**
- **MySQL**
- **Laravel Passport** (for API authentication)

### Steps:
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/book-sharing-platform.git
   ```

2. Install dependencies:

   ```bash
   cd book-sharing-platform
   composer install
   ```

3. Set up your `.env` file:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your database in the `.env` file:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=book_sharing_platform
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Run migrations:

   ```bash
   php artisan migrate
   ```

6. Install Passport:

   ```bash
   php artisan passport:install
   ```

7. Seed the database (optional):

   ```bash
   php artisan db:seed
   ```

8. Serve the application:

   ```bash
   php artisan serve
   ```

### Endpoints

#### User Registration:

* **POST** `/api/register`
* Request body:

  ```json
  {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "secret123",
    "latitude": 40.7128,
    "longitude": -74.0060
  }
  ```
* Response: Returns a JWT token and user details.

#### User Login:

* **POST** `/api/login`
* Request body:

  ```json
  {
    "email": "john@example.com",
    "password": "secret123"
  }
  ```
* Response: Returns a JWT token.

#### Share a Book:

* **POST** `/api/books`
* Authorization: Bearer token
* Request body:

  ```json
  {
    "title": "The Great Gatsby",
    "author": "F. Scott Fitzgerald",
    "description": "A classic novel set in the Jazz Age."
  }
  ```
* Response: Returns the book details.

#### View Nearby Books:

* **GET** `/api/books/nearby`
* Authorization: Bearer token
* Response: List of books shared within 10 km of the authenticated user.

---

## Contributing

Feel free to fork the project, submit issues, and contribute improvements. If you encounter any bugs, please report them with detailed information to help us resolve them faster.

---

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.


