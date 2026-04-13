# ============================================
# TASK: PHASE-9.8_ASSIGN_UX_REFINEMENT.md
# ============================================

GOAL:
Improve assignment UX by replacing auto-submit with manual save action

STEP:
Remove onchange submit and add explicit save button for assignment

FILES:
/wp-content/plugins/acme-core/acme-core.php

INPUT:
lead_id
user_id

EXPECTED_OUTPUT:
- Assign dropdown visible
- Save button present
- Assignment only updates on button click
- No accidental updates

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 9.8)
- If mismatch → STOP

DUPLICATION_CHECK:
- If manual assign UX already implemented → STOP

PRECONDITION_CHECK:
- Required files exist → YES
- Assign system exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only UI/UX refinement for assignment
- No DB change
- No logic expansion

CONSTRAINTS:
- Follow WordPress UI standards
- Do NOT modify unrelated code
- Do NOT introduce new features

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? YES
- Nonce required? YES

FAIL_CONDITIONS:
- Assignment stops working
- Auto submit still active
- Missing nonce
- PHP error / warning

SUCCESS_CRITERIA:
- Manual save works correctly
- No accidental updates
- No PHP errors
- Task pipeline completed

# ============================================