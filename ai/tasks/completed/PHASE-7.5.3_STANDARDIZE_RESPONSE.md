# ============================================
# TASK: PHASE-7.5.3_STANDARDIZE_RESPONSE.md
# ============================================

GOAL:
Standardize AJAX response using WordPress JSON response functions to ensure consistent, structured, and API-ready output.

STEP:
Replace raw echo / inconsistent responses with wp_send_json_success() and wp_send_json_error().

FILES:
/wp-content/plugins/acme-core/modules/module-form.php

INPUT:
AJAX request (form submission)

EXPECTED_OUTPUT:
- Consistent JSON response format
- success → true/false
- message → human-readable
- data → optional payload
- No raw echo or die

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.5.3)
- If mismatch → STOP

DUPLICATION_CHECK:
- If wp_send_json already used → STOP

PRECONDITION_CHECK:
- AJAX handler exists → YES
- Insert working → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY response handling update
- NO DB changes
- NO form logic changes

CONSTRAINTS:
- Must use wp_send_json_success()
- Must use wp_send_json_error()
- Must not echo raw JSON
- Must not use die()

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? YES (message output)
- JSON safe → YES

FAIL_CONDITIONS:
- Invalid JSON response
- Mixed echo + JSON
- JS cannot parse response

SUCCESS_CRITERIA:
- Clean JSON response
- success flag correct
- message present
- No PHP errors
- Task pipeline completed

# ============================================