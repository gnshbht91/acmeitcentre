# ============================================
# TASK: PHASE-10.5_REMOVE_UNUSED_LEADS_TABLE_CREATION.md
# ============================================

GOAL:
Remove creation of unused acme_leads table to prevent future ghost data and ensure single table system (acme_form_entries).

STEP:
Remove acme_leads table creation logic from acme_create_tables() function.

FILES:
wp-content/plugins/acme-core/acme-core.php
wp-content/plugins/acme-core/includes/db/leads-table.php

EXPECTED_OUTPUT:
- acme_leads table is no longer created on plugin activation
- acme_form_entries remains unchanged
- No reference to leads-table.php in activation flow
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.5_REMOVE_UNUSED_LEADS_TABLE_CREATION)
- If mismatch → STOP

DUPLICATION_CHECK:
- If acme_leads creation already removed → STOP

PRECONDITION_CHECK:
- acme_create_tables() exists → YES
- leads-table.php exists → YES
- acme_leads creation present → YES

STRICT_SCOPE:
- ONLY remove acme_leads creation
- Do NOT delete file yet
- Do NOT modify other tables
- Do NOT refactor function

CONSTRAINTS:
- No schema changes to acme_form_entries
- No new logic
- No feature change

SECURITY_HINT:
- Sanitization required? N/A
- Escaping required? N/A
- Nonce required? N/A

FAIL_CONDITIONS:
- acme_form_entries affected
- PHP error
- other tables removed accidentally

SUCCESS_CRITERIA:
- acme_leads not created anymore
- plugin activates without error
- existing functionality unaffected

# ============================================