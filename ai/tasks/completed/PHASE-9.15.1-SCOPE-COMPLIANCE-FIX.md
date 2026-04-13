# ============================================
# TASK: PHASE-9.15.1-SCOPE-COMPLIANCE-FIX.md
# ============================================

GOAL:
Restore strict scope compliance for Phase 9.15 by isolating UI changes and ensuring role restriction logic remains backend-only without affecting system stability.

STEP:
Separate UI-related changes from backend enforcement and ensure no unintended capability or UI behavior change affects system functionality.

FILES:
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/dal/form-dal.php
- /wp-content/ai/system/DEV_LOG.md
- /wp-content/ai/system/PROJECT_STATE.md
- /wp-content/ai/system/TASK_BOARD.md

INPUT:
None

EXPECTED_OUTPUT:
- Backend role restriction remains intact
- UI changes documented and isolated
- No unintended capability changes affecting access
- CRM functionality unchanged
- No regression introduced

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.15.1-SCOPE-COMPLIANCE-FIX)
- If mismatch → STOP

DUPLICATION_CHECK:
- If already compliant → STOP

PRECONDITION_CHECK:
- Phase 9.15 implemented → YES
- CRM system functional → YES

STRICT_SCOPE:
- DO NOT modify backend security logic
- DO NOT remove DAL filtering
- ONLY fix scope compliance and documentation

CONSTRAINTS:
- Preserve existing working behavior
- Do not break staff/admin access
- Do not change database logic

SECURITY_HINT:
- Backend restriction already implemented → NO CHANGE

FAIL_CONDITIONS:
- DAL restriction removed or broken
- CRM UI breaks
- Access control changes unintentionally
- Any feature regression

SUCCESS_CRITERIA:
- Backend security intact
- UI changes isolated and justified
- System stable
- No regression

# ============================================