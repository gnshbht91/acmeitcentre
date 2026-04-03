# ============================================
# TASK: PHASE-6.4-OPTIMIZE-QUERIES.md
# ============================================

GOAL:
Optimize DAL queries to reduce database calls and improve performance without changing output

STEP:
Refactor batch and instructor queries to ensure efficient execution

FILES:
- wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

INPUT:
- Existing functions:
  - acme_get_batches_by_course
  - acme_get_instructor_by_batch

EXPECTED_OUTPUT:
- No redundant queries
- Efficient JOIN usage
- Same return structure
- No PHP error

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 6.4)
- If mismatch → STOP

DUPLICATION_CHECK:
- If already optimized → STOP

PRECONDITION_CHECK:
- Functions exist → YES
- Queries working → YES

STRICT_SCOPE:
- Only optimize existing queries
- Do NOT change function names
- Do NOT change return format
- Do NOT add new features

CONSTRAINTS:
- Prefer JOIN over multiple queries
- Avoid repeated DB calls
- Maintain readability

RETURN_RULE:
- Must still return array
- Empty → []

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? NO

FAIL_CONDITIONS:
- output changed
- extra query introduced
- broken query
- PHP error

SUCCESS_CRITERIA:
- reduced DB calls
- same output
- optimized query structure