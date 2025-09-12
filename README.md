# Blood Bank Management System

A simple Blood Bank Management System built with PHP and MySQL. 
This system allows administrators to manage donors, blood stock, NGOs, and blood exchanges. 
It also provides a user-facing site to view blood stock, search donors, and see NGO information.

---

## Features

### Admin Panel
- **Dashboard:** Overview of donors, NGOs, blood stock, and recent donors.
- **Donor Management:** Add and list blood donors.
- **Blood Stock Management:** View current blood stock.
- **NGO Management:** Add and list NGOs.
- **Authentication:** Admin login and logout.

### User Site
- View available blood stock.
- Search donors by blood group.
- View NGO information.

---

## Technologies Used

- PHP (with MySQLi)
- MySQL
- HTML/CSS

---

## Installation and Setup

1. **Clone or download the repository** to your local server directory (e.g., `htdocs` for XAMPP).

2. **Create the database:**

   - Import the provided SQL dump or run the following commands in your MySQL client:
   -   
   ```sql
   CREATE DATABASE blood_bank;
   USE blood_bank;

   -- Create tables (donors, ngos, blood_groups, blood_stock, exchange, admin, etc.)
   -- (You need to create tables according to your project schema)
   
3. **Configure database connection:

   Open admin/db.php

4. **Run the project:

    Access the admin panel at:
    http://localhost/bloodbank/admin/login.php
    (Use your admin credentials to log in.)
    
    Access the user site at:
    http://localhost/bloodbank/user/index.php
5. **Admin Login:

   Username: admin
   Password: admin123
  
















