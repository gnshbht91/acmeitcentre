# ============================================
# TASK: PHASE-10.6_FIX_DOUBLE_ACTIVATION_HOOK.md
# ============================================

GOAL:
Ensure only one activation hook is registered and all table creation runs through acme_plugin_activate().

STEP:
Remove register_activation_hook for acme_create_form_table.

FILES:
wp-content/plugins/acme-core/acme-core.php

EXPECTED_OUTPUT:
- Only one register_activation_hook exists
- acme_plugin_activate() remains
- acme_create_form_table is no longer directly hooked
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.6_FIX_DOUBLE_ACTIVATION_HOOK)
- If mismatch → STOP

DUPLICATION_CHECK:
- If only one activation hook already exists → STOP

PRECONDITION_CHECK:
- acme-core.php exists → YES
- duplicate activation hooks present → YES

STRICT_SCOPE:
- ONLY remove one register_activation_hook line
- Do NOT modify functions
- Do NOT refactor

CONSTRAINTS:
- No logic change
- No new code
- No function deletion

SECURITY_HINT:
- N/A

FAIL_CONDITIONS:
- both hooks removed
- wrong hook removed
- PHP error

SUCCESS_CRITERIA:
- single activation hook remains
- plugin activates normally
- no duplicate execution

# ============================================