# ============================================
# TASK: PHASE-9.2-CRM-TABLE.md
# ============================================

GOAL:
Display leads data in admin table

STEP:
Fetch data from DB and render HTML table

FILES:
- wp-content/plugins/acme-core/modules/module-crm.php
- wp-content/plugins/acme-core/dal/form-dal.php
- wp-content/plugins/acme-core/acme-core.php

INPUT:
acme_form_entries table

EXPECTED_OUTPUT:
- Leads visible in table
- Columns displayed correctly

TASK_VALIDATION:
- Must match PHASE 9.2
- If mismatch → STOP

DUPLICATION_CHECK:
- Table logic must not already exist

PRECONDITION_CHECK:
- DB table exists → YES
- Data present → YES

STRICT_SCOPE:
- Only table display
- No pagination, no filters

CONSTRAINTS:
- Use LIMIT query
- Escape output

SECURITY_HINT:
- No direct echo without escaping

FAIL_CONDITIONS:
- Table not rendering
- PHP error
- Raw data output

SUCCESS_CRITERIA:
- Table visible
- Data correct

# ============================================