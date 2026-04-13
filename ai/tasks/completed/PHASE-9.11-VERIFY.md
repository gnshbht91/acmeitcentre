# ============================================
# TASK: PHASE-9.11-VERIFY.md
# ============================================

GOAL:
Perform a full technical audit of Phase 9 CRM system including menu, table, pagination, filters, status update, notes, assignment, role restriction, and data integrity to ensure system is 100% ready for Phase 10.

STEP:
Audit ALL Phase 9 components for correctness, security, data flow, and consistency without modifying code.

FILES:
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/modules/module-crm.php
- /wp-content/plugins/acme-core/modules/module-form.php
- /wp-content/plugins/acme-core/dal/form-dal.php
- /wp-content/plugins/acme-core/includes/db/form-db.php
- /wp-content/ai/system/DEV_LOG.md

INPUT:
None

EXPECTED_OUTPUT:
- CRM Menu loads correctly in admin
- Leads table renders without errors
- Pagination works correctly with filters
- Status update persists correctly
- Notes system saves and retrieves correctly
- Assignment system works (manual + auto)
- Role restriction enforced correctly
- No PHP errors/warnings/notices
- No direct SQL injection risk
- All queries use prepare or safe methods
- No broken data flow between UI → AJAX → DAL → DB
- No missing fields in DB vs UI mismatch

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.11-VERIFY)
- If mismatch → STOP

DUPLICATION_CHECK:
- If audit already completed → STOP

PRECONDITION_CHECK:
- All listed files exist → YES
- CRM system accessible in admin → YES
- Database tables exist → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY audit allowed
- NO code changes
- NO fixes
- NO refactoring

CONSTRAINTS:
- Follow ACME rules strictly
- Validate against DEV_LOG history
- Do NOT assume missing logic
- Report exact issues only

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? YES
- Nonce required? YES

FAIL_CONDITIONS:
- Any missing validation
- Any direct SQL usage without prepare
- Any missing nonce in AJAX
- Any role bypass possibility
- Any mismatch between DB and UI fields
- Any pagination/filter inconsistency

SUCCESS_CRITERIA:
- All Phase 9 components verified
- No critical security issue
- No data flow break
- System declared ready for Phase 10

# ============================================