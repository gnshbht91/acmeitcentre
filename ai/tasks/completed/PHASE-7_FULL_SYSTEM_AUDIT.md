# ============================================
# TASK: PHASE-7_FULL_SYSTEM_AUDIT.md
# ============================================

GOAL:
Perform a complete technical audit of Phase 7 form system including:
- AJAX flow
- Handler logic
- Sanitization
- DAL layer
- DB insert
- Response structure
- Email system
- Logging & fail-safes

STEP:
Systematically verify each component and identify:
- Bugs
- Missing validations
- Security gaps
- Data inconsistencies
- Flow breaks

FILES:
/wp-content/plugins/acme-core/modules/module-form.php
/wp-content/plugins/acme-core/dal/form-dal.php
/wp-content/plugins/acme-core/includes/db/form-db.php
/wp-content/plugins/acme-core/acme-core.php

INPUT:
All possible form scenarios:
- Valid input
- Empty input
- Invalid email
- Partial input
- Spam input

EXPECTED_OUTPUT:
- Complete audit report
- List of issues (if any)
- Risk level (low / medium / high)
- Fix recommendations

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 7 AUDIT)
- If mismatch → STOP

DUPLICATION_CHECK:
- If audit already exists → STOP

PRECONDITION_CHECK:
- Phase 7 complete → YES
- All components working → YES

STRICT_SCOPE:
- ONLY audit
- NO code modification
- NO fixes applied

CONSTRAINTS:
- Must not assume correctness
- Must validate each layer independently
- Must verify real execution flow

SECURITY_HINT:
- Input validation → REQUIRED
- Sanitization → REQUIRED
- Output escaping → REQUIRED

FAIL_CONDITIONS:
- Skipped validation steps
- Partial audit
- Missing components

SUCCESS_CRITERIA:
- Full system mapped
- All risks identified
- Clear next actions defined

# ============================================