# ============================================
# TASK: PHASE-6.2-GET-BATCHES-BY-COURSE.md
# ============================================

GOAL:
Create function to fetch batches linked to a specific course using DAL

STEP:
Add method in batch DAL to get batches by course_id

FILES:
- wp-content/plugins/acme-core/dal/class-batch-dal.php

INPUT:
- course_id

EXPECTED_OUTPUT:
- Function acme_get_batches_by_course($course_id)
- Returns array of batches
- Uses wpdb + prepare
- No PHP error

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 6.2)
- If mismatch → STOP

DUPLICATION_CHECK:
- If function already exists → STOP

PRECONDITION_CHECK:
- DAL file exists → YES
- batch table exists → YES

STRICT_SCOPE:
- Only add new function
- No modification to existing functions

CONSTRAINTS:
- Follow DAL structure
- Use $wpdb->prepare()
- No raw SQL concatenation

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? NO
- Nonce required? NO

FAIL_CONDITIONS:
- SQL not prepared
- wrong return type
- duplicate function

SUCCESS_CRITERIA:
- Function exists
- Returns correct data
- No error