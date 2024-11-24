# Order Reminder System


## Features

- **Order Management**: Track orders and their statuses.
- **Reminder System**: Automatically send reminders for orders that are about to expire.
- **Localization**: Support for multiple languages, making it easy to adapt the system for different regions.
- **Customizable Reminder Templates**: Dynamic reminder emails with customizable content.

## Requirements

- PHP >= 8.2
- Laravel >= 11.31
- MySQL or any compatible database
- Composer (for managing PHP dependencies)

## Installation

### Step 1: Clone the Repository

First, clone the repository to your local machine or server.

```bash
git clone https://github.com/GevorM/reminder_task.git
cd order-reminder-system

---
1. **Cloning the repository**.
2. **Installing dependencies** (`composer install`).
3. **creating a .env file** (`cp .env.example .env`).
4. **Generating the application key** (`php artisan key:generate`).
5. **Running the migrations** (`php artisan migrate`).
6. **create orders via postman**.
7. **Starting the queue worker** (`php artisan queue:work`).
8. **Running the scheduler** (`php artisan schedule:run`).

# API Request: Create Business Order

This guide explains how to use the **Postman** request to create a new business order in the system.

## Request Details

- **HTTP Method**: `POST`
- **URL**: `https://api.example.com/orders` _(replace with the actual API endpoint)_
- **Headers**:
  - `Content-Type: application/json`

## Request Body form-data

You need to send the following JSON body in the **Body** section of the Postman request:

user_id: 1,
business_name: My Business,
order_type: x
application_date: 2024-11-23,
business_id: 1,
email: example@gmail.com
