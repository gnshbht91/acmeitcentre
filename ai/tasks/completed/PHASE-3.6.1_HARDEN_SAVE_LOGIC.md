# ============================================
# TASK: PHASE-3.6.1_HARDEN_SAVE_LOGIC.md
# ============================================

GOAL:
Settings save logic ko secure aur error-safe banana

STEP:
POST validation, capability check, aur safe input handling add karna

FILES:
wp-content/plugins/acme-core/includes/admin/settings-page.php

INPUT:
POST data (optional fields allowed)

EXPECTED_OUTPUT:
- No PHP notices even if fields missing
- Only authorized users can save
- Save logic only runs on POST request

SECURITY_REQUIREMENTS:
- Add current_user_can('manage_options')
- Check $_SERVER['REQUEST_METHOD'] === 'POST'
- Use isset() for all POST fields

DUPLICATION_CHECK:
- If checks already exist → STOP

STRICT_SCOPE:
- Modify ONLY save logic block
- Do NOT modify UI
- Do NOT modify other files

TASK_VALIDATION:
- Must be post 3.6
- If mismatch → STOP

CONSTRAINTS:
- Keep existing update_option structure
- Do NOT change field names
- Do NOT add new features
- Do NOT expand scope

# ============================================