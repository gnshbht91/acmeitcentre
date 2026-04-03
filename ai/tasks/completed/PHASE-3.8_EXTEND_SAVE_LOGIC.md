# ============================================
# TASK: PHASE-3.8_EXTEND_SAVE_LOGIC.md
# ============================================

GOAL:
Business fields ko existing save system me safely include karna

STEP:
Existing $settings array me new business fields add karna (without breaking current logic)

FILES:
wp-content/plugins/acme-core/includes/admin/settings-page.php

INPUT:
POST data:
- acme_business_name
- acme_business_hours
- acme_map_link

EXPECTED_OUTPUT:
- Business fields save ho jaye database me
- Existing fields (phone, email, etc.) unaffected rahe
- No PHP error aaye

SECURITY_REQUIREMENTS:
- Use !empty() check
- Use sanitize_text_field for text
- Use esc_url_raw for map link

DUPLICATION_CHECK:
- Agar fields already save logic me exist karte hai → STOP

STRICT_SCOPE:
- Modify ONLY $settings array
- Do NOT modify nonce logic
- Do NOT modify POST condition
- Do NOT modify other files

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 3.8)
- If mismatch → STOP

CONSTRAINTS:
- Extend only (overwrite nahi)
- Maintain array structure
- No scope expansion

# ============================================