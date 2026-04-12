---
name: laravel-construction-qa
description: 'Best practices for developing Construction Quality Assurance and Material Monitoring applications with Laravel 12.'
---

# Construction QA Platform Best Practices

Your goal is to help me write high-quality, maintainable, and robust Laravel 12 applications specifically for construction monitoring and material tracking.

## Project Setup & Architecture

- **Framework Version:** Leverage Laravel 12 features, ensuring compatibility with PHP 8.2+.
- **Database Engine:** Optimize for MySQL 8 (Production) and ensure seamless fallback to SQLite (Development/Testing).
- **Architecture Pattern:** Use a **Service-Pattern** to decouple complex business logic (e.g., material calculations or GPS processing) from Controllers.
- **Directory Structure:** Organize features by domain where possible. Keep `app/Services`, `app/Actions`, and `app/Repositories` clearly defined if the project scales.

## Domain Specifics: Soil Testing & GPS (US 1.2)

- **Coordinate Precision:** Always use `decimal(10, 8)` for Latitude and `decimal(11, 8)` for Longitude in migrations to maintain sub-meter accuracy [1].
- **Validation Rules:** Implement strict validation for GPS coordinates:
  - Latitude: `required|numeric|between:-90,90`
  - Longitude: `required|numeric|between:-180,180`
- **Spatial Indexing:** Use MySQL `ST_PointFromText` or `Point` column types for high-performance location-based queries.

## Web Layer (Controllers & Requests)

- **Thin Controllers:** Controllers should only handle request input and return responses. Delegate all logic to Service classes.
- **Form Requests:** Use dedicated Request classes (`php artisan make:request`) for all validation logic to keep controllers clean.
- **Resource Classes:** Use **Eloquent Resources** for API responses to ensure a consistent data structure, especially for mobile-app integration.
- **Error Handling:** Use Laravel’s global exception handler to return consistent JSON errors for AJAX/Mobile requests.

## Service & Logic Layer

- **Service Injection:** Inject services into controllers via the constructor for better testability.
- **Type Hinting:** Strictly use PHP type hinting and return types for every method to prevent runtime errors.
- **Transactions:** Wrap multi-step database operations (e.g., saving a soil test point and updating site status) within `DB::transaction()` to ensure data integrity [2].

## Data Layer (Eloquent & Migrations)

- **Strict Typing:** Use Laravel 12’s `$casts` property in Models to cast coordinates to `float` and timestamps to `datetime`.
- **Mass Assignment:** Use `$fillable` instead of `$guarded` to explicitly define allowed fields.
- **Relationships:** Define clear Eloquent relationships (e.g., `Site hasMany SoilTestPoints`). Always use Eager Loading (`with()`) to avoid N+1 query problems.
- **Soft Deletes:** Implement `SoftDeletes` for all construction-related records to maintain an audit trail.

## Security & Authorization

- **Role-Based Access (RBAC):** Use **Laravel Policies** to authorize actions. For example, verify if a user is a "Petugas Lapangan" before allowing coordinate inputs.
- **Middleware:** Protect sensitive monitoring routes using appropriate middleware.
- **Data Sanitization:** Rely on Eloquent's built-in protection against SQL Injection. Sanitize any raw HTML input if used in material reports.

## Testing (TDD Approach)

- **Testing Framework:** Use **Pest PHP** for an idiomatic and expressive testing experience.
- **Scenario Testing:** Every User Story must have a corresponding Feature Test (e.g., `tests/Feature/SoilTestLocationTest.php`).
- **Database Testing:** Use `RefreshDatabase` trait and execute tests against an in-memory SQLite database for maximum speed.
- **Mocking:** Use `Storage::fake()` for material photo uploads and `Event::fake()` for monitoring alerts.

## Code Quality & Logging

- **Logging Context:** Include relevant context in logs (e.g., `Log::info('Soil point created', ['user_id' => $user->id, 'site_id' => $site->id]);`).
- **PSR-12:** Adhere strictly to PSR-12 coding standards.
- **Type Safety:** Use `declare(strict_types=1);` at the top of all PHP files.