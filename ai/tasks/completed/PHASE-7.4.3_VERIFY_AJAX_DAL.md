# ============================================
# TASK: PHASE-7.4.3_VERIFY_AJAX_DAL.md
# ============================================

GOAL:
Verify and ensure that AJAX handler correctly passes data to DAL and inserts sanitized data into database.

STEP:
Validate full flow: AJAX handler → DAL function → DB insert

FILES:
/wp-content/plugins/acme-core/modules/module-form.php
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
Form POST data (name, email, phone, etc.)

EXPECTED_OUTPUT:
- AJAX handler receives data
- Data sanitized before DB insert
- DAL function called correctly
- Data inserted into DB successfully
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.4.3)
- If mismatch → STOP

DUPLICATION_CHECK:
- If DAL insert already verified → STOP

PRECONDITION_CHECK:
- AJAX working → YES
- Handler exists → YES
- DAL file exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only verify + fix AJAX to DAL connection
- No UI changes
- No DB schema changes

CONSTRAINTS:
- Must use WordPress sanitization functions
- Must not trust raw $_POST
- Must not modify unrelated logic

SECURITY_HINT:
- Sanitization required? YES (critical)
- Escaping required? YES (output only)
- Nonce required? NO (next phase)

FAIL_CONDITIONS:
- Data not reaching DAL
- Unsanitized input used
- DB insert fails
- PHP warning/error

SUCCESS_CRITERIA:
- Data flows correctly end-to-end
- All inputs sanitized
- DB insert success
- No errors
- Task pipeline completed

# ============================================