# ============================================
# TASK: PHASE-7.4.3_FIX_PIPELINE.md
# ============================================

GOAL:
Fix critical issues in AJAX → DAL → DB pipeline by ensuring:
- All variables are defined
- All inputs are sanitized
- AJAX action hook is correctly registered
- Nonce verification is consistent

STEP:
Update AJAX handler to define missing variables, sanitize all inputs, and verify action + nonce consistency.

FILES:
/wp-content/plugins/acme-core/modules/module-form.php
/wp-content/plugins/acme-core/acme-core.php

INPUT:
POST data (name, phone, email, course, url, utm, etc.)

EXPECTED_OUTPUT:
- No undefined variables
- All inputs sanitized
- Correct AJAX action hook
- Nonce verification working
- DB insert stable

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.4.3 FIX)
- If mismatch → STOP

DUPLICATION_CHECK:
- If fixes already applied → STOP

PRECONDITION_CHECK:
- AJAX working → YES
- DAL insert working → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY fix handler issues
- NO UI change
- NO DB schema change
- NO DAL logic change

CONSTRAINTS:
- Must sanitize ALL inputs
- Must not trust $_POST directly
- Must not modify unrelated logic

SECURITY_HINT:
- Sanitization required? YES (critical)
- Escaping required? YES (URL)
- Nonce required? YES (must verify)

FAIL_CONDITIONS:
- Undefined variable exists
- Unsanitized input used
- AJAX handler mismatch
- Nonce failure

SUCCESS_CRITERIA:
- Clean sanitized input
- No PHP notice/warning
- AJAX handler working
- DB insert stable
- Task pipeline completed

# ============================================