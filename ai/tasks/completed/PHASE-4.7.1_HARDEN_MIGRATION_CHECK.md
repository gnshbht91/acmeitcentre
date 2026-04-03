# ============================================
# TASK: PHASE-4.7.1_HARDEN_MIGRATION_CHECK.md
# ============================================

GOAL:
Make migration check safe, efficient, and non-redundant

STEP:
Improve migration logic with proper hook, early return, lock, and success validation

FILES:
wp-content/plugins/acme-core/acme-core.php

DEPENDENCIES:
- Migration check (4.7)
- DB version (4.6)

EXPECTED_OUTPUT:
- Migration runs only when needed
- No repeated execution
- No race condition
- Version updates only on success
- No performance impact

TASK_VALIDATION:
- Must match PHASE 4.7.1
- If mismatch → STOP

STRICT_SCOPE:
- Only improve migration check
- Do NOT change table logic

CONSTRAINTS:
- Use admin_init
- Use option-based lock
- Use version_compare()
- No raw SQL

# ============================================