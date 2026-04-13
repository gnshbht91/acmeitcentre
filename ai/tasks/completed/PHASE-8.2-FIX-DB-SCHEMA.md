# ============================================
# TASK: PHASE-8.2-FIX-DB-SCHEMA.md
# ============================================

GOAL:
Fix database schema mismatch by adding missing `note` column to existing table safely.

STEP:
Update DB schema using dbDelta and ensure backward-compatible migration.

FILES:
/wp-content/plugins/acme-core/includes/db/form-db.php
/wp-content/plugins/acme-core/acme-core.php

INPUT:
Existing database with table wp_acme_form_entries

EXPECTED_OUTPUT:
- `note` column exists in table
- No data loss
- No SQL error
- CRM note feature works

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-8.2-FIX-DB-SCHEMA)
- If mismatch → STOP

DUPLICATION_CHECK:
- If `note` column already exists → STOP

PRECONDITION_CHECK:
- Table exists → YES
- dbDelta available → YES

STRICT_SCOPE:
- ONLY schema fix
- NO insert logic change
- NO UI change

CONSTRAINTS:
- Must use dbDelta()
- Must NOT drop table
- Must NOT overwrite data

SECURITY_HINT:
- Safe migration required
- No direct SQL destructive query

FAIL_CONDITIONS:
- Table broken
- Data lost
- SQL error

SUCCESS_CRITERIA:
- note column added
- existing data intact
- system stable

# ============================================