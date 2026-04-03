# ============================================
# TASK: PHASE-6.1.2-LOAD-CORE-LOADER.md
# ============================================

GOAL:
Ensure core loader.php is loaded inside main plugin file so all modules execute

STEP:
Add require_once for core/loader.php inside acme-core.php

FILES:
- wp-content/plugins/acme-core/acme-core.php

EXPECTED_OUTPUT:
- loader.php is included in plugin boot
- modules start loading
- no PHP error

TASK_VALIDATION:
- Must follow PHASE 6 flow
- If mismatch → STOP

DUPLICATION_CHECK:
- If loader already included → STOP

PRECONDITION_CHECK:
- acme-core.php exists → YES
- loader.php exists → YES

STRICT_SCOPE:
- ONLY add require_once line
- DO NOT modify anything else

CONSTRAINTS:
- Follow existing load pattern
- Maintain order

SECURITY_HINT:
- Sanitization → NO
- Escaping → NO
- Nonce → NO

FAIL_CONDITIONS:
- duplicate require
- wrong path
- PHP error

SUCCESS_CRITERIA:
- loader executed
- modules active
- no errors