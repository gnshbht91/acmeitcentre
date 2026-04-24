# ============================================
# TASK: PHASE-9.20-GIT-SAFE-PUSH.md
# ============================================

GOAL:
Push current system state to Git repository safely without exposing sensitive data or committing unintended files.

STEP:
Stage and commit only verified project files and push to remote repository.

FILES:
- /wp-content/plugins/acme-core/
- /wp-content/themes/acme/
- /wp-content/ai/system/
- /wp-content/ai/tasks/completed/

INPUT:
None

EXPECTED_OUTPUT:
- All required files committed
- No sensitive or unwanted files committed
- Repository updated with latest stable state

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.20-GIT-SAFE-PUSH)
- If mismatch → STOP

DUPLICATION_CHECK:
- If already pushed → STOP

PRECONDITION_CHECK:
- Phase 9.19 completed → YES
- System verified → YES
- Git initialized → YES
- Remote connected → YES

STRICT_SCOPE:
- ONLY perform git operations
- DO NOT modify any code
- DO NOT stage unwanted files

CONSTRAINTS:
- Exclude:
  - wp-config.php
  - .env
  - debug logs
  - node_modules
  - uploads
- Only stage defined directories

SECURITY_HINT:
- Prevent secret exposure
- Prevent accidental commit

FAIL_CONDITIONS:
- Sensitive file committed
- Wrong file staged
- Git push failed

SUCCESS_CRITERIA:
- Clean commit
- Safe push
- Repo updated

# ============================================