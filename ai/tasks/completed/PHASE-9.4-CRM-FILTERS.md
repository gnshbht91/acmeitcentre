# ============================================
# TASK: PHASE-9.4-CRM-FILTERS.md
# ============================================

GOAL:
Add filters to CRM leads table

STEP:
Add status filter + search input and apply to DB query

FILES:
- wp-content/plugins/acme-core/dal/form-dal.php
- wp-content/plugins/acme-core/acme-core.php

INPUT:
GET params:
- status
- search

EXPECTED_OUTPUT:
- Filtered leads displayed
- UI working

TASK_VALIDATION:
- Must match PHASE 9.4
- If mismatch → STOP

DUPLICATION_CHECK:
- Filter logic must not exist

PRECONDITION_CHECK:
- Pagination working → YES

STRICT_SCOPE:
- Only filters
- No ajax

CONSTRAINTS:
- Use prepared query
- Sanitize input

FAIL_CONDITIONS:
- SQL error
- wrong filtering
- XSS

SUCCESS_CRITERIA:
- Filters working
- correct results

# ============================================