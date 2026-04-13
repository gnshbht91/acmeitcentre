# ============================================
# TASK: PHASE-7.2-ADD-NONCE.md
# ============================================

GOAL:
Add WordPress nonce field to form for security validation

STEP:
Add nonce field inside existing form UI

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
None

EXPECTED_OUTPUT:
- Nonce field present in form
- Nonce uses wp_nonce_field()
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.2)
- If mismatch → STOP

DUPLICATION_CHECK:
- Nonce field must not already exist
- If exists → STOP

PRECONDITION_CHECK:
- module-form.php exists → YES
- Form already rendering → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only add nonce field
- No validation logic
- No processing logic
- No extra fields

CONSTRAINTS:
- Use WordPress nonce API
- Do NOT modify other files
- Do NOT change structure

SECURITY_HINT:
- Sanitization required? N/A
- Escaping required? N/A
- Nonce required? YES

FAIL_CONDITIONS:
- Nonce missing
- Duplicate nonce
- Wrong placement
- PHP error

SUCCESS_CRITERIA:
- Nonce field visible in HTML
- No errors
- Only defined file modified

# ============================================