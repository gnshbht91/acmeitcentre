# ============================================
# TASK: PHASE-7.4.2_FIX_AJAX_JS.md
# ============================================

GOAL:
Fix AJAX submission by correcting selector and action mismatch so that form properly triggers WordPress AJAX handler.

STEP:
Update existing AJAX JS to match actual form selector and registered AJAX action.

FILES:
/wp-content/plugins/acme-core/modules/module-form.php

INPUT:
None

EXPECTED_OUTPUT:
- AJAX correctly binds to form
- Correct action triggers backend handler
- No page reload
- No console error

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.4.2)
- If mismatch → STOP

DUPLICATION_CHECK:
- Ensure no duplicate JS handlers exist
- If duplicate → STOP

PRECONDITION_CHECK:
- Form exists (.acme-form) → YES
- AJAX handler exists (acme_form_submit) → YES
- Existing JS block exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY modify JS selector and action
- NO HTML change
- NO PHP logic change
- NO DB change

CONSTRAINTS:
- Must use existing form class (.acme-form)
- Must use registered action (acme_form_submit)
- Do NOT introduce new script files
- Do NOT modify unrelated code

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? YES (AJAX URL)
- Nonce required? NO

FAIL_CONDITIONS:
- AJAX still not triggered
- Wrong handler called
- Page reload occurs
- Console error

SUCCESS_CRITERIA:
- AJAX request fires successfully
- Correct handler triggered
- No JS errors
- Task pipeline completed

# ============================================