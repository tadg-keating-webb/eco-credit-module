# Eco Credit Module for OpenImpact
This submodule manages loans and savings for the OpenImpact platform.

## Installation
Step 1: Require the Module

First, add the module to your project via Composer:
```bash 
composer require "tadg-keating-webb/eco-credit-module": "dev-main"
```

## Step 2: Add Repository to Composer JSON

Ensure the repository is added to your composer.json file:
```bash
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/tadg-keating-webb/eco-credit-module"
    }
],
```

Step 3: Run Migrations

After running composer install, run the migrations to set up the necessary database tables:
```bash 
php artisan migrate
```

## Step 4: Enable the Module

Activate the module by adding the following to your .env file:
```bash
ECO_CREDIT_MODULE=true
```

## Usage

Once installed, the module will provide functionalities to manage loans and savings on the OpenImpact platform. You can configure additional settings within the .env or directly in your project if needed.
License

This module is licensed under MIT License.
