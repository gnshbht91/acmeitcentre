# ============================================
# TASK: PHASE-6.3-FIX-INSTRUCTOR-DATA.md
# ============================================

GOAL:
Modify function to return full instructor data instead of only instructor_id

STEP:
Update query to fetch instructor details using join or second query

FILES:
- wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

INPUT:
- Existing function acme_get_instructor_by_batch

EXPECTED_OUTPUT:
- Returns full instructor data (not just ID)
- Array contains instructor fields
- No PHP error

TASK_VALIDATION:
- Must improve PHASE 6.3 output
- If mismatch → STOP

DUPLICATION_CHECK:
- Function exists → YES

PRECONDITION_CHECK:
- instructor table exists → YES

STRICT_SCOPE:
- Only update query
- No function rename
- No structural change

CONSTRAINTS:
- Use prepared query
- Follow DAL style

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? NO

FAIL_CONDITIONS:
- still returns only ID
- SQL not prepared
- wrong structure

SUCCESS_CRITERIA:
- Full instructor data returned
- No extra queries outside DAL