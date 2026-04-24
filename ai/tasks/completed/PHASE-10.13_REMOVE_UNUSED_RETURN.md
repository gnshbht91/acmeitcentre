# ============================================
# TASK: PHASE-10.13_REMOVE_UNUSED_RETURN.md
# ============================================

GOAL:
Remove misleading return value from acme_create_tables().

STEP:
Delete "return false;" from function.

FILES:
wp-content/plugins/acme-core/acme-core.php

EXPECTED_OUTPUT:
- return statement removed
- function ends cleanly
- no PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.13_REMOVE_UNUSED_RETURN)
- If mismatch → STOP

DUPLICATION_CHECK:
- If return already removed → STOP

PRECONDITION_CHECK:
- function exists → YES
- return false present → YES

STRICT_SCOPE:
- ONLY remove return false
- DO NOT modify other code

CONSTRAINTS:
- no logic change
- no new return added

FAIL_CONDITIONS:
- wrong line removed
- function broken

SUCCESS_CRITERIA:
- no return false
- plugin works same

# ============================================