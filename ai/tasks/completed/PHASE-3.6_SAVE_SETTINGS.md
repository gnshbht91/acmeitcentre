# ============================================
# TASK: PHASE-3.6_SAVE_SETTINGS.md
# ============================================

GOAL:
Settings form submit hone par contact data database me save ho jaye

STEP:
Form submit detect karke input values sanitize karke update_option() se save karna

FILES:
wp-content/plugins/acme-core/includes/admin/settings-page.php

INPUT:
POST data:
- acme_phone
- acme_email
- acme_address
- acme_whatsapp

EXPECTED_OUTPUT:
- Form submit hone par data save ho
- Reload par koi error na aaye
- Data successfully store ho (no UI display required yet)

SECURITY_REQUIREMENTS:
- Use nonce field
- Verify nonce before saving
- Sanitize:
  - phone → sanitize_text_field
  - email → sanitize_email
  - address → sanitize_text_field
  - whatsapp → sanitize_text_field

DUPLICATION_CHECK:
- If save logic already exists → STOP

STRICT_SCOPE:
- Modify ONLY settings-page.php
- Do NOT modify other files

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 3.6)
- If mismatch → STOP

CONSTRAINTS:
- Use update_option('acme_settings', array)
- Do NOT create custom tables
- Do NOT add validation UI
- Do NOT display saved data
- Do NOT expand scope

# ============================================