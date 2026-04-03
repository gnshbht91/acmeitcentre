# ============================================
# TASK: PRE-PHASE-7-GIT-CHECKPOINT.md
# ============================================

GOAL:
Create a final verified checkpoint before starting Phase 7 using Git tag and safe push

STEP:
Verify repo clean, create tag, and push safely

FILES:
- full project (no new changes expected)

EXPECTED_OUTPUT:
- repo clean (no pending changes)
- tag created (phase-6-final)
- tag pushed to remote

TASK_VALIDATION:
- Must run AFTER Phase 6 push
- If pending changes → STOP

DUPLICATION_CHECK:
- If tag already exists → STOP

PRECONDITION_CHECK:
- git repo initialized → YES
- last push success → YES

STRICT_SCOPE:
- No new commit unless required
- No code changes

CONSTRAINTS:
- Use tag instead of duplicate commit
- Maintain clean history

SECURITY_HINT:
- No sensitive files check again

FAIL_CONDITIONS:
- uncommitted changes
- tag duplicate
- push failed

SUCCESS_CRITERIA:
- repo clean
- tag created
- tag pushed