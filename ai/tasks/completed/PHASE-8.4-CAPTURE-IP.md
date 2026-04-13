# ============================================
# TASK: PHASE-8.4-CAPTURE-IP.md
# ============================================

GOAL:
Capture user IP address safely and store in database

STEP:
Detect IP using server variables and pass to DAL

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- $_SERVER variables

EXPECTED_OUTPUT:
- Correct IP captured
- Stored in DB
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 8.4)
- If mismatch → STOP

DUPLICATION_CHECK:
- IP logic must not already exist
- If exists → STOP

PRECONDITION_CHECK:
- DAL supports ip_address → YES

STRICT_SCOPE:
- Only IP capture
- No DB change

CONSTRAINTS:
- Must handle proxy IP
- Must sanitize
- Must fallback safely

SECURITY_HINT:
- Prevent spoofing issues

FAIL_CONDITIONS:
- Empty IP
- Invalid IP
- PHP error

SUCCESS_CRITERIA:
- IP stored correctly
- System stable

# ============================================