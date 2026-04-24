# ============================================
# TASK: PHASE-10.5A_FIX_BROKEN_TABLE_CREATION.md
# ============================================

GOAL:
Restore creation of acme_form_entries table inside acme_create_tables() without reintroducing acme_leads table.

STEP:
Add dbDelta(acme_get_form_entries_table_sql()) inside acme_create_tables().

FILES:
wp-content/plugins/acme-core/acme-core.php

EXPECTED_OUTPUT:
- acme_form_entries table creation restored
- acme_leads table NOT created
- logs and audit tables remain unchanged
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.5A_FIX_BROKEN_TABLE_CREATION)
- If mismatch → STOP

DUPLICATION_CHECK:
- If form_entries creation already exists → STOP

PRECONDITION_CHECK:
- acme_create_tables() exists → YES
- form_entries creation missing → YES

STRICT_SCOPE:
- ONLY add form_entries creation line
- Do NOT modify other dbDelta calls
- Do NOT refactor function

CONSTRAINTS:
- Follow WordPress coding standards
- No extra logic
- No feature change

SECURITY_HINT:
- Sanitization required? N/A
- Escaping required? N/A
- Nonce required? N/A

FAIL_CONDITIONS:
- acme_leads reintroduced
- other tables modified
- PHP error

SUCCESS_CRITERIA:
- form_entries table created
- plugin activates correctly
- no unintended changes

# ============================================