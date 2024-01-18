# Broken URL Checker

A simple web application to check the status of links in a CSV list of URLs and identifying any broken links.

## Features

- Processes URLs in batches to efficiently handle large numbers of links without overloading the server.
- Identifies broken links by checking HTTP status codes, excluding URLs returning "OK" (200) and "Forbidden" (403) statuses.
- Provides real-time feedback on the processing of URLs through an intuitive web interface.

## Prerequisites

- A server environment with PHP support (e.g., Apache, Nginx).
- PHP cURL extension enabled for making HTTP requests.

## Installation

1. Clone the repository or download the source code.
2. Place the files in your web server's document root (e.g., `htdocs`, `www`).
3. Ensure that the `process_urls.php` and `index.php` files are in the same directory.

## Usage

1. Open your web browser and navigate to the application URL (e.g., `http://localhost/index.php`).
2. Use the form to upload your CSV file containing the URLs of the WooCommerce downloadable product links.
3. Click "Check URLs" to start the process.
4. The application will display the broken URLs (if any) along with their HTTP status codes on the same page.

## Configuration

- **Batch Size:** You can adjust the `batchSize` variable in the `index.php` file to change the number of URLs processed per batch. The default is set to 10.

## Note

- This application is intended for local or internal use and does not include advanced security features. Ensure appropriate security measures are in place when deploying in a production environment.
- The application assumes that the CSV file is properly formatted, with one URL per line.

## License

[MIT License](LICENSE.md) - Feel free to use, modify, and distribute as needed.
