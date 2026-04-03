# ============================================
# TASK: PHASE-4.7_MIGRATION_CHECK.md
# ============================================

GOAL:
Check current DB version and run migration if outdated

STEP:
Compare stored DB version with current version and trigger update

FILES:
wp-content/plugins/acme-core/acme-core.php

DEPENDENCIES:
- ACME_DB_VERSION defined
- DB version stored (4.6)

EXPECTED_OUTPUT:
- Version comparison working
- Migration triggered if needed
- No duplicate execution
- No PHP error

TASK_VALIDATION:
- Must match PHASE 4.7
- If mismatch → STOP

DUPLICATION_CHECK:
- If migration check already exists → STOP

STRICT_SCOPE:
- Only version check logic
- No migration logic implementation yet

CONSTRAINTS:
- Use get_option()
- Use version_compare()
- No raw SQL

# ============================================