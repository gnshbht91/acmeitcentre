# ============================================
# TASK: PHASE-9.23.1-BULK-SELECT-UI.md
# ============================================

GOAL:
Enable selection of multiple leads using checkboxes in CRM table.

STEP:
Add checkbox column to table header and rows.

FILES:
- /wp-content/plugins/acme-core/acme-core.php

EDIT_LOCATION:

1. TABLE HEADER (<thead>):
   - BEFORE first existing <th>
   - Insert checkbox header

2. TABLE BODY (<tbody>):
   - Inside each row <tr>
   - BEFORE first <td>

DO NOT TOUCH:
- Any existing <th> text
- Any existing <td> data
- Sorting links
- Delete button
- Backend logic

INPUT:
None

EXPECTED_OUTPUT:
- Checkbox in header (select all)
- Checkbox in each row

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.23.1-BULK-SELECT-UI)
- If mismatch → STOP

DUPLICATION_CHECK:
- If checkbox column already exists → STOP

PRECONDITION_CHECK:
- CRM table exists → YES

STRICT_SCOPE:
- ONLY add checkbox column
- DO NOT modify existing structure
- DO NOT add JS logic
- DO NOT modify backend

CONSTRAINTS:

HEADER CHECKBOX:

<th>
    <input type="checkbox" id="acme-select-all">
</th>

ROW CHECKBOX:

<td>
    <input type="checkbox" class="acme-select-row" value="LEAD_ID">
</td>

- Use existing lead ID variable
- Keep HTML clean

FAIL_CONDITIONS:
- Existing columns modified
- Wrong placement
- Missing checkbox in rows

SUCCESS_CRITERIA:
- Header checkbox visible
- Row checkboxes visible
- Layout intact

# ============================================