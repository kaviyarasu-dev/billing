# **Billing Management System**

## **Overview**
This is a Laravel-based application for managing products, creating bills, and handling payments, including cash denominations. The system tracks orders and allows customers to view their previous purchases.

---

## **Features**
- Add products.
- Generate bills with tax calculations.
- Accept payment details, including cash denominations.
- Calculate balance denominations for change.
- View past purchase history.

---

## **Installation**
1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd billing
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up the environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your database in `.env` and run:
   ```bash
   php artisan migrate --seed
   ```

5. Start the server:
   ```bash
   php artisan serve
   ```

6. Start the queue:
   ```bash
   php artisan queue:work
   ```

7. Open the application at `http://127.0.0.1:8000`.

---

## **Usage**
- Add products to the database.
- Use the billing page to generate bills and handle payments.

---

## **Requirements**
- PHP 8.2+
- Laravel 11
- MySQL

---

## **License**
This project is open-source and available under the MIT License.

--- 

Let me know if you need any further modifications!