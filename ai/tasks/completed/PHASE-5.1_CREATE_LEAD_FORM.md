# ============================================
# TASK: PHASE-5.1_CREATE_LEAD_FORM.md
# ============================================

GOAL:
Frontend par lead capture form display karna

STEP:
Shortcode ke through ek basic HTML form render karna

FILES:
wp-content/plugins/acme-core/includes/frontend/lead-form.php

DEPENDENCY:
acme_get_settings() optional (not required)

EXPECTED_OUTPUT:
- Shortcode [acme_lead_form] register ho
- Frontend par form visible ho
- Fields:
  - Name
  - Phone
  - Email
  - Course
- Submit button present ho
- No PHP error

TASK_VALIDATION:
- Must match PHASE 5.1
- If mismatch → STOP

STRICT_SCOPE:
- Only form UI create karna
- No form processing
- No DB insert

CONSTRAINTS:
- Use esc_html for output labels
- No raw PHP output
- No JS

# ============================================