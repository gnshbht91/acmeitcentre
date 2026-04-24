# ============================================
# TASK: PHASE-11.5_VALIDATE_DELETE_FLOW.md
# ============================================

GOAL:
Identify why delete functionality (single + bulk) is not working in CRM.

ROOT_CAUSE_RISK:
Delete may fail due to:
- JS click handler not firing
- AJAX request not sent
- wrong AJAX action
- nonce mismatch
- capability restriction
- DAL delete query failure

SCOPE:
Full delete flow audit:
- UI button click
- JS handler
- AJAX request
- PHP handler
- DAL delete function
- Database execution

FILES:
- assets/js/admin.js
- acme-core.php
- modules/module-form.php
- dal/form-dal.php

TARGET_FUNCTIONS:
- JS delete handler (click event)
- PHP delete handler (acme_handle_delete_lead / bulk)
- DAL delete function

EXPECTED_OUTPUT:
- Identify exact failure point
- Trace full delete flow
- Identify mismatch (nonce / action / handler / query)

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-11.5_VALIDATE_DELETE_FLOW)
- If mismatch → STOP

DUPLICATION_CHECK:
- If delete flow already audited → STOP

PRECONDITION_CHECK:
- CRM page loads → YES
- Delete buttons visible → YES
- Data exists in table → YES

STRICT_SCOPE:
- ONLY audit
- DO NOT modify code
- DO NOT fix anything

CONSTRAINTS:
- No assumptions
- Must trace real execution path
- Must verify JS → PHP → DB chain

SECURITY_HINT:
- Pay attention to nonce validation and capability checks

FAIL_CONDITIONS:
- guessing issue
- skipping any layer (JS/PHP/DB)
- partial report

SUCCESS_CRITERIA:
- exact break point identified
- full flow mapped
- clear fix direction defined

# ============================================