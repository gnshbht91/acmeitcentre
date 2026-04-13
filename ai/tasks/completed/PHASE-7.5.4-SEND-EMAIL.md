# ============================================
# TASK: PHASE-7.5.4-SEND-EMAIL.md
# ============================================

GOAL:
Send email notification to admin after successful form submission

STEP:
Add wp_mail() logic after DB insert success

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- $name
- $phone
- $email
- $course
- $insert_id

EXPECTED_OUTPUT:
- Email sent to admin
- Email contains form details
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.5.4)
- If mismatch → STOP

DUPLICATION_CHECK:
- Email logic must not already exist
- If exists → STOP

PRECONDITION_CHECK:
- Insert logic exists → YES
- Response structure exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only email logic
- No DB change
- No response change (except optional flag)

CONSTRAINTS:
- Use wp_mail()
- Use get_option('admin_email')
- Plain text email only
- No sensitive data

SECURITY_HINT:
- Only sanitized values

FAIL_CONDITIONS:
- Email not sent
- PHP error
- Wrong email address

SUCCESS_CRITERIA:
- Email received
- Content correct
- System stable

# ============================================