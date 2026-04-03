# ============================================
# TASK: PHASE-6.5-ADD-CACHING.md
# ============================================

GOAL:
Add caching layer to DAL functions to reduce database load and improve performance

STEP:
Implement WordPress transient-based caching for batch and instructor queries

FILES:
- wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

INPUT:
- course_id
- batch_id

EXPECTED_OUTPUT:
- Cached results for:
  acme_get_batches_by_course
  acme_get_instructor_by_batch
- Reduced DB queries
- No change in output structure

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 6.5)
- If mismatch → STOP

DUPLICATION_CHECK:
- If caching already exists → STOP

PRECONDITION_CHECK:
- Functions exist → YES
- Queries working → YES

STRICT_SCOPE:
- Only add caching
- Do NOT change query logic
- Do NOT change return structure

CONSTRAINTS:
- Use WordPress transients (set_transient / get_transient)
- Cache key must be unique per input
- Cache expiration required

CACHE_RULE:
- Cache key format:
  acme_batches_{course_id}
  acme_instructor_{batch_id}
- Expiration: 12 hours

RETURN_RULE:
- Return cached data if exists
- Else query DB and store cache

SECURITY_HINT:
- Sanitization required? YES
- Escaping required? NO

FAIL_CONDITIONS:
- cache not used
- wrong cache key
- stale or wrong data
- output changed

SUCCESS_CRITERIA:
- cache working
- DB calls reduced
- output unchanged