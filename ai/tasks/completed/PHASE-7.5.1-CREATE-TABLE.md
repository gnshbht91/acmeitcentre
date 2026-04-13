# ============================================
# TASK: PHASE-7.5.1-CREATE-TABLE.md
# ============================================

GOAL:
Create custom database table for storing form entries (fully safe + verified)

STEP:
Create DAL file and safely register table creation on plugin activation

FILES:
- wp-content/plugins/acme-core/dal/form-dal.php
- wp-content/plugins/acme-core/acme-core.php

INPUT:
None

EXPECTED_OUTPUT:
- Table {prefix}_acme_form_entries created
- DAL file loaded BEFORE activation hook
- dbDelta syntax correct
- Table existence verified
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.5.1)
- If mismatch → STOP

DUPLICATION_CHECK:
- Table must NOT exist before execution
- DAL file must NOT exist
- If exists → STOP

PRECONDITION_CHECK:
- Plugin active → YES
- acme-core.php exists → YES
- DB connection working → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only create table + DAL file
- No insert logic
- No module changes

CONSTRAINTS:
- MUST use dbDelta()
- MUST use $wpdb->prefix
- MUST load DAL before activation hook
- PRIMARY KEY must follow dbDelta spacing rule

SECURITY_HINT:
- SQL must be dbDelta compatible

FAIL_CONDITIONS:
- DAL loaded after activation hook
- Incorrect PRIMARY KEY syntax
- Hardcoded table name
- Table already exists
- PHP error

SUCCESS_CRITERIA:
- Table created successfully
- Verified via DB query
- No silent failure

# ============================================