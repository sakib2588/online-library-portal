# Online Library Member Portal

## Assignment Question

**Set 1 — Online Library Member Portal**
**20 Marks**
**Topics: MVC • JS Validation • PHP Validation • File Upload • Session & Cookie • Database (CRUD) • AJAX & JSON**

A public library is launching a small Member Portal and has hired you to build it using the MVC pattern in procedural PHP without any framework. You will create the folder structure mvc/ containing model/Member.php, controllers/RegisterController.php, controllers/process_login.php, views/register.php, views/login.php, views/dashboard.php, views/static/uploads/, and a books.json file at the root. Inside views/register.php, design a registration form using a table layout with the fields Full Name, Email, Username, Password, Confirm Password, and a Member Photo upload (JPG/PNG, max 2 MB), submitting via POST with enctype="multipart/form-data" to RegisterController.php. Before the form is submitted, attach a client-side JavaScript validation function on the onsubmit event that checks at least three rules — no field is empty, password length is at least 6 characters, and password matches confirm-password — alerting the user and returning false when any rule fails so the form does not post. On the server side, the controller must use the $hasError flag pattern with separate if-conditions to enforce at least six PHP validations (no empty fields, valid email via FILTER_VALIDATE_EMAIL, name contains only letters and spaces using preg_match, username 4–15 characters, password minimum 6 characters, and password equals confirm-password); only when $hasError remains false must the controller require the model and call addMember(), which uses mysqli to connect to a hardcoded database library_db and inserts into a members table (id, name, email, username, password, photo) after moving the uploaded image into views/static/uploads/, while a helper method memberExists() blocks duplicate usernames. For authentication, build views/login.php with username, password, and a "Remember Me" checkbox; process_login.php must call session_start(), validate hardcoded credentials (librarian / lib123), store the username in $_SESSION, set a one-week cookie named lib_user only when "Remember Me" is checked, and redirect to dashboard.php (or back with an error otherwise). The dashboard.php page must protect itself by redirecting unauthenticated visitors to login.php, greet the user by name, indicate whether the cookie is present, and include a logout link that destroys the session and clears the cookie. Finally, place a "Load Available Books" button on the dashboard along with an empty table; using raw AJAX (XMLHttpRequest, no libraries), send a request to get_books.php which reads books.json (an array of at least 3 objects with id, title, author, category), sets the header Content-Type: application/json, and echoes json_encode() output, then dynamically render the rows in the table without reloading the page, gracefully showing an error message if the JSON file is missing or the AJAX call fails.

## Project Structure

```
mvc/
├── index.php
├── books.json
├── get_books.php
├── schema.sql
├── model/
│   └── Member.php
├── controllers/
│   ├── RegisterController.php
│   └── process_login.php
└── views/
    ├── register.php
    ├── login.php
    ├── dashboard.php
    └── static/
        └── uploads/
```

## Setup Instructions

1. Start XAMPP: `sudo /opt/lampp/lampp start`
2. Open phpMyAdmin: `http://localhost/phpmyadmin`
3. Run `schema.sql` in the SQL tab
4. Open: `http://localhost/mvc/`

## Login Credentials

- Username: `librarian`
- Password: `lib123`
