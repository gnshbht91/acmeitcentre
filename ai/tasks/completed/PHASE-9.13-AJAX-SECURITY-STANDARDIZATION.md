# ============================================
# TASK: PHASE-9.13-AJAX-SECURITY-STANDARDIZATION.md
# ============================================

GOAL:
Standardize nonce validation across all AJAX handlers using check_ajax_referer to ensure consistent and secure request verification.

STEP:
Replace any wp_verify_nonce usage in AJAX handlers with check_ajax_referer and ensure correct nonce field usage.

FILES:
- /wp-content/plugins/acme-core/modules/module-form.php
- /wp-content/plugins/acme-core/acme-core.php

INPUT:
None

EXPECTED_OUTPUT:
- All AJAX handlers use check_ajax_referer()
- No wp_verify_nonce used inside AJAX handlers
- Correct nonce action and field name used
- No AJAX request works without valid nonce
- Existing functionality remains intact

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.13-AJAX-SECURITY-STANDARDIZATION)
- If mismatch → STOP

DUPLICATION_CHECK:
- If already using check_ajax_referer everywhere → STOP

PRECONDITION_CHECK:
- AJAX handlers exist → YES
- Nonce already implemented → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY replace nonce validation method
- DO NOT change logic
- DO NOT change handler structure

CONSTRAINTS:
- Use check_ajax_referer('action_name', 'nonce_field')
- Remove wp_verify_nonce from AJAX context only
- Do NOT modify non-AJAX nonce usage

SECURITY_HINT:
- Nonce required → YES
- Sanitization already exists → NO CHANGE
- Capability checks already exist → NO CHANGE

FAIL_CONDITIONS:
- Any AJAX handler without nonce
- Incorrect nonce field used
- Public handler broken
- AJAX functionality fails

SUCCESS_CRITERIA:
- All AJAX endpoints use check_ajax_referer
- No inconsistency in nonce validation
- No unauthorized request possible
- System stable

# ============================================