# ============================================
# TASK: PHASE-6.1-DEFINE-COURSE-ENGINE-STRUCTURE.md
# ============================================

GOAL:
Create base structure for Course Engine module inside plugin (module file exists and registered in loader)

STEP:
Create module-course-engine.php file and register it in core loader

FILES:
- wp-content/plugins/acme-core/modules/module-course-engine.php
- wp-content/plugins/acme-core/core/loader.php

EXPECTED_OUTPUT:
- module-course-engine.php file exists
- File is included in loader.php
- No PHP error
- Module loads successfully

TASK_VALIDATION:
- Must match TASK_BOARD current task → PHASE 6.1
- If mismatch → STOP

DUPLICATION_CHECK:
- If module-course-engine.php already exists → STOP

PRECONDITION_CHECK:
- Plugin structure exists → YES
- modules/ folder exists → YES
- loader.php exists → YES

STRICT_SCOPE:
- ONLY create module file
- ONLY register in loader
- NO logic inside module

CONSTRAINTS:
- Follow WordPress standards
- No extra functions
- No business logic

SECURITY_HINT:
- Sanitization required? NO
- Escaping required? NO
- Nonce required? NO

FAIL_CONDITIONS:
- File exists already
- Loader not updated
- PHP error occurs

SUCCESS_CRITERIA:
- File created
- Loader updated
- No errors