# ============================================
# TASK: PHASE-9.3-CRM-PAGINATION.md
# ============================================

GOAL:
Add pagination to CRM leads table

STEP:
Implement page-based data fetching

FILES:
- wp-content/plugins/acme-core/dal/form-dal.php
- wp-content/plugins/acme-core/acme-core.php

INPUT:
page number (GET param)

EXPECTED_OUTPUT:
- Paginated table
- Navigation links working

TASK_VALIDATION:
- Must match PHASE 9.3
- If mismatch → STOP

DUPLICATION_CHECK:
- Pagination logic must not exist

PRECONDITION_CHECK:
- Table working → YES

STRICT_SCOPE:
- Only pagination
- No filters

CONSTRAINTS:
- Use LIMIT + OFFSET
- Sanitize page param

SECURITY_HINT:
- No raw GET usage

FAIL_CONDITIONS:
- Wrong page data
- SQL error
- broken navigation

SUCCESS_CRITERIA:
- Pagination works
- Data correct

# ============================================