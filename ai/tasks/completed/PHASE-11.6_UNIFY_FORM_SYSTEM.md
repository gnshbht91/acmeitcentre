# ============================================
# TASK: PHASE-11.6_UNIFY_FORM_SYSTEM.md
# ============================================

GOAL:
Unify form system by standardizing lead submission flow to a single method and removing duplicate form logic.

ROOT_CAUSE:
Two parallel systems exist:
1. [acme_form] → AJAX submission
2. [acme_lead_form] → POST submission

This creates:
- duplicate logic
- inconsistent behavior
- maintenance complexity

DECISION:
Keep AJAX-based system ([acme_form]) as canonical.
Deprecate POST-based system ([acme_lead_form]).

SCOPE:
- Identify both shortcode implementations
- Remove or disable POST-based form
- Ensure AJAX form remains fully functional

FILES:
- includes/frontend/lead-form.php
- modules/module-form.php

TARGET_FUNCTIONS:
- acme_form_shortcode()
- acme_lead_form_shortcode()

EXPECTED_OUTPUT:
- Only one active form system
- No duplicate submission paths
- AJAX form works fully

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-11.6_UNIFY_FORM_SYSTEM)
- If mismatch → STOP

DUPLICATION_CHECK:
- If POST form already removed → STOP

PRECONDITION_CHECK:
- both shortcodes exist → YES
- AJAX form working → YES

STRICT_SCOPE:
- Only form system changes
- Do not modify DAL
- Do not modify DB
- Do not change insert logic

CONSTRAINTS:
- Maintain backward compatibility if needed
- Do not break existing AJAX flow
- Keep shortcode naming stable (if required)

SECURITY_HINT:
- Ensure nonce consistency in final system

FAIL_CONDITIONS:
- both forms removed
- AJAX form breaks
- submission stops working

SUCCESS_CRITERIA:
- only one form system active
- form submission works
- no duplicate code paths

# ============================================