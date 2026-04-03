# ============================================
# TASK: PHASE-4.5_ACTIVATION_HOOK.md
# ============================================

GOAL:
Create a clean and structured activation hook for database setup

STEP:
Refactor activation hook into a dedicated function

FILES:
wp-content/plugins/acme-core/acme-core.php

DEPENDENCIES:
- DB table functions already exist

EXPECTED_OUTPUT:
- Activation hook defined once
- Clean function structure
- No duplicate hooks
- No PHP error

TASK_VALIDATION:
- Must match PHASE 4.5
- If mismatch → STOP

DUPLICATION_CHECK:
- If activation hook already exists → refactor, do NOT duplicate

STRICT_SCOPE:
- Only activation logic refactor
- Do NOT modify DB SQL
- Do NOT add new features

CONSTRAINTS:
- Use register_activation_hook()
- Use separate function
- Keep logic minimal

# ============================================