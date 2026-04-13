# ============================================
# TASK: PHASE-8.2-CAPTURE-URL.md
# ============================================

GOAL:
Capture current page URL and store it in database

STEP:
Fetch URL in module and pass it to DAL insert function

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- $_SERVER['REQUEST_URI']

EXPECTED_OUTPUT:
- URL captured correctly
- Passed to DAL
- Stored in DB

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 8.2)
- If mismatch → STOP

DUPLICATION_CHECK:
- URL capture must not already exist
- If exists → STOP

PRECONDITION_CHECK:
- DAL supports url field → YES
- Insert function updated → YES

STRICT_SCOPE:
- Only capture URL
- No DB change
- No frontend change

CONSTRAINTS:
- Use $_SERVER only
- No JS usage
- No user input trust

SECURITY_HINT:
- sanitize URL before insert

FAIL_CONDITIONS:
- Empty URL
- Wrong URL
- PHP error

SUCCESS_CRITERIA:
- URL stored correctly in DB
- No break in insert flow

# ============================================