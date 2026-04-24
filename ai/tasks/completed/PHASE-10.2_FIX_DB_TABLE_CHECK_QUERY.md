# ============================================
# TASK: PHASE-10.2_FIX_DB_TABLE_CHECK_QUERY.md
# ============================================

GOAL:
Replace unsafe SHOW TABLES LIKE query with secure $wpdb->prepare() usage.

STEP:
Replace raw SHOW TABLES LIKE query with parameterized query using $wpdb->prepare().

FILES:
wp-content/plugins/acme-core/acme-core.php

INPUT:
$table (string table name)

EXPECTED_OUTPUT:
- SHOW TABLES LIKE query uses $wpdb->prepare()
- %s placeholder used
- No direct string interpolation
- Query executed using $wpdb->get_var()
- No PHP errors/warnings

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.2)
- If mismatch → STOP

DUPLICATION_CHECK:
- If prepare already used → STOP

PRECONDITION_CHECK:
- File exists → YES
- Function acme_check_db_version exists → YES
- Query exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only replace SHOW TABLES query
- Do NOT modify other logic

CONSTRAINTS:
- Follow WordPress coding standards
- Do NOT modify unrelated code
- Do NOT refactor

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? NO
- Nonce required? N/A

FAIL_CONDITIONS:
- Raw query still exists
- Wrong placeholder used (%d instead of %s)
- PHP error

SUCCESS_CRITERIA:
- Query uses $wpdb->prepare()
- No raw interpolation
- No errors
- Task pipeline executed correctly

# ============================================