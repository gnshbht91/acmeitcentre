# ============================================
# TASK: PHASE-8.3-CAPTURE-UTM.md
# ============================================

GOAL:
Capture UTM parameters from URL and store them in database

STEP:
Read UTM values from $_GET and pass to DAL insert function

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- $_GET['utm_source']
- $_GET['utm_medium']
- $_GET['utm_campaign']

EXPECTED_OUTPUT:
- UTM values captured
- Stored in DB
- No errors if missing

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 8.3)
- If mismatch → STOP

DUPLICATION_CHECK:
- UTM capture must not already exist
- If exists → STOP

PRECONDITION_CHECK:
- DAL supports utm fields → YES
- Insert function updated → YES

STRICT_SCOPE:
- Only capture UTM
- No DB change
- No frontend change

CONSTRAINTS:
- Use $_GET only
- Must handle missing values
- Must sanitize

SECURITY_HINT:
- sanitize all values

FAIL_CONDITIONS:
- Undefined index error
- Wrong mapping
- PHP error

SUCCESS_CRITERIA:
- UTM saved correctly
- System stable

# ============================================