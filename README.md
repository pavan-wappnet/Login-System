# Login System

This project is a basic login system implemented using PHP with a focus on OOP principles, form handling, file handling, database integration, and AJAX with jQuery. The system allows users to sign up, log in, update their profile (including changing their password and profile picture), and log out.

## Features

- **Login**: Secure user authentication with username and password.
- **Sign-up**: New user registration with data validation.
- **Logout**: Secure user logout functionality.
- **Update Profile**: Users can update their profile picture and password.
- **Dashboard**: Displays user details such as name, email, and profile picture with an option to update profile.

## Database

The system uses a MySQL database with a single table `users` having the following structure:

| Column          | Type         | Description                   |
|-----------------|--------------|-------------------------------|
| `id`            | INT          | Primary key, auto-increment   |
| `username`      | VARCHAR(255) | Unique username for the user  |
| `password`      | VARCHAR(255) | Hashed password for security  |
| `profile_picture`| VARCHAR(255) | Path to the user's profile picture |
| `email`         | VARCHAR(255) | User's email address          |

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/login-system.git
    cd login-system
    ```

2. Configure the database:
    - Create a database named `login_system`.
    - Import the `database.sql` file to create the `users` table.

3. Update the database configuration in `classes/Database.php`:
    ```php
    private $host = 'localhost';
    private $db_name = 'login_system';
    private $username = 'your_db_username';
    private $password = 'your_db_password';
    ```

4. Start the application:
    - Place the project folder in your web server's root directory.
    - Access the application via `http://localhost/login-system`.

## Usage

1. **Sign Up**:
    - Go to the sign-up page.
    - Fill in the required details and submit the form.
    - You will be redirected to the login page upon successful registration.

2. **Login**:
    - Go to the login page.
    - Enter your username and password and submit the form.
    - You will be redirected to the dashboard upon successful login.

3. **Dashboard**:
    - The dashboard displays your name, email, and profile picture.
    - Click on "Update Profile" to change your password or profile picture.

4. **Update Profile**:
    - Change your password or upload a new profile picture.
    - Submit the form to save changes.

5. **Logout**:
    - Click on the logout button to end your session.

## Dependencies

- PHP
- MySQL
- jQuery

## Contributing

Feel free to fork the repository and submit pull requests. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is licensed under the MIT License.
