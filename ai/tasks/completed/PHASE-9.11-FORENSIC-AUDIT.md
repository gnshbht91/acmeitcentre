# ============================================
# TASK: PHASE-9.11-FORENSIC-AUDIT.md
# ============================================

GOAL:
Perform a forensic-level audit of Phase 9 CRM system by validating actual code at function and line level, ensuring security, data integrity, and execution correctness with verifiable proof.

STEP:
Inspect and validate exact code implementations for all Phase 9 features with function-level tracing, variable tracking, and query verification.

FILES:
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/modules/module-crm.php
- /wp-content/plugins/acme-core/modules/module-form.php
- /wp-content/plugins/acme-core/modules/module-cron.php
- /wp-content/plugins/acme-core/dal/form-dal.php
- /wp-content/plugins/acme-core/includes/db/form-db.php
- /wp-content/plugins/acme-core/core/loader.php

INPUT:
None

EXPECTED_OUTPUT:
- Each feature mapped to exact file + function name
- Each function mapped to exact logic (what it does)
- Each AJAX handler mapped with hook name + nonce verification line
- Each DB query shown with prepare/insert/update proof
- Each input field traced from source to DB
- Each output verified with escaping
- Exact vulnerability list (if any)
- Exact missing checks (if any)
- Edge case handling verified with proof
- FINAL verdict: SAFE / NOT SAFE

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.11-FORENSIC-AUDIT)
- If mismatch → STOP

DUPLICATION_CHECK:
- If forensic audit already exists → STOP

PRECONDITION_CHECK:
- All files exist → YES
- Code accessible → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY audit
- NO fixes
- NO assumptions
- MUST include code-level proof

CONSTRAINTS:
- Every claim must include:
  - file path
  - function name
  - logic explanation
- No generic statements allowed
- No skipping any Phase 9 component

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? YES
- Nonce required? YES

FAIL_CONDITIONS:
- Missing nonce in any AJAX
- Raw SQL without prepare
- Missing sanitization
- Missing capability check
- Undefined variables
- Broken execution chain
- DB column mismatch
- Role restriction bypass

SUCCESS_CRITERIA:
- All features verified with code proof
- No critical vulnerability
- Full trace validated
- System safe for production

# ============================================