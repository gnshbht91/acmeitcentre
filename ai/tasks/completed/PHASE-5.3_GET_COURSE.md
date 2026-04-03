# ============================================
# TASK: PHASE-5.3_GET_COURSE.md
# ============================================

GOAL:
Create DAL method to fetch a single course by ID

STEP:
Add get_course($id) method with prepared query

FILES:
wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

EXPECTED_OUTPUT:
- Method get_course($id) created
- Returns single course OR null
- Uses prepared statement
- No PHP error

TASK_VALIDATION:
- Must match PHASE 5.3
- If mismatch → STOP

DUPLICATION_CHECK:
- If method already exists → STOP

STRICT_SCOPE:
- Only add method
- No UI
- No external calls

CONSTRAINTS:
- Use $wpdb->prepare()
- Validate ID
- Return array or null

# ============================================