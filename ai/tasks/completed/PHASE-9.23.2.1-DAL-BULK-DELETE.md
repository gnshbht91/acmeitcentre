# ============================================
# TASK: PHASE-9.23.2.1-DAL-BULK-DELETE.md
# ============================================

GOAL:
Enable deletion of multiple leads using DAL function.

STEP:
Create new DAL function to delete multiple leads by ID array.

FILES:
- /wp-content/plugins/acme-core/dal/form-dal.php

EDIT_LOCATION:
- Inside DAL file
- After existing delete function (acme_delete_lead_by_id)

INPUT:
- $lead_ids (array of integers)

EXPECTED_OUTPUT:
- All valid IDs deleted from database
- Function returns true/false

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.23.2.1-DAL-BULK-DELETE)
- If mismatch → STOP

DUPLICATION_CHECK:
- If bulk delete function exists → STOP

PRECONDITION_CHECK:
- Single delete function exists → YES

STRICT_SCOPE:
- ONLY create new function
- DO NOT modify existing functions
- DO NOT modify module or UI
- DO NOT add permission checks

CONSTRAINTS:
- Input must be array
- Validate each ID using intval
- Skip invalid IDs
- Use $wpdb->delete
- Table name must match existing
- Return true if executed, false if invalid input

FAIL_CONDITIONS:
- Non-array input accepted
- Raw input used
- Existing functions modified
- Permission logic added

SUCCESS_CRITERIA:
- Function works for multiple IDs
- No errors
- No warnings
- Safe DB operation

# ============================================