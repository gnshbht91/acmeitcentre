# ============================================
# TASK: PHASE-7.5.2-INSERT-DATA.md
# ============================================

GOAL:
Insert validated form data into database using DAL layer

STEP:
Create insert function in DAL and call it from AJAX handler

FILES:
- wp-content/plugins/acme-core/dal/form-dal.php
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
- name
- phone
- email
- course

EXPECTED_OUTPUT:
- Data inserted into {prefix}_acme_form_entries
- Insert ID returned
- No SQL errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7.5.2)
- If mismatch → STOP

DUPLICATION_CHECK:
- Insert function must not already exist
- If exists → STOP

PRECONDITION_CHECK:
- Table exists → YES
- DAL file exists → YES
- Sanitized variables exist → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only insert logic
- No schema change
- No email logic

CONSTRAINTS:
- MUST use $wpdb->insert()
- MUST use $wpdb->prefix
- MUST return insert ID
- No raw SQL

SECURITY_HINT:
- Only sanitized data allowed

FAIL_CONDITIONS:
- Direct SQL query used
- Missing column mapping
- Insert fails silently

SUCCESS_CRITERIA:
- Data inserted correctly
- ID returned
- No errors

# ============================================