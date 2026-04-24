# ============================================
# TASK: PHASE-9.21.2-AJAX-DELETE-HANDLER.md
# ============================================

GOAL:
Handle lead deletion via secure AJAX request in module layer.

STEP:
Create AJAX handler to validate request and call DAL delete function.

FILES:
- /wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- $_POST['lead_id']
- $_POST['_wpnonce']

EXPECTED_OUTPUT:
- Valid request deletes lead via DAL
- Invalid request returns error
- JSON response returned

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.21.2-AJAX-DELETE-HANDLER)
- If mismatch → STOP

DUPLICATION_CHECK:
- If handler exists → STOP

PRECONDITION_CHECK:
- DAL delete function exists → YES

STRICT_SCOPE:
- ONLY create AJAX handler
- DO NOT modify DAL
- DO NOT modify UI

CONSTRAINTS:
- Validate nonce
- Validate capability (manage_options)
- Validate lead_id (int > 0)
- Call DAL function
- Use wp_send_json_success/error

FAIL_CONDITIONS:
- Missing nonce check
- Missing capability check
- Direct DB call
- Raw input used
- No JSON response

SUCCESS_CRITERIA:
- Secure deletion flow
- No error
- No warning
- Proper JSON response

# ============================================