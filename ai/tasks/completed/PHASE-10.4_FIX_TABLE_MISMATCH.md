# ============================================
# TASK: PHASE-10.4_FIX_TABLE_MISMATCH.md
# ============================================

GOAL:
Ensure all lead operations (read, delete, list) use acme_form_entries as the single source of truth and eliminate dependency on acme_leads table.

STEP:
Update ACME_DAL::get_leads() to query acme_form_entries instead of acme_leads.

FILES:
wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

EXPECTED_OUTPUT:
- get_leads() queries acme_form_entries
- No reference to acme_leads in this function
- CRM listing pulls real data
- Delete operation reflects immediately
- No PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.4_FIX_TABLE_MISMATCH)
- If mismatch → STOP

DUPLICATION_CHECK:
- If already using acme_form_entries → STOP

PRECONDITION_CHECK:
- File exists → YES
- get_leads() exists → YES
- acme_leads reference exists → YES

STRICT_SCOPE:
- ONLY modify table name inside get_leads()
- Do NOT refactor logic
- Do NOT change schema
- Do NOT touch other files

CONSTRAINTS:
- Follow WordPress standards
- No new features
- No extra logic

SECURITY_HINT:
- Sanitization required? N/A
- Escaping required? N/A
- Nonce required? N/A

FAIL_CONDITIONS:
- acme_leads still used
- wrong table name
- PHP error

SUCCESS_CRITERIA:
- CRM shows correct data
- delete works instantly
- single table system
- no errors

# ============================================