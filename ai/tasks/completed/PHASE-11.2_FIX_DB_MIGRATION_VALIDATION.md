# ============================================
# TASK: PHASE-11.2_FIX_DB_MIGRATION_VALIDATION.md
# ============================================

GOAL:
Fix database migration validation so that wp_acme_form_entries table is included in migration checks.

ROOT_CAUSE:
acme_check_db_version() validates only:
- wp_acme_leads
- wp_acme_logs
- wp_acme_audit

It does NOT validate:
- wp_acme_form_entries

As a result:
Migration may be marked successful even if CRM table is missing.

STEP:
Add wp_acme_form_entries to the table validation list.

FILES:
wp-content/plugins/acme-core/acme-core.php

TARGET_FUNCTION:
acme_check_db_version()

EXPECTED_OUTPUT:
- Migration validation includes all required tables
- Migration success reflects actual DB state
- No false-positive success

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-11.2_FIX_DB_MIGRATION_VALIDATION)
- If mismatch → STOP

DUPLICATION_CHECK:
- If wp_acme_form_entries already present in validation → STOP

PRECONDITION_CHECK:
- acme_check_db_version() exists → YES
- table validation array exists → YES
- wp_acme_form_entries missing → YES

STRICT_SCOPE:
- ONLY modify table validation array
- DO NOT modify logic structure
- DO NOT change migration flow
- DO NOT touch other functions

CONSTRAINTS:
- Use $wpdb->prefix for table name
- Keep existing tables intact
- No refactoring
- No additional validation logic

SECURITY_HINT:
- No security impact, but affects system integrity

FAIL_CONDITIONS:
- wrong table name added
- existing tables modified incorrectly
- syntax error
- migration flow broken

SUCCESS_CRITERIA:
- wp_acme_form_entries included in validation
- no syntax error
- migration behaves correctly

# ============================================