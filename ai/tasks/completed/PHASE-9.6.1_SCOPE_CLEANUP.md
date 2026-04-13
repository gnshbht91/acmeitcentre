# ============================================
# TASK: PHASE-9.6.1_SCOPE_CLEANUP.md
# ============================================

GOAL:
Remove unintended DB schema and migration changes from Phase 9.6

STEP:
Remove DB version bump and forced migration trigger

FILES:
/wp-content/plugins/acme-core/acme-core.php
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
None

EXPECTED_OUTPUT:
- No DB version change logic present
- No forced migration logic present
- Notes feature continues working
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 9.6.1)
- If mismatch → STOP

DUPLICATION_CHECK:
- If cleanup already done → STOP

PRECONDITION_CHECK:
- Required files exist → YES
- Required folders exist → YES
- Required functions exist → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only remove DB migration related code
- Do NOT modify note UI or save logic
- No additional logic
- No refactoring

CONSTRAINTS:
- Follow WordPress coding standards
- Do NOT modify unrelated code
- Do NOT introduce new features
- Do NOT assume missing data

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? NO
- Nonce required? NO

FAIL_CONDITIONS:
- Notes stop working
- DB logic breaks
- PHP error / warning
- Unexpected output

SUCCESS_CRITERIA:
- Notes system works as before
- No DB migration logic present
- No PHP errors/warnings/notices
- Task completion pipeline executed fully

# ============================================