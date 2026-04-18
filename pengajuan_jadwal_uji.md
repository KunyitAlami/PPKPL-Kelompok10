# US 1.1 — Pengajuan Jadwal Pengujian Tanah

**User Story:**  
Sebagai Kontraktor, saya ingin mengajukan permintaan jadwal uji tanah dengan mengisi detail proyek agar proses pengujian tanah dapat dijadwalkan secara resmi dan terdokumentasi ke sistem.

• **Context File:**
  - `app/Models/Proyek.php` — Model Proyek as parent data
  - `app/Models/SoilTest.php` — Main model for Soil Test requests
  - `app/Actions/CreateSoilTestRequestAction.php` — Business logic for creating a new request
  - `app/Http/Controllers/SoilTestScheduleController.php` — Controller for scheduling flow
  - `app/Http/Requests/StoreSoilTestRequest.php` — Validation rules for project requests
  - `resources/views/soil_tests/create.blade.php` — Request form for soil testing

• **Skills:**
  - `skills/skill.md` — Laravel 11 patterns (Actions, Thin Controllers, Form Requests, Date Validation)

• **Task:** Implement the full soil test scheduling flow for US 1.1:
  1. Contractor enters the "Project List" page.
  2. Contractor selects a project and clicks "Request Soil Test".
  3. System runs `CreateSoilTestRequestAction::execute($data)`:
     - Validates Proyek ID relationship.
     - Ensures the requested date is not in the past.
     - Sets the initial status to 'Menunggu Jadwal'.
  4. System redirects to the request list with a success toast notification.
  5. Laboratory Officer receives the new request data on their dashboard.

• **Input:**
  - `@param Proyek $proyek` — The selected project record (Route Model Binding)
  - `@param StoreSoilTestRequest $request` — Request containing test type and planned date

• **Output:**
  - `@return RedirectResponse` — Redirect to request list on success
  - `@return SoilTest` — Persisted soil test request model

• **Rules:**
  - **[R1] Date Guard** — Planned date must be today or in the future (>= today)
  - **[R2] Role Guard** — Only 'Kontraktor' role can initiate a soil test request
  - **[R3] Linkage Guard** — Every request must be linked to a valid Project ID owned by the contractor
  - **[R4] Status Guard** — New requests must automatically default to 'Menunggu Jadwal' status

• **What Changed:**
  - **NEW** `app/Actions/CreateSoilTestRequestAction.php` — Business logic: request creation and status initialization
  - **NEW** `app/Http/Controllers/SoilTestScheduleController.php` — Thin controller: create and store methods
  - **NEW** `app/Http/Requests/StoreSoilTestRequest.php` — Validation: required fields and date range checks
  - **MOD** `app/Models/Proyek.php` — Added `hasMany(SoilTest::class)` relationship
  - **MOD** `app/Models/SoilTest.php` — Added `belongsTo(Proyek::class)` and fillable properties
  - **NEW** `resources/views/soil_tests/create.blade.php` — Tailwind-based form for scheduling
  - **MOD** `routes/web.php` — Added routes for soil test scheduling under contractor auth

• **Commit Message:** feat(soil-test): implement US 1.1 soil test schedule request for contractors
    - Add CreateSoilTestRequestAction for initial request processing
    - Implement StoreSoilTestRequest with date validation (>= today)
    - Define Eloquent relationships between Proyek and SoilTest
    - Add request form view and contractor routes