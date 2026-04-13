# ============================================
# TASK: SYSTEM-PHASE-8-RESTRUCTURE.md
# ============================================

GOAL:
Restructure PHASE 8 (LEADS) with correct order and updated logic flow

STEP:
Update PHASE 8 sequence across system files to ensure correct execution order

FILES:
- wp-content/ai/docs/ACME_EXECUTION_PLAN.md
- wp-content/ai/system/PROJECT_STATE.md
- wp-content/ai/system/TASK_BOARD.md

INPUT:
Updated PHASE 8 structure:

8.1 Upgrade insert (lead-ready)
8.2 Capture URL
8.3 Capture UTM
8.4 Capture IP
8.5 Duplicate check (before insert)
8.6 Parent lead
8.7 Status
8.8 Cleanup cron
8.9 GDPR export
8.10 GDPR erase
8.11 Verify

EXPECTED_OUTPUT:
- PHASE 8 updated in execution plan
- PROJECT_STATE reflects new structure
- TASK_BOARD updated with corrected order
- No duplicate or old structure left

TASK_VALIDATION:
- Must reflect corrected order (duplicate check before insert)
- If mismatch → STOP

DUPLICATION_CHECK:
- Old PHASE 8 structure must not remain
- If duplicate entries found → CLEAN

PRECONDITION_CHECK:
- PHASE 7.5 completed → YES
- Files exist → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only restructure documentation
- No code change
- No DB change

CONSTRAINTS:
- Maintain existing formatting
- Keep numbering consistent
- Do not skip any step

SECURITY_HINT:
- N/A

FAIL_CONDITIONS:
- Wrong order
- Partial update
- Old structure remains

SUCCESS_CRITERIA:
- PHASE 8 fully updated and synced
- System ready for 8.1 execution

# ============================================