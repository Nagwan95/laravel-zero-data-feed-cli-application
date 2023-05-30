# Laravel Zero Data Feed Application

This command-line application processes an XML file and pushes the data to a database. It is built using Laravel Zero, a micro-framework for console applications based on Laravel.

## Prerequisites

Before running this application, make sure you have the following installed:

-   PHP 7.4 or higher
-   Composer

## Installation

1. Clone the repository to your local machine.
2. Navigate to the project directory.
3. Run the following command to install the dependencies:

```shell
composer install
```

4. Copy the `.env.example` file to `.env`:

```shell
cp .env.example .env
```

5. Run the migrations to set up the database:

```shell
php datafeed migrate
```



## Usage

To run the application and process an XML file, use the following command:

```shell
php datafeed xml:process {file}
```

Replace `{file}` with the path to your XML file.

## Configuration

You can configure the database connection and other settings in the `.env` file. Make sure to set the appropriate values for your environment.

## Error Logging

Errors encountered during the processing of the XML file will be logged to the `storage/logs` folder. Check this folder for any errors or exceptions that occur during execution.

## Testing

To run the application's tests, use the following command:

```shell
php datafeed test
```
