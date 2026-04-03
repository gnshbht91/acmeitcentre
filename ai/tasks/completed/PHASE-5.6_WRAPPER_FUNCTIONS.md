# ============================================
# TASK: PHASE-5.6_WRAPPER_FUNCTIONS.md
# ============================================

GOAL:
Create global wrapper functions for DAL access

STEP:
Create helper functions that call DAL methods

FILES:
wp-content/plugins/acme-core/includes/helpers/dal-helpers.php

EXPECTED_OUTPUT:
- Wrapper functions created
- Functions return DAL data
- No PHP error

TASK_VALIDATION:
- Must match PHASE 5.6
- If mismatch → STOP

DUPLICATION_CHECK:
- If helper file exists → STOP
- If functions exist → STOP

STRICT_SCOPE:
- Only wrapper functions
- No logic change
- No UI

CONSTRAINTS:
- Use ACME_DAL class
- Keep functions simple
- Return data only

# ============================================