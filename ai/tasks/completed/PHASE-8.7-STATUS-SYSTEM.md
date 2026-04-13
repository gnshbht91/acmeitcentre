# ============================================
# TASK: PHASE-8.7-STATUS-SYSTEM.md
# ============================================

GOAL:
Standardize lead status system for future CRM usage

STEP:
Ensure consistent status values and default assignment

FILES:
- wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
Existing status logic

EXPECTED_OUTPUT:
- Status standardized
- Default = new
- Duplicate = duplicate
- Ready for future statuses

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 8.7)
- If mismatch → STOP

DUPLICATION_CHECK:
- Status logic must not already be standardized

PRECONDITION_CHECK:
- status column exists → YES
- parent logic working → YES

STRICT_SCOPE:
- No new features
- Only standardization

CONSTRAINTS:
- Use fixed values only
- No dynamic status

SECURITY_HINT:
- No user input for status

FAIL_CONDITIONS:
- Invalid status
- Inconsistent values

SUCCESS_CRITERIA:
- Status values consistent
- System stable

# ============================================