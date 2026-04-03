# ============================================
# TASK: PHASE-6.1.1-FIX-LOADER-REGISTRATION.md
# ============================================

GOAL:
Ensure module-course-engine.php is registered in existing loader WITHOUT overwriting loader structure

STEP:
Modify existing loader.php to safely include module-course-engine.php only if not already included

FILES:
- wp-content/plugins/acme-core/core/loader.php

EXPECTED_OUTPUT:
- Existing loader structure preserved
- module-course-engine.php included once
- No duplicate require
- No module loss
- No PHP error

TASK_VALIDATION:
- Must match fix requirement of PHASE 6.1
- If mismatch → STOP

DUPLICATION_CHECK:
- If require_once already exists → STOP

PRECONDITION_CHECK:
- loader.php exists → YES
- module-course-engine.php exists → YES

STRICT_SCOPE:
- ONLY add require_once line
- DO NOT modify any other code
- DO NOT recreate file

CONSTRAINTS:
- Follow existing loader pattern
- Maintain order of modules

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? NO
- Nonce required? NO

FAIL_CONDITIONS:
- Loader overwritten
- Existing modules removed
- Duplicate require added
- PHP error

SUCCESS_CRITERIA:
- Loader intact
- Module registered
- System stable