# ============================================
# TASK: PHASE-5.4_GET_BATCHES.md
# ============================================

GOAL:
Create DAL method to fetch batches with optional course filter

STEP:
Add get_batches($course_id = null) method

FILES:
wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

EXPECTED_OUTPUT:
- Method get_batches() created
- Returns array of batches OR empty array
- Supports optional course_id filter
- No PHP error

TASK_VALIDATION:
- Must match PHASE 5.4
- If mismatch → STOP

DUPLICATION_CHECK:
- If method already exists → STOP

STRICT_SCOPE:
- Only method creation
- No UI
- No external usage

CONSTRAINTS:
- Use $wpdb
- Use prepare for filter
- Return array

# ============================================