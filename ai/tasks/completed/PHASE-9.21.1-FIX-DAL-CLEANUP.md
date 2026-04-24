# ============================================
# TASK: PHASE-9.21.1-FIX-DAL-CLEANUP.md
# ============================================

GOAL:
Remove capability check from DAL delete function to restore correct architecture separation.

STEP:
Remove permission check from acme_delete_lead_by_id function.

FILES:
- /wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
None

EXPECTED_OUTPUT:
- DAL function contains ONLY data logic
- No permission or auth logic inside DAL

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.21.1-FIX-DAL-CLEANUP)
- If mismatch → STOP

DUPLICATION_CHECK:
- If capability check not present → STOP

PRECONDITION_CHECK:
- acme_delete_lead_by_id function exists

STRICT_SCOPE:
- ONLY remove capability check
- DO NOT modify any other logic
- DO NOT add new code

CONSTRAINTS:
- Do not change function name
- Do not change DB logic
- Do not add new validation

FAIL_CONDITIONS:
- Capability check still present
- Other logic modified
- Function broken

SUCCESS_CRITERIA:
- Capability check removed
- Function unchanged otherwise
- No errors

# ============================================