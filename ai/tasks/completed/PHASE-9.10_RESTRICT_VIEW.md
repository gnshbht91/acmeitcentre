# ============================================
# TASK: PHASE-9.10_RESTRICT_VIEW.md
# ============================================

GOAL:
Restrict CRM lead visibility based on logged-in user role

STEP:
Filter leads query to show only assigned leads for non-admin users

FILES:
/wp-content/plugins/acme-core/acme-core.php
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
current_user_id
user_role

EXPECTED_OUTPUT:
- Admin sees all leads
- Non-admin sees only their assigned leads
- No data leak
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 9.10)
- If mismatch → STOP

DUPLICATION_CHECK:
- If restriction already exists → STOP

PRECONDITION_CHECK:
- CRM table working → YES
- user_id column exists → YES
- Assignment system working → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only restrict lead fetching
- No UI change
- No DB schema change

CONSTRAINTS:
- Use WordPress role system
- Do NOT hardcode roles
- Do NOT modify unrelated logic

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? YES
- Nonce required? NO

FAIL_CONDITIONS:
- Admin cannot see all leads
- Users see others' leads
- Empty results incorrectly
- PHP error / warning

SUCCESS_CRITERIA:
- Correct role-based filtering
- No data leak
- No PHP errors
- Task pipeline completed

# ============================================