# ============================================
# TASK: PHASE-8.10-GDPR-ERASE.md
# ============================================

GOAL:
Allow user to permanently delete their data

STEP:
Create delete function and secure endpoint

FILES:
- wp-content/plugins/acme-core/dal/form-dal.php
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- email OR phone

EXPECTED_OUTPUT:
- All matching records deleted
- Safe execution
- JSON response

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 8.10)
- If mismatch → STOP

DUPLICATION_CHECK:
- Delete function must not already exist

PRECONDITION_CHECK:
- DB exists → YES
- Data present → YES

STRICT_SCOPE:
- Only delete logic
- No schema change

CONSTRAINTS:
- Must filter by email/phone
- Must use prepared query
- Must NOT allow full delete

SECURITY_HINT:
- Must use nonce
- Must block unauthorized access

FAIL_CONDITIONS:
- Mass delete
- Partial delete
- PHP error

SUCCESS_CRITERIA:
- Data fully removed
- System stable

# ============================================