# ============================================
# TASK: PHASE-7.3-ADD-HONEYPOT.md
# ============================================

GOAL:
Add honeypot field to form to prevent bot submissions

STEP:
Add hidden honeypot input field inside form UI

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
None

EXPECTED_OUTPUT:
- Honeypot field present in form
- Field hidden from users
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.3)
- If mismatch → STOP

DUPLICATION_CHECK:
- Honeypot field must not already exist
- If exists → STOP

PRECONDITION_CHECK:
- module-form.php exists → YES
- Form + nonce already present → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only add honeypot field
- No validation logic
- No processing logic
- No JS

CONSTRAINTS:
- Must be hidden field
- Must not affect UI
- No other changes

SECURITY_HINT:
- Honeypot required? YES
- Should be hidden from human users

FAIL_CONDITIONS:
- Field visible in UI
- Duplicate honeypot
- PHP error

SUCCESS_CRITERIA:
- Hidden honeypot field exists
- Not visible in frontend
- Only module file modified

# ============================================