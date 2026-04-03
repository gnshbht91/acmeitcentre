# ============================================
# TASK: PHASE-4.6_STORE_DB_VERSION.md
# ============================================

GOAL:
Store current database version in WordPress options during plugin activation

STEP:
Add DB version constant and save it using update_option()

FILES:
wp-content/plugins/acme-core/acme-core.php

EXPECTED_OUTPUT:
- DB version constant defined
- Version stored in wp_options table
- No PHP error

TASK_VALIDATION:
- Must match PHASE 4.6
- If mismatch → STOP

DUPLICATION_CHECK:
- If version constant already exists → STOP
- If update_option already exists → STOP

STRICT_SCOPE:
- Only DB version storage
- No migration logic

CONSTRAINTS:
- Use define()
- Use update_option()
- No raw SQL

# ============================================