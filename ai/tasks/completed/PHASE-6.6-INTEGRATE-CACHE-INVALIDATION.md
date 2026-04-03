# ============================================
# TASK: PHASE-6.6-INTEGRATE-CACHE-INVALIDATION.md
# ============================================

GOAL:
Ensure cache invalidation function is actually used during data changes

STEP:
Identify and integrate cache clear function into batch data operations

FILES:
- class-acme-dal.php
- any batch insert/update/delete functions (if exist)

INPUT:
- acme_clear_batch_cache function

EXPECTED_OUTPUT:
- cache cleared when data changes
- function is actively used

TASK_VALIDATION:
- Must ensure invalidation is triggered
- If not → FAIL

DUPLICATION_CHECK:
- Function exists → YES

PRECONDITION_CHECK:
- invalidation function exists → YES

STRICT_SCOPE:
- Only integrate function calls
- No new architecture

CONSTRAINTS:
- Call only on data change
- Use correct parameters

FAIL_CONDITIONS:
- function unused
- wrong params passed

SUCCESS_CRITERIA:
- cache cleared on update
- no stale data risk