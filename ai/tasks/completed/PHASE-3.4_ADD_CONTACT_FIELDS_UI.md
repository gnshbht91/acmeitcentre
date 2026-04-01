# ============================================
# TASK: PHASE-3.4_ADD_CONTACT_FIELDS_UI.md
# ============================================

GOAL:
Settings page me basic contact fields UI render ho (form inputs visible ho)

STEP:
Existing settings page form ke andar contact input fields add karna

FILES:
wp-content/plugins/acme-core/includes/admin/settings-page.php

INPUT:
None

FIELDS:
- Phone Number
- Email Address
- Address

UI_REQUIREMENTS:
- Use <table class="form-table">
- Each field inside <tr>
- Use <th><label></label></th>
- Use <td><input></td>
- No value binding yet

EXPECTED_OUTPUT:
- Settings page par 3 input fields visible ho
- Labels properly aligned ho (WordPress admin style)
- Koi PHP error na aaye

DUPLICATION_CHECK:
- If fields already exist → STOP

STRICT_SCOPE:
- Modify ONLY form section inside settings-page.php
- Do NOT modify function structure
- Do NOT modify other files

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 3.4)
- If mismatch → STOP

CONSTRAINTS:
- Follow WordPress admin UI standards
- Do NOT add save functionality
- Do NOT add validation
- Do NOT add nonce
- Do NOT add option handling
- Do NOT expand scope

# ============================================