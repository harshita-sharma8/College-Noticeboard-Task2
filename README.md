# College Notice Board System (CNBS) - Task 2

A modular, secure, and object-oriented web application designed to streamline campus announcement management between college administration and students. This Task 2 refactoring upgrades the foundational prototype into an enterprise-grade, OOP-structured system with asynchronous API interactions and enhanced security.

---

## 🚀 Key Features

* **Object-Oriented Architecture:** Fully refactored into modular classes adhering to Encapsulation and Inheritance principles.
* **Enhanced PDO Security:** Prepared statements and parameter binding (`bindParam`) neutralize SQL injection risks.
* **Input Sanitization:** All user inputs are sanitized using `htmlspecialchars()` and `strip_tags()` to prevent XSS attacks.
* **Asynchronous JSON API:** Dynamic notice updates without page reloads via `api/get_notices.php`.
* **Real-time Notifications:** Notification tracking component (`Notification.php`) for student dashboard bell indicators.
* **Admin Control Panel:** Complete CRUD interface for publishing, editing, and deleting notices.
* **Responsive Frontend:** Styled using Tailwind CSS with 5 category filtering tabs (Academics, Exams, Events, Placements, Sports).

---

## 📁 Repository Structure

```text
task2/
├── api/
│   └── get_notices.php       # JSON API Endpoint for Async Requests
├── classes/
|   ├── CategoryNotice.php    # Extended Class for Category Logic
│   ├── Notice.php            # Core Base Class for Notice CRUD
│   └── Notification.php      # Class for Student Notification Tracking
├── config/
│   └── Database.php          # PDO Database Connection
├── admin_dashboard.php       # Administrative Control Panel (CRUD)
├── index.php                 # Student Portal & Dynamic Notice View
└── README.md                 # Project Documentation
