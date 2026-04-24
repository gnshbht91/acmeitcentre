# ============================================
# TASK: PHASE-11.4_VALIDATE_FETCH_FLOW.md
# ============================================

GOAL:
Verify that CRM page correctly fetches and displays data from wp_acme_form_entries table.

ROOT_CAUSE_RISK:
Even if insert works, CRM may still show empty due to:
- wrong table name in fetch query
- incorrect filters
- wrong parameters passed to DAL

SCOPE:
- Fetch logic
- DAL query
- CRM display integration

FILES:
- dal/form-dal.php
- acme-core.php

TARGET_FUNCTIONS:
- acme_get_leads()
- acme_get_leads_count()
- acme_crm_page()

EXPECTED_OUTPUT:
- Confirm correct table used in fetch
- Confirm correct data returned
- Identify mismatch (if any)
- Verify CRM display pipeline

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-11.4_VALIDATE_FETCH_FLOW)
- If mismatch → STOP

DUPLICATION_CHECK:
- If fetch flow already audited → STOP

PRECONDITION_CHECK:
- wp_acme_form_entries table exists → YES
- Insert flow working (from Phase-11.3 logs) → YES
- CRM page accessible → YES

STRICT_SCOPE:
- ONLY audit fetch flow
- DO NOT modify queries
- DO NOT change logic

CONSTRAINTS:
- No assumptions
- Must trace real execution path
- Must match DB table with fetch table

SECURITY_HINT:
- Ensure no unsafe query patterns introduced

FAIL_CONDITIONS:
- guessing issue
- partial audit
- missing function trace

SUCCESS_CRITERIA:
- Exact fetch source identified
- CRM display pipeline validated
- Any mismatch clearly identified

# ============================================