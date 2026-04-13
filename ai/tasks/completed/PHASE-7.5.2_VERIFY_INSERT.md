# ============================================
# TASK: PHASE-7.5.2_VERIFY_INSERT.md
# ============================================

GOAL:
Verify and harden data insertion into wp_acme_form_entries table via DAL.

STEP:
Validate that sanitized data from AJAX handler is correctly inserted into database using DAL function.

FILES:
/wp-content/plugins/acme-core/modules/module-form.php
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
Form submission data (name, phone, email, course, url, utm, etc.)

EXPECTED_OUTPUT:
- Data inserted into DB correctly
- No NULL or broken fields
- Correct mapping of all fields
- No SQL errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.5.2)
- If mismatch → STOP

DUPLICATION_CHECK:
- If insert already verified → STOP

PRECONDITION_CHECK:
- Table exists → YES
- AJAX working → YES
- DAL function exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY verify + fix insert logic
- NO schema changes
- NO UI changes

CONSTRAINTS:
- Must use $wpdb->insert
- Must use correct format array
- Must not insert raw $_POST

SECURITY_HINT:
- Sanitization required? YES (already done)
- Escaping required? YES (handled by $wpdb)
- SQL injection safe → YES

FAIL_CONDITIONS:
- Insert fails
- Missing fields in DB
- Wrong data stored
- PHP/SQL error

SUCCESS_CRITERIA:
- Data inserted correctly
- All fields mapped
- No errors
- Task pipeline completed

# ============================================