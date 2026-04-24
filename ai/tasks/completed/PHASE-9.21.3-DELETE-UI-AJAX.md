# ============================================
# TASK: PHASE-9.21.3-DELETE-UI-AJAX.md
# ============================================

GOAL:
Allow admin to delete a lead via UI button using AJAX.

STEP:
Add delete button and JavaScript to trigger AJAX delete request.

FILES:
- /wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- lead_id from row

EXPECTED_OUTPUT:
- Delete button visible per row
- Confirmation before delete
- AJAX request triggered
- Row removed on success

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.21.3-DELETE-UI-AJAX)
- If mismatch → STOP

DUPLICATION_CHECK:
- If delete button exists → STOP

PRECONDITION_CHECK:
- AJAX handler exists → YES

STRICT_SCOPE:
- ONLY add UI button and JS
- DO NOT modify backend
- DO NOT refactor structure

CONSTRAINTS:
- Use existing table row structure
- Attach lead_id as data attribute
- Use admin-ajax.php endpoint
- Include nonce in request
- Use confirm() for confirmation
- Disable button on click

FAIL_CONDITIONS:
- No confirmation popup
- Multiple clicks allowed
- No nonce sent
- Page reload occurs
- Row not removed

SUCCESS_CRITERIA:
- Delete works from UI
- No duplicate requests
- Clean user experience

# ============================================