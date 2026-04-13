# ============================================
# TASK: PHASE-STATE-SYNC-FIX.md
# ============================================

GOAL:
Synchronize CURRENT TASK across TASK_BOARD.md and PROJECT_STATE.md to match actual execution state.

STEP:
Update CURRENT TASK value in TASK_BOARD.md and PROJECT_STATE.md to "PHASE-9.11-VERIFY"

FILES:
- /wp-content/ai/system/TASK_BOARD.md
- /wp-content/ai/system/PROJECT_STATE.md

INPUT:
None

EXPECTED_OUTPUT:
- TASK_BOARD CURRENT TASK = PHASE-9.11-VERIFY
- PROJECT_STATE CURRENT TASK = PHASE-9.11-VERIFY
- No mismatch remains between system files

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE STATE FIX)
- If mismatch → STOP

DUPLICATION_CHECK:
- If already synced → STOP

PRECONDITION_CHECK:
- TASK_BOARD.md exists → YES
- PROJECT_STATE.md exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only update CURRENT TASK field
- No additional edits
- No formatting changes

CONSTRAINTS:
- Do NOT modify any completed tasks
- Do NOT reorder content
- Do NOT change execution history

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? NO
- Nonce required? NO

FAIL_CONDITIONS:
- Any file mismatch after update
- Wrong task value used
- Extra modification done

SUCCESS_CRITERIA:
- Both files show identical CURRENT TASK
- System passes STATE VALIDITY RULE
- No execution conflict remains

# ============================================