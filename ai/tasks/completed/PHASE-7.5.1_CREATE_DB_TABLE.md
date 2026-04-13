# ============================================
# TASK: PHASE-7.5.1_CREATE_DB_TABLE.md
# ============================================

GOAL:
Create a stable and production-ready database table to store form entries.

STEP:
Create database table using WordPress dbDelta with proper schema and structure.

FILES:
/wp-content/plugins/acme-core/includes/db/form-db.php
/wp-content/plugins/acme-core/acme-core.php

INPUT:
None

EXPECTED_OUTPUT:
- Table wp_acme_form_entries created
- Columns properly defined
- No SQL error
- Table available in database

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.5.1)
- If mismatch → STOP

DUPLICATION_CHECK:
- If table already exists → STOP (do NOT recreate blindly)

PRECONDITION_CHECK:
- $wpdb available → YES
- dbDelta available → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY create DB table
- NO insert logic
- NO query logic

CONSTRAINTS:
- Must use dbDelta()
- Must use $wpdb->prefix
- Must follow WordPress schema rules

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? NO
- SQL safety → YES (dbDelta)

FAIL_CONDITIONS:
- Table not created
- SQL syntax error
- Wrong column types

SUCCESS_CRITERIA:
- Table exists in DB
- Columns correct
- No errors
- Task pipeline completed

# ============================================