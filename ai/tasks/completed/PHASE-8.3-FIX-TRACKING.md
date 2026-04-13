# ============================================
# TASK: PHASE-8.3-FIX-TRACKING.md
# ============================================

GOAL:
Fix tracking system by capturing URL and UTM parameters from frontend and sending to backend.

STEP:
Add hidden fields in form + JS to populate them before submission.

FILES:
/wp-content/plugins/acme-core/modules/module-form.php

INPUT:
Browser URL with query params (utm_source, utm_medium, utm_campaign)

EXPECTED_OUTPUT:
- URL captured
- UTM values captured
- Data sent in AJAX
- Stored in DB

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-8.3-FIX-TRACKING)
- If mismatch → STOP

DUPLICATION_CHECK:
- If hidden fields already exist → STOP

PRECONDITION_CHECK:
- Form render function exists → YES

STRICT_SCOPE:
- ONLY frontend tracking fix
- NO backend logic change

CONSTRAINTS:
- Must not break form submit
- Must not expose raw JS errors

SECURITY_HINT:
- Data sanitized in backend already

FAIL_CONDITIONS:
- Fields empty in DB
- JS error

SUCCESS_CRITERIA:
- URL + UTM stored correctly
- No errors

# ============================================