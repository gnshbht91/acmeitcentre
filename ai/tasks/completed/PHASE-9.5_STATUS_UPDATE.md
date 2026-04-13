# ============================================
# TASK: PHASE-9.5_STATUS_UPDATE.md
# ============================================

GOAL:
Allow admin to update lead status from CRM table

STEP:
Add status update dropdown in table with form submission

FILES:
/wp-content/plugins/acme-core/acme-core.php
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
lead_id
status

EXPECTED_OUTPUT:
- Status dropdown visible in table row
- Status updates successfully on submit
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 9.5)
- If mismatch → STOP

DUPLICATION_CHECK:
- If status update already implemented → STOP

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
- Status not updating
- Wrong row updated
- Missing nonce
- PHP error / warning
- Unexpected output

SUCCESS_CRITERIA:
- Status updates correctly
- No PHP errors/warnings/notices
- Task completion pipeline executed fully
- System state updated correctly

# ============================================