# ============================================
# TASK: PHASE-6.1.2-REMOVE-LOADER-CONDITION.md
# ============================================

GOAL:
Ensure loader is included using direct require_once without conditional logic

STEP:
Replace conditional loader include with direct require_once

FILES:
- wp-content/plugins/acme-core/acme-core.php

INPUT:
- Existing conditional loader include block

EXPECTED_OUTPUT:
- require_once ACME_PATH . 'core/loader.php'; present
- No file_exists condition remains
- No PHP error

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 6.1.2)
- If mismatch → STOP

DUPLICATION_CHECK:
- If condition already removed → STOP

PRECONDITION_CHECK:
- acme-core.php exists → YES
- Conditional loader include exists → YES

STRICT_SCOPE:
- Only replace condition block
- No additional logic
- No refactor

CONSTRAINTS:
- Follow WordPress coding standards
- Do NOT modify unrelated code
- Do NOT add new logic

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? NO
- Nonce required? NO

FAIL_CONDITIONS:
- Condition still present
- Syntax error
- Incorrect replacement

SUCCESS_CRITERIA:
- Clean require_once present
- No errors
- Loader executes normally