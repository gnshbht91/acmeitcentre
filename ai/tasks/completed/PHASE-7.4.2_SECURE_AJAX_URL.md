# ============================================
# TASK: PHASE-7.4.2_SECURE_AJAX_URL.md
# ============================================

GOAL:
Secure AJAX endpoint URL by properly escaping admin-ajax.php using esc_url().

STEP:
Replace raw admin_url() usage with esc_url(admin_url()) in AJAX JS block.

FILES:
/wp-content/plugins/acme-core/modules/module-form.php

INPUT:
None

EXPECTED_OUTPUT:
- AJAX URL properly escaped
- No functional change in AJAX behavior
- No PHP or JS errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.4.x context)
- If mismatch → STOP

DUPLICATION_CHECK:
- If esc_url already applied → STOP

PRECONDITION_CHECK:
- AJAX JS block exists → YES
- admin-ajax.php URL present → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY update AJAX URL escaping
- NO logic change
- NO selector change
- NO action change

CONSTRAINTS:
- Must use esc_url()
- Must not alter AJAX request structure
- Must not modify unrelated code

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? YES (core of task)
- Nonce required? NO

FAIL_CONDITIONS:
- AJAX stops working
- PHP syntax error
- URL incorrectly modified

SUCCESS_CRITERIA:
- esc_url() applied correctly
- AJAX still working
- No console errors
- Task pipeline completed

# ============================================