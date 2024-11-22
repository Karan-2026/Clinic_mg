# Clinic Management System

This is a simple Clinic Management System built using PHP and MySQL, allowing users to register and log in as either doctors or receptionists. The system provides the functionality to manage patient information and user accounts for different roles.

## Features

- **User Registration**: Allows users to sign up with personal details (name, age, mobile number, etc.).
- **User Login**: Supports login for two types of users (doctor and receptionist).
- **Role-Based Access**: Users are assigned specific roles (doctor/receptionist) during login, and are redirected to their respective dashboards.
- **Form Validation**: Includes both client-side and server-side form validation for user registration and login.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript (for form validation)
- **Backend**: PHP
- **Database**: MySQL
- **Web Server**: Apache

## Installation Instructions

### Prerequisites

Make sure you have the following installed on your local machine:

- **PHP** (preferably PHP 7.4 or higher)
- **MySQL** (or MariaDB)
- **XAMPP/WAMP/LAMP** (for local server setup with Apache and MySQL)

### Steps to Set Up

1. **Download or Clone the Repository**:
    - You can download the project files by cloning the repository or downloading the zip.
    - Command to clone:
      ```bash
      git clone <repository_url>
      ```

2. **Set Up Your Local Server**:
    - If you're using XAMPP/WAMP/LAMP, start Apache and MySQL services.

3. **Create a MySQL Database**:
    - Create a database named `clinic_mgm` in MySQL.
    - You can use the following SQL query to create the database:
      ```sql
      CREATE DATABASE clinic_mgm;
      ```

4. **Import the Database Structure**:
    - Inside the `clinic_mgm` database, create a table for users with the following SQL query:
      ```sql
      CREATE TABLE users (
          id INT AUTO_INCREMENT PRIMARY KEY,
          name VARCHAR(100) NOT NULL,
          age INT NOT NULL,
          gender ENUM('Male', 'Female', 'Other') NOT NULL,
          mobile_no VARCHAR(10) NOT NULL,
          email VARCHAR(100) NOT NULL UNIQUE,
          password VARCHAR(255) NOT NULL,
          role ENUM('doctor', 'receptionist') NOT NULL
      );
      ```
      
5. **Configure Database Connection**:
    - In the `login.php`, `signup.php`, and any other PHP files that interact with the database, ensure the database connection settings are correct:
      ```php
      $conn = new mysqli('localhost', 'root', '', 'clinic_mgm', 3307);
      ```
    - Make sure your database is hosted on `localhost` with the correct username and password (default is usually `root` for both).

6. **Upload the Project to Your Local Server**:
    - Place all the project files in the `htdocs` (for XAMPP) or equivalent folder for your local server setup.

7. **Access the Application**:
    - Open your web browser and navigate to:
      ```
      http://localhost/clinic_mgm/
      ```
    - You should see the login or sign-up page.

8. **Create User Accounts**:
    - Visit the sign-up page to create user accounts with the desired roles (`doctor` or `receptionist`).
    - After registration, log in with the credentials you created.

### File Structure

Here is the basic file structure of the project:


### Usage

1. **Sign Up**: Navigate to the sign-up page and create an account by entering your details (name, age, mobile number, email, etc.). Ensure your age is 21 or older.
2. **Login**: After registering, log in with your email, password, and select your role (doctor or receptionist). You will be redirected to the appropriate dashboard based on your role.

### Known Issues

- The dashboards for doctors and receptionists are currently placeholders. You can implement their specific features as needed.
- The system only supports two roles (doctor and receptionist) at the moment. You can extend it to support more roles if necessary.

### Future Improvements

- **Dashboard Features**: Add more features to the doctor and receptionist dashboards such as managing patients, appointments, and schedules.
- **Password Recovery**: Implement a password reset functionality for users who forget their passwords.
- **User Role Management**: Allow admin users to manage roles and permissions for other users.

### Contributing

Feel free to fork this repository, contribute, and submit pull requests. If you encounter any bugs or have feature requests, please open an issue.

### License

This project is open-source and available under the [MIT License](LICENSE).
