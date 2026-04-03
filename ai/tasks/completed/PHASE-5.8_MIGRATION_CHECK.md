# ============================================
# TASK: PHASE-5.8_MIGRATION_CHECK.md
# ============================================

GOAL:
Ensure database migration check runs correctly on init

STEP:
Verify and enforce migration check hook execution

FILES:
wp-content/plugins/acme-core/includes/db/database.php
wp-content/plugins/acme-core/acme-core.php

EXPECTED_OUTPUT:
- Migration function hooked properly
- Runs without error
- DB version updated if needed

TASK_VALIDATION:
- Must match PHASE 5.8
- If mismatch → STOP

DUPLICATION_CHECK:
- If hook already exists → verify only

STRICT_SCOPE:
- Only migration hook validation/fix
- No schema changes

CONSTRAINTS:
- Use add_action('init', ...)
- Do not duplicate hooks
- Keep logic minimal

# ============================================

RESULT: SUCCESS
COMPLETED: 2026-04-01
