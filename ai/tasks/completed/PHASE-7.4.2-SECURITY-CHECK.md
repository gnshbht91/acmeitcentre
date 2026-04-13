# ============================================
# TASK: PHASE-7.4.2-SECURITY-CHECK.md
# ============================================

GOAL:
Add nonce verification and honeypot validation inside AJAX handler

STEP:
Update handler function to validate nonce and honeypot before processing

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
None

EXPECTED_OUTPUT:
- Nonce verified using check_ajax_referer
- Honeypot checked and blocked if filled
- Proper JSON error responses
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.4.2)
- If mismatch → STOP

DUPLICATION_CHECK:
- Nonce check must not already exist
- Honeypot check must not already exist
- If exists → STOP

PRECONDITION_CHECK:
- Handler function exists → YES
- Nonce field exists → YES
- Honeypot field exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only update handler function
- No DB logic
- No extra validation
- No UI change

CONSTRAINTS:
- Use check_ajax_referer
- Use wp_send_json_error for failure
- No direct echo

SECURITY_HINT:
- Nonce required? YES
- Honeypot required? YES

FAIL_CONDITIONS:
- Wrong nonce key
- Missing honeypot check
- PHP error

SUCCESS_CRITERIA:
- Invalid nonce → blocked
- Filled honeypot → blocked
- Valid request → success response

# ============================================