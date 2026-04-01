# ============================================
# TASK: PHASE-3.6.2_STRICT_INPUT_CHECK.md
# ============================================

GOAL:
Empty input values ko avoid karna aur sirf non-empty data sanitize karke save karna

STEP:
Save logic me empty check add karna (empty string save na ho unnecessarily)

FILES:
wp-content/plugins/acme-core/includes/admin/settings-page.php

INPUT:
POST data (optional fields)

EXPECTED_OUTPUT:
- Empty fields safe handle ho
- No PHP notice
- Only meaningful values sanitize ho
- System behavior unchanged (no break)

SECURITY_REQUIREMENTS:
- Keep existing nonce + capability + POST checks
- Add !empty() condition before sanitization

DUPLICATION_CHECK:
- If !empty checks already exist → STOP

STRICT_SCOPE:
- Modify ONLY settings array inside save logic
- Do NOT modify structure
- Do NOT modify other files

TASK_VALIDATION:
- Must be after 3.6.1
- If mismatch → STOP

CONSTRAINTS:
- Keep update_option same
- Do NOT add new features
- Do NOT expand scope

# ============================================