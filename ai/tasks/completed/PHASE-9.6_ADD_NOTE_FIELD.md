# ============================================
# TASK: PHASE-9.6_ADD_NOTE_FIELD.md
# ============================================

GOAL:
Add notes field to CRM leads table UI and store notes in database

STEP:
Add note input and save logic for each lead

FILES:
/wp-content/plugins/acme-core/acme-core.php
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
lead_id
note

EXPECTED_OUTPUT:
- Note input visible per lead
- Note saved in database
- Note displayed correctly
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 9.6)
- If mismatch → STOP

DUPLICATION_CHECK:
- If note system already exists → STOP

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
- Note not saving
- Wrong lead updated
- Missing nonce
- PHP error / warning
- Unexpected output

SUCCESS_CRITERIA:
- Notes save and display correctly
- No PHP errors/warnings/notices
- Task completion pipeline executed fully
- System state updated correctly

# ============================================