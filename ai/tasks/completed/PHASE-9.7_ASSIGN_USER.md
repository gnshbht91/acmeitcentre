# ============================================
# TASK: PHASE-9.7_ASSIGN_USER.md
# ============================================

GOAL:
Allow admin to assign leads to WordPress users from CRM table

STEP:
Add user dropdown per lead and save assigned user_id

FILES:
/wp-content/plugins/acme-core/acme-core.php
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
lead_id
user_id

EXPECTED_OUTPUT:
- User dropdown visible per lead
- Assigned user saved in DB
- Assigned user persists correctly
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 9.7)
- If mismatch → STOP

DUPLICATION_CHECK:
- If assign system already exists → STOP

PRECONDITION_CHECK:
- Required files exist → YES
- Required folders exist → YES
- Required functions exist → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only defined STEP allowed
- No additional logic
- No refactoring
- No scope expansion

CONSTRAINTS:
- Follow WordPress coding standards
- Do NOT modify unrelated files
- Do NOT introduce new features
- Do NOT assume missing data

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? YES
- Nonce required? YES

FAIL_CONDITIONS:
- Assignment not saving
- Wrong lead updated
- Missing nonce
- PHP error / warning
- Unexpected output

SUCCESS_CRITERIA:
- Assignment works correctly
- No PHP errors/warnings/notices
- Task completion pipeline executed fully
- System state updated correctly

# ============================================