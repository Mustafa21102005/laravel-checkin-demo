# Laravel Checkin — Reference & Demonstration Application

[![Live Demo](https://img.shields.io/badge/Demo-Live%20Application-brightgreen?style=flat-square)](https://laravel-checkin.alwaysdata.net/)
[![Package](https://img.shields.io/badge/Packagist-mustafa--azmi%2Flaravel--checkin-orange?style=flat-square)](https://packagist.org/packages/mustafa-azmi/laravel-checkin)
[![Tests](https://github.com/Mustafa21102005/laravel-checkin/actions/workflows/tests.yml/badge.svg)](https://github.com/Mustafa21102005/laravel-checkin/actions/workflows/tests.yml)
[![Laravel](https://img.shields.io/badge/Laravel-10%20%7C%2011%20%7C%2012%20%7C%2013-FF2D20?style=flat-square&logo=laravel&logoColor=white)](composer.json)
[![License](https://img.shields.io/badge/License-MIT-blue?style=flat-square)](https://github.com/Mustafa21102005/laravel-checkin/blob/master/LICENSE.md)

An interactive reference implementation demonstrating real-world application patterns for the [`mustafa-azmi/laravel-checkin`](https://github.com/Mustafa21102005/laravel-checkin) package.

This repository provides an end-to-end web environment showcasing pass generation, QR payload rendering, live camera scanning, database concurrency locking, and explicit exception state handling.

---

## 🌐 Live Application

Access the hosted demonstration environment: **[https://laravel-checkin.alwaysdata.net/](https://laravel-checkin.alwaysdata.net/)**

---

## 🏛️ Key Architecture & Features

This application models production check-in behaviors across multiple domains (event entry, class attendance, passes):

| Domain Feature                     | Package Implementation & Demonstration                                                                                                     |
| :--------------------------------- | :----------------------------------------------------------------------------------------------------------------------------------------- |
| **Token Security**                 | Generates HMAC-signed payloads. Raw tokens are rendered once for client-side consumption and never stored directly in the database.        |
| **Concurrency Protection**         | Handles simultaneous check-in attempts on single-use passes using database transaction row locks (`lockForUpdate`).                        |
| **State Exception Matrix**         | Expresses explicit lifecycle states via typed exceptions (`TokenNotFoundException`, `TokenExpiredException`, `TokenAlreadyUsedException`). |
| **Flexible Token Lifecycles**      | Demonstrates both strict single-use limited TTL tokens and reusable recurring entry passes.                                                |
| **Hardware & Scanner Integration** | Integrates client-side camera scanning via `html5-qrcode` alongside manual key-in fallback options.                                        |
| **Polymorphic Attachment**         | Demonstrates model attachment using the package's core `HasCheckins` Eloquent trait on an `Event` entity.                                  |

---

## 🛠️ Stack & Dependencies

- **Framework:** Laravel 13
- **Core Package:** [`mustafa-azmi/laravel-checkin`](https://github.com/Mustafa21102005/laravel-checkin)
- **QR Engine:** `endroid/qr-code`
- **Frontend / Interface:** Tailwind CSS & `html5-qrcode`
- **Database:** SQLite (default for showcase simplicity)

---

## 💻 Local Setup

To run this demonstration locally:

```bash
# Clone the repository
git clone [https://github.com/Mustafa21102005/laravel-checkin-demo.git](https://github.com/Mustafa21102005/laravel-checkin-demo.git)
cd laravel-checkin-demo

# Install dependencies
composer install

# Environment configuration
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate

# Launch local server
php artisan serve
```
