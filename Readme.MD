# M-Lab Landing Page Generator

M-Lab Landing Page Generator is a Laravel package that enables you to swiftly generate a basic landing page structure for your Laravel applications.

## Installation

You can install the package via Composer:

composer require mlab/landing-page-generator

## Usage

Once the package is installed, and the landing page is generated, you can customize the landing page as needed. The generated files include:

- resources/views/landing.blade.php: The main landing page view.
- resources/views/layouts/app.blade.php: The layout file that includes Bootstrap and sets up the basic structure.
- resources/views/components/Navbar.blade.php and resources/views/components/Footer.blade.php: Navbar and Footer components.
- public/css/main.css and public/js/main.js: Basic styling and JavaScript files.

Feel free to modify these files to suit your project's requirements.

## Configuration

The package provides a configuration file at config/mlab-menu.php, where you can define menu items for your landing page.

## License

The M-Lab Landing Page Generator is open-sourced software licensed under the MIT license.
