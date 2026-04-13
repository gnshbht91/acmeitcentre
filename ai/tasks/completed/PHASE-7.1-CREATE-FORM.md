# ============================================
# TASK: PHASE-7.1-CREATE-FORM.md
# ============================================

GOAL:
Create frontend form UI via shortcode using module system

STEP:
Create module file and register shortcode for form UI

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
None

EXPECTED_OUTPUT:
- Shortcode [acme_form] registered
- Form renders with fields: Name, Phone, Email, Course
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.1)
- If mismatch → STOP

DUPLICATION_CHECK:
- If function acme_render_form exists → STOP
- If module-form.php exists → STOP

PRECONDITION_CHECK:
- modules folder exists → YES
- loader.php already loads modules → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only module creation
- No loader modification
- No processing
- No validation
- No nonce

CONSTRAINTS:
- Follow plugin architecture
- Use module system
- Prefix functions with acme_
- No DB logic

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? YES
- Nonce required? NO

FAIL_CONDITIONS:
- Wrong file path
- Logic outside module
- PHP error

SUCCESS_CRITERIA:
- Shortcode works
- Form visible
- No error
- Only module file created

# ============================================