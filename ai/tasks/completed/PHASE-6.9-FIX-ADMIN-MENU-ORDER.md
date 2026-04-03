# ============================================
# TASK: PHASE-6.9-FIX-ADMIN-MENU-ORDER.md
# ============================================

GOAL:
Fix admin menu order so that Settings appears at the bottom under ACME menu

STEP:
Reorder submenu registration sequence

FILES:
- wp-content/plugins/acme-core/includes/admin/menu.php

EXPECTED_OUTPUT:
- Settings appears last in submenu
- No menu items missing
- No duplicate menu

STRICT_SCOPE:
- Only menu order change
- No logic change

FAIL_CONDITIONS:
- menu broken
- duplicate items
- wrong order

SUCCESS_CRITERIA:
- correct order visible in admin