# ============================================
# TASK: PHASE-6.6-INVALIDATE-CACHE.md
# ============================================

GOAL:
Invalidate cache when batch or instructor data changes to prevent stale data

STEP:
Add cache deletion logic on data update/insert/delete events

FILES:
- wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

INPUT:
- course_id
- batch_id

EXPECTED_OUTPUT:
- Cache cleared when data changes
- No stale data returned
- No PHP error

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 6.6)
- If mismatch → STOP

DUPLICATION_CHECK:
- If invalidation already exists → STOP

PRECONDITION_CHECK:
- Caching implemented → YES

STRICT_SCOPE:
- Only add cache invalidation
- Do NOT modify existing query logic

CONSTRAINTS:
- Use delete_transient
- Must match cache key format
- Trigger only on data change

CACHE_RULE:
- delete:
  acme_batches_{course_id}
  acme_instructor_{batch_id}

RETURN_RULE:
- No return required (void operation)

SECURITY_HINT:
- Sanitization required? YES

FAIL_CONDITIONS:
- cache not deleted
- wrong key used
- stale data remains

SUCCESS_CRITERIA:
- cache cleared correctly
- fresh data served after update