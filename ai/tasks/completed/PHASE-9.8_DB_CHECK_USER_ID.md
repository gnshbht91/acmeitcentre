# ============================================
# TASK: PHASE-9.8_DB_CHECK_USER_ID.md
# ============================================

GOAL:
Ensure user_id column exists before assignment system usage

STEP:
Verify and safely add user_id column if missing

FILES:
/wp-content/plugins/acme-core/includes/db/leads-table.php

INPUT:
None

EXPECTED_OUTPUT:
- user_id column exists in wp_acme_form_entries
- No duplicate column
- No data loss
- No PHP or DB errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 9.8)
- If mismatch → STOP

DUPLICATION_CHECK:
- If user_id column already exists → DO NOT add again

PRECONDITION_CHECK:
- Required files exist → YES
- Required folders exist → YES
- DB connection available → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only DB column verification and creation
- No UI change
- No business logic change

CONSTRAINTS:
- Follow WordPress DB standards
- Use safe ALTER TABLE
- Do NOT drop or modify existing data
- Do NOT assume schema

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? NO
- Nonce required? NO

FAIL_CONDITIONS:
- Duplicate column error
- DB failure
- Data loss
- Unexpected schema change

SUCCESS_CRITERIA:
- user_id column exists
- Existing data intact
- No errors
- Task pipeline completed correctly

# ============================================