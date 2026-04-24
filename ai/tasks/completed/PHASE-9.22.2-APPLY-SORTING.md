# ============================================
# TASK: PHASE-9.22.2-APPLY-SORTING.md
# ============================================

GOAL:
Pass validated sorting parameters from UI to DAL function call without modifying any other logic.

STEP:
Modify ONLY the acme_get_leads() function call to include sorting parameters.

FILES:
- /wp-content/plugins/acme-core/acme-core.php

EDIT_LOCATION:
- Inside CRM leads rendering logic
- Locate existing acme_get_leads(...) call

INPUT:
- $_GET['orderby']
- $_GET['order']

EXPECTED_OUTPUT:
- acme_get_leads() receives $order_by and $order
- Sorting applied via DAL
- No other logic changed

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.22.2-APPLY-SORTING)
- If mismatch → STOP

DUPLICATION_CHECK:
- If sorting params already passed → STOP

PRECONDITION_CHECK:
- DAL supports sorting → YES
- acme_get_leads function exists → YES

STRICT_SCOPE:
- ONLY modify acme_get_leads() call
- ONLY inside acme-core.php
- DO NOT edit any other line
- DO NOT edit DAL
- DO NOT edit query structure
- DO NOT refactor code

CONSTRAINTS:
- Define whitelist before function call
- Use isset() before $_GET
- Use strtolower()
- Validate using whitelist
- Default fallback must exist

FAIL_CONDITIONS:
- Any file other than acme-core.php modified
- acme_get_leads signature mismatch
- Raw $_GET passed
- Any logic outside defined location modified

SUCCESS_CRITERIA:
- Sorting parameters passed correctly
- Existing functionality unchanged
- No errors or warnings

# ============================================