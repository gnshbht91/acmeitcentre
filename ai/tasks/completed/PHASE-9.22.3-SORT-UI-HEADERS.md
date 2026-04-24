# ============================================
# TASK: PHASE-9.22.3-SORT-UI-HEADERS.md
# ============================================

GOAL:
Enable sorting via clickable headers without altering table structure.

STEP:
Wrap existing header text in anchor links for sorting.

FILES:
- /wp-content/plugins/acme-core/acme-core.php

EDIT_LOCATION:
- ONLY inside CRM leads table <thead>
- ONLY these exact headers:
    Name
    Email
    Course
    Date

DO NOT TOUCH:
- Any other <th>
- Table body
- Other HTML structure

INPUT:
- $_GET['orderby']
- $_GET['order']

EXPECTED_OUTPUT:
- Header text clickable
- Sorting toggles asc/desc

TASK_VALIDATION:
- Must match TASK_BOARD

DUPLICATION_CHECK:
- If <a> already present → STOP

PRECONDITION_CHECK:
- Sorting backend working

STRICT_SCOPE:
- ONLY wrap text in <a>
- DO NOT change text
- DO NOT change layout
- DO NOT modify backend

CONSTRAINTS:
- Use esc_url()
- Keep original text unchanged
- Preserve existing query params
- Toggle order correctly

FAIL_CONDITIONS:
- Header text changed
- Extra HTML added
- Wrong column modified

SUCCESS_CRITERIA:
- Click works
- Toggle works
- UI unchanged

# ============================================