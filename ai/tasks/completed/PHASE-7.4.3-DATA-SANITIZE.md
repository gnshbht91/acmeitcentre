# ============================================
# TASK: PHASE-7.4.3-DATA-SANITIZE.md
# ============================================

GOAL:
Sanitize and validate form input data inside AJAX handler

STEP:
Read $_POST safely, sanitize inputs, and apply basic validation

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- name
- phone
- email
- course

EXPECTED_OUTPUT:
- All fields sanitized
- Required fields validated
- Proper error messages returned
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.4.3)
- If mismatch → STOP

DUPLICATION_CHECK:
- Sanitization logic must not already exist
- If exists → STOP

PRECONDITION_CHECK:
- Handler function exists → YES
- Nonce + honeypot checks exist → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only add sanitization + basic validation
- No DB logic
- No advanced validation

CONSTRAINTS:
- Use WordPress sanitization functions
- Use isset() before $_POST
- Use wp_send_json_error for invalid data

SECURITY_HINT:
- Sanitization required? YES
- Validation required? YES

FAIL_CONDITIONS:
- Direct $_POST usage without isset
- Missing sanitization
- PHP error

SUCCESS_CRITERIA:
- Clean data variables created
- Invalid input blocked
- Valid input passes

# ============================================