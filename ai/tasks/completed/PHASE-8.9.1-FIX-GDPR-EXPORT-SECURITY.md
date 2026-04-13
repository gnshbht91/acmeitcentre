# ============================================
# TASK: PHASE-8.9.1-FIX-GDPR-EXPORT-SECURITY.md
# ============================================

GOAL:
Secure GDPR export endpoint to prevent unauthorized data access

STEP:
Add nonce validation and restrict public access

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
Existing AJAX export endpoint

EXPECTED_OUTPUT:
- Endpoint secured
- Unauthorized access blocked
- Only valid requests allowed

TASK_VALIDATION:
- Must match FIX phase (8.9.1)
- If mismatch → STOP

DUPLICATION_CHECK:
- Nonce must not already exist

PRECONDITION_CHECK:
- Export function exists → YES
- AJAX endpoint exists → YES

STRICT_SCOPE:
- Only security fix
- No logic change

CONSTRAINTS:
- Must use wp_verify_nonce
- Must remove public access

SECURITY_HINT:
- Prevent data leakage

FAIL_CONDITIONS:
- Endpoint still public
- Nonce not validated
- Export breaks

SUCCESS_CRITERIA:
- Secure export
- No unauthorized access

# ============================================