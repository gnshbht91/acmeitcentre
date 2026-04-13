# ============================================
# TASK: PHASE-7.4.1-AJAX-HANDLER.md
# ============================================

GOAL:
Register AJAX hooks and create handler function for form submission

STEP:
Add AJAX action hooks and basic handler function

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
None

EXPECTED_OUTPUT:
- AJAX hooks registered (logged-in + guest)
- Handler function exists
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.4)
- If mismatch → STOP

DUPLICATION_CHECK:
- AJAX hooks must not already exist
- Handler function must not exist
- If exists → STOP

PRECONDITION_CHECK:
- module-form.php exists → YES
- Form, nonce, honeypot present → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only add hooks + empty handler
- No validation
- No processing
- No response logic (minimal only)

CONSTRAINTS:
- Use WordPress AJAX hooks
- Prefix functions with acme_
- No other file modification

SECURITY_HINT:
- Nonce validation → NOT in this step
- Honeypot check → NOT in this step

FAIL_CONDITIONS:
- Duplicate hooks
- Wrong hook name
- PHP error

SUCCESS_CRITERIA:
- Hooks registered correctly
- Handler callable
- No errors

# ============================================