# ============================================
# TASK: PHASE-10.7_ADD_COURSE_FIELD_WHITELIST.md
# ============================================

GOAL:
Ensure only valid predefined values are saved for duration_unit, level, and mode fields.

STEP:
Add whitelist validation using in_array() before saving each field.

FILES:
wp-content/plugins/acme-core/includes/post-types/course.php

EXPECTED_OUTPUT:
- duration_unit validated against allowed values
- level validated against allowed values
- mode validated against allowed values
- invalid values not saved
- no PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.7_ADD_COURSE_FIELD_WHITELIST)
- If mismatch → STOP

DUPLICATION_CHECK:
- If whitelist already exists → STOP

PRECONDITION_CHECK:
- course.php exists → YES
- save function exists → YES
- fields exist → YES

STRICT_SCOPE:
- ONLY add whitelist validation
- Do NOT refactor function
- Do NOT change field names

CONSTRAINTS:
- Use in_array with strict mode (true)
- No new features
- No UI change

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? N/A
- Nonce required? N/A

FAIL_CONDITIONS:
- whitelist missing
- invalid values saved
- PHP error

SUCCESS_CRITERIA:
- only allowed values saved
- invalid ignored
- no errors

# ============================================