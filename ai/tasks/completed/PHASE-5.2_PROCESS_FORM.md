# ============================================
# TASK: PHASE-5.2_PROCESS_FORM.md
# ============================================

GOAL:
Frontend form submission ko safely process karna aur data prepare karna

STEP:
POST request detect karke sanitized data extract karna

FILES:
wp-content/plugins/acme-core/includes/frontend/lead-form.php

EXPECTED_OUTPUT:
- Form submit detect ho
- Data sanitized ho
- No PHP error

TASK_VALIDATION:
- Must match PHASE 5.2
- If mismatch → STOP

STRICT_SCOPE:
- Only form processing logic add karna
- No DB insert (next phase)
- No redirect

CONSTRAINTS:
- Use nonce verification
- Use sanitize_text_field()
- Use sanitize_email()
- No raw $_POST usage

# ============================================