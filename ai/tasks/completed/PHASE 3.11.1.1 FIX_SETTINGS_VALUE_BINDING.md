# ============================================
# TASK: PHASE-3.X_FIX_SETTINGS_VALUE_BINDING.md
# ============================================

GOAL:
Saved settings ko admin input fields me display karna

STEP:
All input fields me value attribute bind karna using saved settings

FILES:
wp-content/plugins/acme-core/includes/admin/settings-page.php

INPUT:
acme_get_settings() array

EXPECTED_OUTPUT:
- Saved data reload ke baad fields me visible ho
- No PHP error
- Proper escaping applied

SECURITY_REQUIREMENTS:
- Use esc_attr() for input values

DUPLICATION_CHECK:
- Agar value already bind hai → STOP

STRICT_SCOPE:
- Modify ONLY input fields
- Do NOT modify save logic
- Do NOT modify structure

TASK_VALIDATION:
- Must fix UI display issue

CONSTRAINTS:
- No logic change
- Only value binding

# ============================================