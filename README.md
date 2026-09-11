# Tasks App

A simple CRUD (Create, Read, Update, Delete) task manager built with PHP and MySQL.

## Live Demo
http://169.239.251.102:442/~gertrude.akagbo/tasks-app/

## Setup

1. Copy `db.example.php` to `db.php`:
   ```
   cp db.example.php db.php
   ```
2. Edit `db.php` with your own database credentials.
3. Visit `setup.php` in your browser to create the `tasks` table.
4. Visit `index.php` to use the app.

## Files
- `db.php` — database connection (not committed, see db.example.php)
- `setup.php` — creates the tasks table
- `index.php` — lists all tasks (Read)
- `create.php` — add a new task (Create)
- `edit.php` — update a task (Update)
- `delete.php` — remove a task (Delete)
