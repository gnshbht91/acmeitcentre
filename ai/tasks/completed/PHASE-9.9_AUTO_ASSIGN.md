# ============================================
# TASK: PHASE-9.9_AUTO_ASSIGN.md
# ============================================

GOAL:
Automatically assign new leads to WordPress users

STEP:
Assign user_id during lead insert using simple round-robin logic

FILES:
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
lead data (during insert)

EXPECTED_OUTPUT:
- New leads automatically assigned
- user_id stored in DB
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 9.9)
- If mismatch → STOP

DUPLICATION_CHECK:
- If auto-assign already exists → STOP

PRECONDITION_CHECK:
- Leads insert working → YES
- user_id column exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only auto-assign during insert
- No UI change
- No manual assign modification

CONSTRAINTS:
- Use simple logic (no over-engineering)
- Do NOT modify unrelated functions
- Do NOT create new tables

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? YES
- Nonce required? N/A

FAIL_CONDITIONS:
- Assignment not happening
- Wrong user assigned
- DB error
- Unexpected behavior

SUCCESS_CRITERIA:
- Leads auto-assigned correctly
- No PHP errors
- Task pipeline completed

# ============================================