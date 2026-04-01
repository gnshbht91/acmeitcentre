# ============================================
# TASK: PHASE-3.5_ADD_WHATSAPP_FIELD.md
# ============================================

GOAL:
Settings page me WhatsApp number field add ho (UI only)

STEP:
Existing contact fields ke niche WhatsApp input field add karna

FILES:
wp-content/plugins/acme-core/includes/admin/settings-page.php

INPUT:
None

FIELDS:
- WhatsApp Number

UI_REQUIREMENTS:
- Use <table class="form-table"> (existing table continue kare)
- Add new <tr> for WhatsApp
- Label + input structure same as existing fields

EXPECTED_OUTPUT:
- WhatsApp field visible ho
- Existing fields untouched rahe
- Proper WP alignment maintain ho
- Koi PHP error na aaye

DUPLICATION_CHECK:
- If WhatsApp field already exists → STOP

STRICT_SCOPE:
- Modify ONLY existing table inside form
- Do NOT create new table
- Do NOT modify other files

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 3.5)
- If mismatch → STOP

CONSTRAINTS:
- Follow WordPress admin UI standards
- Do NOT add save functionality
- Do NOT add validation
- Do NOT add nonce
- Do NOT add PHP logic
- Do NOT expand scope

# ============================================