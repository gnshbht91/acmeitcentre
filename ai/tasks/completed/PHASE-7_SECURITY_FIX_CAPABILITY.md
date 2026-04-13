# ============================================
# TASK: PHASE-7_SECURITY_FIX_CAPABILITY.md
# ============================================

GOAL:
Secure sensitive AJAX endpoints by restricting access using capability checks.

STEP:
Add current_user_can() validation to export and delete AJAX handlers.

FILES:
/wp-content/plugins/acme-core/modules/module-form.php

INPUT:
AJAX requests (export/delete)

EXPECTED_OUTPUT:
- Only authorized users (admin) can access export/delete
- Unauthorized users receive error response
- No data exposure

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7 SECURITY FIX)
- If mismatch → STOP

DUPLICATION_CHECK:
- If capability check already exists → STOP

PRECONDITION_CHECK:
- AJAX handlers exist → YES

STRICT_SCOPE:
- ONLY add capability check
- NO logic change

CONSTRAINTS:
- Must use current_user_can('manage_options')
- Must return wp_send_json_error on fail

SECURITY_HINT:
- Prevent unauthorized access
- Protect CRM data

FAIL_CONDITIONS:
- No capability check
- Unauthorized access allowed

SUCCESS_CRITERIA:
- Unauthorized user blocked
- Admin access allowed
- No errors

# ============================================