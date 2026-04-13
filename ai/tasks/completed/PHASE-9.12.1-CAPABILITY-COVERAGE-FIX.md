# ============================================
# TASK: PHASE-9.12.1-CAPABILITY-COVERAGE-FIX.md
# ============================================

GOAL:
Ensure ALL wp_ajax_ handlers have proper capability checks except explicitly public endpoints.

STEP:
Scan all wp_ajax_ handlers and add current_user_can('manage_options') where missing.

FILES:
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/modules/module-form.php
- /wp-content/plugins/acme-core/modules/module-crm.php

INPUT:
None

EXPECTED_OUTPUT:
- Every wp_ajax_ handler includes capability check
- Public handler (acme_handle_form) remains accessible
- No unauthorized AJAX execution possible
- No existing functionality breaks

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.12.1-CAPABILITY-COVERAGE-FIX)
- If mismatch → STOP

DUPLICATION_CHECK:
- If all handlers already protected → STOP

PRECONDITION_CHECK:
- Files exist → YES
- wp_ajax_ handlers exist → YES

STRICT_SCOPE:
- ONLY add missing capability checks
- DO NOT modify logic
- DO NOT change existing checks

CONSTRAINTS:
- Use current_user_can('manage_options')
- Use wp_send_json_error for AJAX
- Skip public handler: acme_handle_form

SECURITY_HINT:
- Capability check required → YES

FAIL_CONDITIONS:
- Any AJAX handler left unprotected
- Public handler accidentally blocked
- Syntax errors introduced

SUCCESS_CRITERIA:
- All AJAX endpoints protected
- Public form still works
- No bypass possible

# ============================================