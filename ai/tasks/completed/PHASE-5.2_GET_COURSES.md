# ============================================
# TASK: PHASE-5.2_GET_COURSES.md
# ============================================

GOAL:
Create DAL method to fetch all courses from database

STEP:
Add get_courses() method inside DAL class

FILES:
wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

EXPECTED_OUTPUT:
- get_courses() method created
- Returns array of courses OR empty array
- No PHP error

TASK_VALIDATION:
- Must match PHASE 5.2
- If mismatch → STOP

DUPLICATION_CHECK:
- If method already exists → STOP

STRICT_SCOPE:
- Only add method
- No UI
- No external usage yet

CONSTRAINTS:
- Use $wpdb
- Use prepare if needed
- Return array

# ============================================