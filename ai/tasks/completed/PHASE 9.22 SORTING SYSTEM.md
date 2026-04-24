# ============================================
# TASK: PHASE-9.22-SORTING-SYSTEM.md
# ============================================

GOAL:
Enable secure sorting of CRM leads using URL parameters without modifying DAL.

STEP:
Add sorting parameter validation and apply ORDER BY in existing query.

FILES:
- /wp-content/plugins/acme-core/acme-core.php

INPUT:
- $_GET['orderby']
- $_GET['order']

EXPECTED_OUTPUT:
- Leads sorted correctly
- Invalid input safely ignored
- Default sorting applied when needed

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.22-SORTING-SYSTEM)
- If mismatch → STOP

DUPLICATION_CHECK:
- If sorting already implemented → STOP

PRECONDITION_CHECK:
- Leads query exists in acme-core.php → YES

STRICT_SCOPE:
- ONLY modify acme-core.php
- DO NOT modify DAL
- DO NOT modify module files
- DO NOT modify DB structure

CONSTRAINTS:
- Allowed columns ONLY:
  ['name','email','course','created_at']
- Allowed order ONLY:
  ['asc','desc']
- Use fallback defaults:
  orderby = 'created_at'
  order = 'desc'
- Use isset() before accessing $_GET
- DO NOT use raw $_GET in SQL

FAIL_CONDITIONS:
- Any change in DAL
- Raw $_GET used directly
- Invalid column accepted
- SQL query breaks

SUCCESS_CRITERIA:
- Sorting works correctly
- No SQL injection possible
- No warnings or errors
- Only acme-core.php modified

# ============================================