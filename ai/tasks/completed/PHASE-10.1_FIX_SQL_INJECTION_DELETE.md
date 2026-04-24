# ============================================
# TASK: PHASE-10.1_FIX_SQL_INJECTION_DELETE.md
# ============================================

GOAL:
Replace unsafe DELETE query in acme_delete_leads_bulk() with secure $wpdb->prepare() based query using dynamic placeholders.

STEP:
Replace raw SQL IN() query with parameterized $wpdb->prepare() query.

FILES:
wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
$clean_ids (array of integers)

EXPECTED_OUTPUT:
- DELETE query uses $wpdb->prepare()
- Dynamic %d placeholders generated based on ID count
- No direct string concatenation in SQL query
- Query executed using $wpdb->query()
- No PHP errors/warnings

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.1)
- If mismatch → STOP

DUPLICATION_CHECK:
- If $wpdb->prepare() already used in this function → STOP

PRECONDITION_CHECK:
- Required files exist → YES
- Required folders exist → YES
- Required functions exist → YES (acme_delete_leads_bulk)
- If ANY missing → STOP

STRICT_SCOPE:
- Only replace DELETE query
- Do NOT modify other logic
- Do NOT refactor function
- Do NOT touch other queries

CONSTRAINTS:
- Follow WordPress coding standards
- Do NOT modify unrelated files
- Do NOT introduce new features
- Do NOT assume missing data

SECURITY_HINT:
- Sanitization required? NO (already intval applied)
- Escaping required? NO
- Nonce required? N/A

FAIL_CONDITIONS:
- Raw SQL still present
- Incorrect placeholder count
- Using %s instead of %d
- Passing array incorrectly to prepare()
- PHP error / warning

SUCCESS_CRITERIA:
- Output matches EXPECTED_OUTPUT
- No PHP errors/warnings/notices
- Task completion pipeline executed fully
- System state updated correctly

# ============================================