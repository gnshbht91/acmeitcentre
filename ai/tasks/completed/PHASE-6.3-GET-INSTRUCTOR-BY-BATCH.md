# ============================================
# TASK: PHASE-6.3-GET-INSTRUCTOR-BY-BATCH.md
# ============================================

GOAL:
Create function to fetch instructor linked to a batch

STEP:
Add method in DAL to get instructor by batch_id

FILES:
- wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

INPUT:
- batch_id

EXPECTED_OUTPUT:
- Function acme_get_instructor_by_batch($batch_id)
- Returns instructor data (array)
- Uses wpdb prepare
- No PHP error

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 6.3)
- If mismatch → STOP

DUPLICATION_CHECK:
- If similar function exists → STOP

PRECONDITION_CHECK:
- DAL file exists → YES
- batch table exists → YES
- instructor relation exists → YES

STRICT_SCOPE:
- Only add function
- Do not modify existing code

CONSTRAINTS:
- Follow DAL structure
- Use prepared query
- No raw SQL

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? NO
- Nonce required? NO

FAIL_CONDITIONS:
- duplicate function
- SQL not prepared
- wrong return type

SUCCESS_CRITERIA:
- Function exists
- Returns correct data
- No error