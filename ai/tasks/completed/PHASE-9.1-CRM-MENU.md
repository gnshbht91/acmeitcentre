# ============================================
# TASK: PHASE-9.1-CRM-MENU.md
# ============================================

GOAL:
Create CRM admin menu in WordPress dashboard

STEP:
Add menu page for leads management

FILES:
- wp-content/plugins/acme-core/acme-core.php

INPUT:
WordPress admin menu system

EXPECTED_OUTPUT:
- New menu "ACME CRM"
- Visible in admin sidebar
- Click opens blank page

TASK_VALIDATION:
- Must match PHASE 9.1
- If mismatch → STOP

DUPLICATION_CHECK:
- Menu must not already exist

PRECONDITION_CHECK:
- Plugin active → YES

STRICT_SCOPE:
- Only menu creation
- No table, no logic

CONSTRAINTS:
- Use add_menu_page
- Capability must be secure

SECURITY_HINT:
- Use manage_options capability

FAIL_CONDITIONS:
- Menu not visible
- Permission issue

SUCCESS_CRITERIA:
- Menu visible
- Page loads

# ============================================