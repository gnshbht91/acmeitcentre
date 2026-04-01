# ACME SYSTEM (FINAL V6)

SYSTEM TYPE: LAYERED WORDPRESS ARCHITECTURE
EXECUTION: ENTRYPOINT CONTROLLED
RULE: PLUGIN = LOGIC | THEME = VIEW | NO DIRECT DB ACCESS

---

# SYSTEM MAPPING

* Execution controlled by ENTRYPOINT.md
* Task order controlled by ACME_EXECUTION_PLAN.md
* Task selection controlled by TASK_BOARD.md

Each task modifies only one layer

---

# CORE ARCHITECTURE

## THEME: acme

ROLE:

* UI rendering
* Templates
* Styling

RULES:

* Call plugin functions only
* No DB access
* No business logic

---

## PLUGIN: acme-core

ROLE:

* Business logic
* Data layer
* Settings
* Forms
* CRM
* Logging
* Backup
* Export

---

# CONSTANTS

Defined in acme-core.php:

* ACME_VERSION
* ACME_PATH
* ACME_URL
* ACME_DB_VERSION

---

# PLUGIN STRUCTURE

wp-content/plugins/acme-core/

* acme-core.php
* core/
* modules/
* dal/
* helpers/

---

# LOADER SYSTEM

acme-core.php:

* Define constants
* Load core/loader.php

core/loader.php:

* Load DAL
* Load modules
* Load helpers

No dynamic loading

---

# MODULE SYSTEM

modules/

* One module per feature

Examples:

* module-settings.php
* module-leads.php
* module-form.php

Rules:

* Register hooks
* Call DAL
* No direct DB

---

# DATA ACCESS LAYER (DAL)

dal/

Structure:

* class-{entity}-dal.php

Rules:

* All DB queries here
* Use $wpdb with prepare
* Return structured data

---

# DATA FLOW

DAL → MODULE → THEME

Rules:

* Theme receives array/object only
* No raw DB data

---

# SETTINGS SYSTEM

Storage:

* Single option: acme_settings

Rules:

* Use get_option / update_option
* Create getter functions
* No direct option access in theme

---

# AJAX SYSTEM

Use:

* admin-ajax.php

Rules:

* Define actions in modules
* Validate nonce
* Check permissions

---

# SECURITY FLOW

For all inputs:

* Validate
* Sanitize
* Verify nonce
* Check permission

For all outputs:

* Escape

---

# HOOK SYSTEM

Rules:

* All hooks inside modules
* Prefix: acme_

---

# CACHE SYSTEM

Use:

* Transients

Naming:

* acme_{feature}_{key}

Rules:

* Cache heavy queries
* Clear on update

---

# DATABASE SYSTEM

Tables:

* wp_acme_leads
* wp_acme_logs
* wp_acme_audit_logs

---

# ACTIVATION FLOW

On plugin activation:

* Run dbDelta
* Create tables
* Store DB version

On load:

* Check version
* Run migrations if needed

---

# FORM SYSTEM

Flow:

Submit → Validate → Save → Respond

Rules:

* Use nonce
* Use honeypot
* Use rate limit

Return:

* WP_Error on failure
* Success response

---

# ERROR HANDLING

Rules:

* Fail fast
* No silent failure
* Log all errors

---

# LOGGING SYSTEM

Function:

* acme_log(type, message, context)

---

# AUDIT SYSTEM

Track:

* Lead changes
* Settings changes
* Status updates

---

# RATE LIMIT

* Max 5 requests per minute per IP

---

# BACKUP SYSTEM

* Manual backup
* Cron backup

Path:

* /uploads/acme-backups/

---

# EXPORT SYSTEM

* CSV export
* Filter support

---

# USER ROLES

* Admin
* Manager
* Staff

---

# TEMPLATE DATA GUARD

Theme must:

* Check data before render

If empty:

* Show fallback UI

---

# BOUNDARY ENFORCEMENT

If:

* DB query outside DAL
* Logic inside theme

Then:

→ STOP execution

---

# EXECUTION SAFETY

* No partial execution
* No retry
* Fail fast

---

# FINAL RULE

SYSTEM MUST BE:

* Layered
* Controlled
* Predictable
* Secure

---

# END
