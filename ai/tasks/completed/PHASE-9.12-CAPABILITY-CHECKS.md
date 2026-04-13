# ============================================
# TASK: PHASE-9.12-CAPABILITY-CHECKS.md
# ============================================

GOAL:
Add capability checks to all POST and AJAX handlers to prevent unauthorized users from modifying CRM data.

STEP:
Add current_user_can('manage_options') validation before processing any CRM POST or AJAX action.

FILES:
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/modules/module-form.php

INPUT:
None

EXPECTED_OUTPUT:
- All POST handlers check current_user_can before execution
- All AJAX handlers validate user capability
- Unauthorized users receive error response or exit
- No functionality break for admin users

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.12-CAPABILITY-CHECKS)
- If mismatch → STOP

DUPLICATION_CHECK:
- If capability checks already exist → STOP

PRECONDITION_CHECK:
- Files exist → YES
- CRM POST handlers exist → YES
- AJAX handlers exist → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY add capability checks
- NO refactoring
- NO logic changes

CONSTRAINTS:
- Use current_user_can('manage_options')
- Use wp_die() or wp_send_json_error for failure
- Do NOT modify unrelated code

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? NO
- Nonce required? ALREADY EXISTS

FAIL_CONDITIONS:
- Missing capability check in any handler
- Wrong capability used
- Breaks existing functionality

SUCCESS_CRITERIA:
- All handlers protected
- Unauthorized access blocked
- No errors introduced

# ============================================