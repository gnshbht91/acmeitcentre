# ============================================
# TASK: PHASE-9.21.3-DELETE-UI-AJAX.md
# ============================================

GOAL:
Enable lead deletion from CRM UI using AJAX.

STEP:
Add delete button and JavaScript in CRM table rendering file.

FILES:
- /wp-content/plugins/acme-core/acme-core.php

INPUT:
- lead_id

EXPECTED_OUTPUT:
- Delete button visible in each row
- Confirmation popup appears
- AJAX request sent
- Row removed on success

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.21.3-DELETE-UI-AJAX)
- If mismatch → STOP

DUPLICATION_CHECK:
- If delete UI already exists → STOP

PRECONDITION_CHECK:
- AJAX handler exists → YES

STRICT_SCOPE:
- ONLY modify acme-core.php
- DO NOT modify backend logic
- DO NOT modify DAL

CONSTRAINTS:
- Add button inside existing table row
- Use data-id for lead_id
- Use admin-ajax.php
- Pass nonce
- Use confirm()
- Disable button after click

FAIL_CONDITIONS:
- Wrong file modified
- No confirmation popup
- No nonce sent
- Page reload occurs
- Row not removed

SUCCESS_CRITERIA:
- Delete works from UI
- No duplicate requests
- No errors

# ============================================