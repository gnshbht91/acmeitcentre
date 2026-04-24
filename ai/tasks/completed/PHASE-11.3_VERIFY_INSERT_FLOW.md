# ============================================
# TASK: PHASE-11.3_VERIFY_INSERT_FLOW.md
# ============================================

GOAL:
Verify that form submissions are correctly inserted into wp_acme_form_entries table and stabilize insert flow by identifying silent failures.

SCOPE:
- Form submission (POST + AJAX)
- Handler execution
- DAL insert function
- Database write result

FILES:
- includes/frontend/lead-form.php
- modules/module-form.php
- dal/form-dal.php

TARGET_FUNCTIONS:
- acme_process_lead_submission()
- acme_insert_form_entry()

EXPECTED_OUTPUT:
- Insert execution confirmed
- Insert success/failure identified
- Any DB error surfaced
- Stable insert flow

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-11.3_VERIFY_INSERT_FLOW)
- If mismatch → STOP

DUPLICATION_CHECK:
- If debug logging already exists → STOP

PRECONDITION_CHECK:
- wp_acme_form_entries table exists → YES
- acme_insert_form_entry() exists → YES
- form submission working → YES

STRICT_SCOPE:
- ONLY add temporary debug logging
- DO NOT change logic
- DO NOT modify queries
- DO NOT refactor code

CONSTRAINTS:
- Use error_log() only
- No echo/print/var_dump
- Logging must be removable
- No performance-heavy code

SECURITY_HINT:
- Do not expose sensitive data in logs

FAIL_CONDITIONS:
- modifying insert logic
- adding permanent debug code
- breaking submission flow

SUCCESS_CRITERIA:
- Insert success confirmed OR exact DB error identified
- No functional break
- Logs clearly show insert result

# ============================================