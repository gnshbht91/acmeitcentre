# ============================================
# TASK: PHASE-9.21-DELETE-LEAD.md
# ============================================

GOAL:
Allow admin to delete a lead securely.

STEP:
Create DAL delete function only.

FILES:
- /wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
lead_id (int)

EXPECTED_OUTPUT:
- Lead deleted via DAL
- Function returns true/false

TASK_VALIDATION:
- Must match TASK_BOARD

DUPLICATION_CHECK:
- If function exists → STOP

PRECONDITION_CHECK:
- DAL exists

STRICT_SCOPE:
- ONLY create DAL function
- DO NOT touch module/UI

CONSTRAINTS:
- lead_id > 0
- use $wpdb->delete
- return boolean

FAIL_CONDITIONS:
- invalid id accepted
- no validation

SUCCESS_CRITERIA:
- function works
- no error

# ============================================