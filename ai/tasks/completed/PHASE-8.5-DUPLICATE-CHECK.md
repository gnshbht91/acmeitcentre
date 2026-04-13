# ============================================
# TASK: PHASE-8.5-DUPLICATE-CHECK.md
# ============================================

GOAL:
Prevent duplicate lead entries by checking existing records before insert

STEP:
Create duplicate check function in DAL and call before insert

FILES:
- wp-content/plugins/acme-core/dal/form-dal.php
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- $phone
- $email
- $ip

EXPECTED_OUTPUT:
- Duplicate detected correctly
- Insert blocked if duplicate found
- Proper error response returned

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 8.5)
- If mismatch → STOP

DUPLICATION_CHECK:
- Function must not already exist

PRECONDITION_CHECK:
- Table exists → YES
- Insert function exists → YES

STRICT_SCOPE:
- Only duplicate logic
- No schema change

CONSTRAINTS:
- Must use $wpdb
- No full table scan (use WHERE)
- Must be fast

SECURITY_HINT:
- sanitize inputs before query

FAIL_CONDITIONS:
- Duplicate still inserted
- Wrong match logic
- Performance issue

SUCCESS_CRITERIA:
- Duplicate blocked
- Response clear
- System stable

# ============================================