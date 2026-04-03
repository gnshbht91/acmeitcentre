# ============================================
# TASK: PHASE-6.7-FIX-DAL-CPT.md
# ============================================

GOAL:
DAL functions must fetch data from WordPress CPT (wp_posts) instead of custom tables.

STEP:
Replace custom table queries with WordPress-native CPT queries in DAL functions.

FILES:
- wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

EXPECTED_OUTPUT:
- acme_get_batches_by_course() returns correct batch data using CPT
- acme_get_instructor_by_batch() returns correct instructor data using CPT
- No direct custom table query (wp_acme_*)
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 6.7)
- If mismatch → STOP

DUPLICATION_CHECK:
- If CPT logic already exists → STOP

PRECONDITION_CHECK:
- class-acme-dal.php exists → YES
- CPTs (course, batch, instructor) exist → YES

STRICT_SCOPE:
- Only replace query logic
- No new functions
- No refactor

CONSTRAINTS:
- Use WP_Query or get_posts()
- Do NOT use $wpdb for CPT
- Follow WordPress standards

SECURITY_HINT:
- Sanitization: YES (intval for IDs)
- Escaping: N/A (data layer)
- Nonce: N/A

FAIL_CONDITIONS:
- Any custom table query remains
- Wrong CPT slug used
- PHP error

SUCCESS_CRITERIA:
- Data returned correctly
- No empty arrays for valid IDs
- System stable