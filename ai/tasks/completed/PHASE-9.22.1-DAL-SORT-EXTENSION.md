# ============================================
# TASK: PHASE-9.22.1-DAL-SORT-EXTENSION.md
# ============================================

GOAL:
Extend DAL function to support sorting without breaking existing functionality.

STEP:
Add optional sorting parameters to acme_get_leads function.

FILES:
- /wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
- $orderby (string, optional)
- $order (string, optional)

EXPECTED_OUTPUT:
- Existing functionality unchanged
- Sorting applied when parameters provided
- Safe query execution

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.22.1-DAL-SORT-EXTENSION)
- If mismatch → STOP

DUPLICATION_CHECK:
- If sorting already supported → STOP

PRECONDITION_CHECK:
- acme_get_leads function exists → YES

STRICT_SCOPE:
- ONLY extend acme_get_leads function
- DO NOT modify other functions
- DO NOT change function name
- DO NOT break existing parameters

CONSTRAINTS:
- New parameters must be optional
- Default behavior unchanged
- Use whitelist for ORDER BY
- No raw input allowed
- Query must remain valid

FAIL_CONDITIONS:
- Existing functionality breaks
- Required params changed
- SQL injection possible
- Function signature broken

SUCCESS_CRITERIA:
- Old calls still work
- New sorting works
- No errors or warnings

# ============================================