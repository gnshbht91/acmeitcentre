# ============================================
# TASK: PHASE-7.4.4-RESPONSE-STRUCTURE.md
# ============================================

GOAL:
Standardize AJAX response structure for success and error cases

STEP:
Update wp_send_json responses to include structured data object

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- Sanitized variables (name, phone, email, course)

EXPECTED_OUTPUT:
- All responses use consistent structure
- Success response includes sanitized data
- Error response includes message inside data
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.4.4)
- If mismatch → STOP

DUPLICATION_CHECK:
- Response structure must not already exist
- If exists → STOP

PRECONDITION_CHECK:
- Sanitization + validation exists → YES
- Handler function exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only update response structure
- No logic change
- No DB logic

CONSTRAINTS:
- Use wp_send_json_success / error
- Wrap response inside "data" key

SECURITY_HINT:
- No sensitive data exposure

FAIL_CONDITIONS:
- Raw message outside data
- Missing fields in success
- PHP error

SUCCESS_CRITERIA:
- Consistent JSON structure
- Success includes sanitized data
- Errors structured properly

# ============================================