# ============================================
# TASK: PHASE-9.23.3.1-DAL-BULK-STATUS.md
# ============================================

GOAL:
Safely update status of multiple leads using DAL without assumptions or silent failures.

FILES:
- /wp-content/plugins/acme-core/dal/form-dal.php

EDIT_LOCATION:
- Find function: acme_delete_leads_bulk()
- Insert NEW function IMMEDIATELY AFTER it

--------------------------------------------------

PRE-VALIDATION (MANDATORY BEFORE WRITING CODE)

YOU MUST VERIFY:

1. File exists:
   /wp-content/plugins/acme-core/dal/form-dal.php

2. Function exists:
   acme_delete_leads_bulk()

3. Table reference:
   MUST use SAME table used in existing DAL functions

   DO NOT create new table name

4. Column check:
   Confirm "status" column is used in existing system

IF ANY CHECK FAILS:
→ STOP EXECUTION

--------------------------------------------------

ADD THIS EXACT CODE (NO MODIFICATION ALLOWED)

function acme_update_leads_status_bulk($lead_ids, $status) {

    global $wpdb;

    // Step 1: Validate input
    if (!is_array($lead_ids) || empty($lead_ids)) {
        return false;
    }

    if (!is_string($status) || trim($status) === '') {
        return false;
    }

    // Step 2: Clean status
    $status = sanitize_text_field($status);

    // Step 3: Filter valid IDs
    $valid_ids = array();

    foreach ($lead_ids as $id) {
        $id = intval($id);
        if ($id > 0) {
            $valid_ids[] = $id;
        }
    }

    // Step 4: If no valid IDs → fail
    if (empty($valid_ids)) {
        return false;
    }

    // Step 5: Track success
    $updated = 0;

    foreach ($valid_ids as $id) {

        $result = $wpdb->update(
            $wpdb->prefix . 'acme_form_entries',
            array('status' => $status),
            array('id' => $id),
            array('%s'),
            array('%d')
        );

        if ($result !== false) {
            $updated++;
        }
    }

    // Step 6: Final validation
    if ($updated === 0) {
        return false;
    }

    return true;
}

--------------------------------------------------

STRICT RULES

YOU MUST:
✔ Add ONLY this function
✔ Place EXACTLY below bulk delete function

YOU MUST NOT:
❌ Modify existing functions
❌ Change table name manually
❌ Add permission logic
❌ Use $_POST

--------------------------------------------------

SUCCESS CONDITIONS

✔ Function added successfully
✔ No syntax error
✔ Existing system unchanged

FAIL IF

❌ Function placed wrong location
❌ Existing code modified
❌ Any assumption made

--------------------------------------------------

# TASK COMPLETION PROTOCOL

STEP 1:
Move file from:

/wp-content/ai/tasks/active/PHASE-9.23.3.1-DAL-BULK-STATUS.md

TO:

/wp-content/ai/tasks/completed/PHASE-9.23.3.1-DAL-BULK-STATUS.md

STEP 2:
Verify file moved

STEP 3:
Update TASK_BOARD.md

STEP 4:
Update PROJECT_STATE.md

STEP 5:
Update DEV_LOG.md

STEP 6:
Verify state consistency

IF mismatch → STOP

# ============================================