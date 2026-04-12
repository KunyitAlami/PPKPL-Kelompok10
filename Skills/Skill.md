---
name: laravel-construction-monitoring-j1
description: 'Best practices for Construction QA platform using Laravel 12, Livewire, and Leaflet.js.'
---

# Construction QA & Monitoring Best Practices (Module J1)

Your goal is to help me build a high-quality Construction Quality Assurance platform focusing on Soil Testing (J1 module) using Laravel 12, Livewire, and MySQL.

## Project Stack & Standards

- **Backend:** Laravel 12 (PHP 8.2+).
- **Frontend:** Livewire 3 with Blade Templates and Tailwind CSS.
- **Maps:** Leaflet.js for GPS visualization and coordinate picking.
- **Database:** MySQL 8 (Production) / SQLite (Testing). Follow the `J1_` prefix convention for soil-related tables.
- **Naming Convention:** - **Models:** PascalCase (e.g., `J1JadwalTitikUji`).
    - **Controllers/Livewire:** PascalCase with suffix (e.g., `InputTitikUji` component).
    - **Services:** Append `Service` suffix for business logic classes.

## Database & Data Integrity (US 1.2)

- **GPS Storage:** In the `J1_Jadwal_Titik_Uji` table, use `decimal(10, 8)` for `latitude` and `decimal(11, 8)` for `longitude`.
- **Relationships:**
    - `Proyek` belongs to `Users` (Pemilik).
    - `J1_Pengajuan_Uji_Tanah` belongs to `Proyek` and `Users` (Kontraktor).
    - `J1_Jadwal_Titik_Uji` belongs to `J1_Pengajuan_Uji_Tanah` and `Users` (Petugas Lab).
- **Mass Assignment:** Always define `$fillable` in Models to protect against mass assignment vulnerabilities.

## Livewire & Web Layer

- **Component Logic:** Use Livewire components for real-time validation of GPS inputs without page refreshes.
- **Leaflet Integration:** - Initialize Leaflet maps within the `mounted()` lifecycle or via Alpine.js for better reactivity.
    - Use `@js` directive to pass coordinate data from Livewire to Leaflet.
- **Validation:** Use class-based validation rules.
    ```php
    #[Rule('required|numeric|between:-90,90')]
    public $latitude;
    ```
- **Scenario Handling:** - **Success:** Dispatch browser events (`dispatch('toast-success')`) to notify the user.
    - **Failure:** Display error messages using `@error` directives in Blade.

## Service Layer & Business Logic

- **Encapsulation:** Logic for calculating Soil Test results (e.g., QC/FS values in `J1_Hasil_Sondir`) must reside in `app/Services/SoilTestService.php`.
- **Transactions:** Use `DB::transaction` when creating a `J1_Jadwal_Titik_Uji` entry to ensure related project statuses are updated simultaneously [1].

## UI/UX Standards (Construction Context)

- **Mobile First:** Since Field Officers (Petugas Lapangan) work on-site, ensure the Leaflet map and input forms are touch-friendly.
- **Loading States:** Use `wire:loading` to provide visual feedback during coordinate submission.
- **Error Feedback:** Explicitly handle Scenario 2 (Invalid GPS) by highlighting the map borders or showing "Out of Range" alerts.

## Testing & QA

- **Pest PHP:** Use Pest for testing User Stories.
- **US 1.2 Test Case:** - Verify `Petugas Lapangan` can save coordinates.
    - Verify `latitude` and `longitude` do not accept alphabetic strings.
- **Database Refresh:** Use `RefreshDatabase` trait with SQLite for fast test execution.

## Security & Access Control

- **Role-Based Access (RBAC):** Use Laravel Gates/Policies based on the `role` column in the `Users` table.
- **Policy Example:** Only users with `role == 'PetugasLab'` or `role == 'Teknisi'` can insert data into `J1_Jadwal_Titik_Uji`.
- **Audit Trails:** Ensure `created_at` is always captured for every J1 submission.