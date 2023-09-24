

## Installation

I have used for the local development Vagrant/Homestead. The app was hosted on a Nginx web server running and active on the Homestead virtual machine. First you need clone the project repository from your version control system to your local machine. To run the project you need to set up a local development environment(Vagrant, Homestead, Docker, XAMPP) and execute the database.sql file to create the DB. Configure the files based on your local environment. Then you can start the project on your local machine and start using it.

## Project Structure

Explain the structure of your project, including the main directories and files.

- **config/database.php**: This file contains the database credentials and creates a new PDO instance to establish a connection to the database.

- **public/index.php**: This is the entry point of the application. It includes the necessary files, such as the autoloader, database configuration, and controller files. It handles the incoming request based on the URL and invokes the corresponding controller action.

- **routes/web.php**: This file defines the routes and their associated actions for the application. It sets the session cookie lifetime and starts a new session. It creates instances of the user and product models, as well as the user, product, and home controllers. It also defines the routes and their corresponding actions using anonymous functions.

- **autoload.php**: This file is responsible for autoloading classes using the PSR-4 autoloading standard. It registers an autoloader function that automatically loads the class files based on their namespace and directory structure.

- **src/Controllers/UserController.php**: This file contains the `UserController` class, which handles user-related actions such as registration, login, and editing contact information. It interacts with the `User` model and renders the corresponding views.

- **src/Controllers/ProductController.php**: This file contains the `ProductController` class, which handles product-related actions such as creating, editing, and deleting products. It interacts with the `Product` and `User` models and renders the corresponding views.

- **src/Controllers/HomeController.php**: This file contains the `HomeController` class, which handles actions related to the home page and error pages. It interacts with the `Product` model and renders the corresponding views.

- **src/Models/Product.php**: This file contains the `Product` model class, which represents the product entity and provides methods for interacting with the product data in the database.

- **src/Models/User.php**: This file contains the `User` model class, which represents the user entity and provides methods for interacting with the user data in the database.

- **templates/**: This folder contains the HTML markups for the sections of the website.

## License

The license is GNU General Public License v3.0.

## Contact

Feel free to send me feedback on petar_belberov@gmx.com or file an issue. Feature requests are always welcome.

If there's anything you'd like to chat about, please feel free to send me an email!