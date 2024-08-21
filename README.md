
# Repo Desk

## Description
**Repo Desk** is a comprehensive platform designed to help you manage and interact with database containg marksheet distribution record. Built with PHP and integrated with PHPExcel, Repo Desk provides an intuitive interface to handle everything from data management to user authentication.

## Features
- **Repository Management**: Easily organize, manage, and access your repositories.
- **Data Handling**: Advanced PHPExcel integration for seamless data manipulation.
- **User Authentication**: Secure login system with role-based access control.
- **Responsive Design**: Accessible on any device with a user-friendly interface.
- **Database Integration**: Robust SQL database support for data storage and retrieval.

## Installation

### Prerequisites
- PHP 7.4 or higher
- Composer (for dependency management)
- MySQL (or another compatible database)
- Or just simply use xampp

### Setup
1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/repo-desk.git
   cd repo-desk
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Environment setup**:
   - Copy the example environment file:
     ```bash
     cp .env.example .env
     ```
   - Configure your database connection and other settings in the `.env` file.

4. **Database setup**:
   - Run the following command to create the necessary tables:
     ```bash
     php artisan migrate
     ```

5. **Run the application**:
   Start the development server by executing:
   ```bash
   php artisan serve
   ```

### Xampp Setup

1. Install Xampp
  - configure appache and mysql server

2. Download zip file
  - Download zip file of the code from release or direct download from Github.
    Unzip it and paste in under htdocs folder under xampp.

3. Configure
  - Open config.php under repodesk/includes
    Change your mysql database settings

4. Install database
  - install your database under phpmyadmin

5. Run server
  - To run the server eachtime you need to run xampp apache and phpmyadmin.
    When the servers are running open any web browser and type localhost/project folder directory name.
    

## Usage
- **Admin**: Use the default admin credentials (`admin/admin`) to log in and manage users, repositories, and system settings.
- **User**: Users can log in to view and manage their repositories, upload files, and track changes.


## Database Schema
The database includes the following tables:
- **Users**: Manages user information (ID, Username, Email, Password, Role, etc.)
- **Repositories**: Tracks repository details (ID, Name, Description, Owner, etc.)
- **Files**: Stores files and their metadata (File ID, Repository ID, Filename, Path, etc.)

For a detailed schema, refer to the SQL migration files in the `database/migrations/` directory.

## Contributing
Contributions are welcome! To contribute:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Implement your changes.
4. Commit your changes (`git commit -m 'Add some feature'`).
5. Push to the branch (`git push origin feature-branch`).
6. Open a pull request.

## License
This project is licensed under the MIT License. See the `LICENSE` file for more details.
