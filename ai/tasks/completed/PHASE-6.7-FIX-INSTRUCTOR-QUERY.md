# ============================================
# TASK: PHASE-6.7-FIX-INSTRUCTOR-QUERY.md
# ============================================

GOAL:
Fix unreliable instructor query caused by serialized meta storage

STEP:
Replace fragile LIKE-based query with safe matching logic

FILES:
- wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

INPUT:
- current serialized meta (_instructor_courses)

EXPECTED_OUTPUT:
- correct instructor returned
- no false positives
- stable query

TASK_VALIDATION:
- Must match TASK_BOARD (PHASE 6.7)
- If mismatch → STOP

DUPLICATION_CHECK:
- If already fixed → STOP

PRECONDITION_CHECK:
- audit completed → YES

STRICT_SCOPE:
- Only modify instructor query
- No other changes

CONSTRAINTS:
- Must handle serialized array safely
- Must not break existing data

FAIL_CONDITIONS:
- wrong instructor returned
- empty result
- PHP error

SUCCESS_CRITERIA:
- correct instructor mapping
- stable logic