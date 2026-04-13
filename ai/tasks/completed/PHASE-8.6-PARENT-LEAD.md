# ============================================
# TASK: PHASE-8.6-PARENT-LEAD.md
# ============================================

GOAL:
Link duplicate leads to existing lead instead of blocking them

STEP:
Modify duplicate logic to return parent ID and use it in insert

FILES:
- wp-content/plugins/acme-core/dal/form-dal.php
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- duplicate lead ID

EXPECTED_OUTPUT:
- Duplicate leads inserted
- parent_id assigned
- status updated

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 8.6)
- If mismatch → STOP

DUPLICATION_CHECK:
- Old blocking logic must be removed

PRECONDITION_CHECK:
- Duplicate function exists → YES
- parent_id column exists → YES

STRICT_SCOPE:
- Only duplicate handling logic
- No schema change

CONSTRAINTS:
- Must NOT block insert
- Must assign parent_id
- Must update status

SECURITY_HINT:
- Use sanitized values

FAIL_CONDITIONS:
- Duplicate still blocked
- parent_id not set
- wrong linking

SUCCESS_CRITERIA:
- Duplicate saved with parent link
- system stable

# ============================================