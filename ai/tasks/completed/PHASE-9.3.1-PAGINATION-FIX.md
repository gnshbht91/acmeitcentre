# ============================================
# TASK: PHASE-9.3.1-PAGINATION-FIX.md
# ============================================

GOAL:
Fix pagination edge case when total leads = 0

STEP:
Ensure total_pages is never 0

FILES:
- wp-content/plugins/acme-core/acme-core.php

INPUT:
Pagination logic

EXPECTED_OUTPUT:
- Page shows "Page 1 of 1" when no data
- No UI inconsistency

TASK_VALIDATION:
- Must match FIX phase (9.3.1)
- If mismatch → STOP

DUPLICATION_CHECK:
- Fix must not already exist

PRECONDITION_CHECK:
- Pagination implemented → YES

STRICT_SCOPE:
- Only fix total_pages calculation
- No other change

CONSTRAINTS:
- Must use max(1, ...)

FAIL_CONDITIONS:
- total_pages still 0
- UI shows "Page 1 of 0"

SUCCESS_CRITERIA:
- total_pages minimum 1
- UI stable

# ============================================