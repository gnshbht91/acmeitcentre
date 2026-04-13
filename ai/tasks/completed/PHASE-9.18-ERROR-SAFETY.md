# ============================================
# TASK: PHASE-9.18-ERROR-SAFETY.md
# ============================================

GOAL:
Implement strict error safety across the CRM system to prevent fatal errors, suppress sensitive output, and ensure controlled and consistent failure handling.

STEP:
Add fail-safe guards, controlled error responses, and safe fallbacks without modifying business logic or system flow.

FILES:
- /wp-content/plugins/acme-core/modules/module-form.php
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
None

EXPECTED_OUTPUT:
- No PHP warnings or fatal errors exposed
- All failures return controlled responses
- No sensitive data (SQL, paths, stack traces) exposed
- AJAX always returns valid JSON response
- System remains stable under failure conditions

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.18-ERROR-SAFETY)
- If mismatch → STOP

DUPLICATION_CHECK:
- If error safety already implemented → STOP

PRECONDITION_CHECK:
- Phase 9.17.1 completed → YES
- Input validation and edge handling present → YES

STRICT_SCOPE:
- ONLY add error handling
- DO NOT change business logic
- DO NOT modify UI
- DO NOT refactor architecture

CONSTRAINTS:
- Use wp_send_json_error() for AJAX failures
- Never echo raw PHP errors
- Use safe default return values
- Suppress undefined behavior safely
- Avoid try/catch unless absolutely required
- No debugging output allowed

SECURITY_HINT:
- Prevent information leakage
- Hide internal structure from response

FAIL_CONDITIONS:
- PHP warning visible
- Fatal error breaks execution
- Raw error output exposed
- Invalid JSON response
- Sensitive data leak

SUCCESS_CRITERIA:
- All errors handled safely
- No crash under any condition
- Clean and consistent failure responses
- System stable

# ============================================