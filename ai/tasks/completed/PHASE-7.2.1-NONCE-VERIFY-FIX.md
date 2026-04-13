# ============================================
# TASK: PHASE-7.2.1-NONCE-VERIFY-FIX.md
# ============================================

GOAL:
Verify nonce implementation and fix if incorrect (name/action mismatch)

STEP:
Check nonce field and correct parameters if mismatch found

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
None

EXPECTED_OUTPUT:
- Nonce field exists
- Action = acme_form_action
- Name = acme_form_nonce
- No duplicate nonce fields
- No PHP errors

TASK_VALIDATION:
- Must follow PHASE 7.2 output
- If nonce missing → STOP

DUPLICATION_CHECK:
- Only ONE wp_nonce_field must exist
- If more than one → FAIL

PRECONDITION_CHECK:
- module-form.php exists → YES
- Nonce already added → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only verify/fix nonce line
- No new logic
- No structural changes

CONSTRAINTS:
- Use WordPress nonce API only
- Do NOT modify other code
- Do NOT move code

SECURITY_HINT:
- Nonce required? YES
- Validate correct naming

FAIL_CONDITIONS:
- Wrong nonce name
- Wrong action
- Multiple nonce fields
- PHP error

SUCCESS_CRITERIA:
- Nonce exactly matches:
  wp_nonce_field('acme_form_action', 'acme_form_nonce');
- Only one nonce present
- No error

# ============================================