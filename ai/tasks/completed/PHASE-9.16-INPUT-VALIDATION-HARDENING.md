# ============================================
# TASK: PHASE-9.16-INPUT-VALIDATION-HARDENING.md
# ============================================

GOAL:
Harden all input handling across CRM system to ensure strict validation, sanitization, and type safety for all incoming data.

STEP:
Apply strict validation and sanitization for all inputs (POST, GET, AJAX) and enforce type safety before processing or database interaction.

FILES:
- /wp-content/plugins/acme-core/modules/module-form.php
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
None

EXPECTED_OUTPUT:
- All inputs validated before use
- All inputs sanitized using appropriate WordPress functions
- Type safety enforced (int, string, email, etc.)
- No direct usage of raw $_POST / $_GET
- System behavior unchanged for valid input

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.16-INPUT-VALIDATION-HARDENING)
- If mismatch → STOP

DUPLICATION_CHECK:
- If validation already enforced → STOP

PRECONDITION_CHECK:
- Input handling exists → YES
- AJAX handlers exist → YES
- DAL interaction exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY add validation and sanitization
- DO NOT modify logic flow
- DO NOT change UI
- DO NOT refactor structure

CONSTRAINTS:
- Use sanitize_text_field() for strings
- Use intval() for integers
- Use sanitize_email() for emails
- Use esc_url_raw() for URLs
- Validate before sanitize when required
- Reject invalid input early

SECURITY_HINT:
- Nonce already implemented → NO CHANGE
- Capability checks exist → NO CHANGE

FAIL_CONDITIONS:
- Any raw input used directly
- Missing sanitization
- Type mismatch allowed
- Valid input flow breaks

SUCCESS_CRITERIA:
- All inputs sanitized and validated
- No raw input usage
- No security risk
- System stable

# ============================================