# ============================================
# TASK: PHASE-9.23.3.2-BULK-STATUS-AJAX.md
# ============================================

GOAL:
Securely update status of multiple leads via AJAX without modifying existing system.

FILES:
- /wp-content/plugins/acme-core/modules/module-form.php

--------------------------------------------

EDIT LOCATION (STRICT)

1. OPEN FILE:
   module-form.php

2. FIND:
   existing AJAX handlers section

   (search: wp_ajax_)

3. INSERT LOCATION:
   AFTER LAST existing add_action('wp_ajax_...')

--------------------------------------------

PRE-VALIDATION (MANDATORY)

YOU MUST VERIFY:

✔ File exists
✔ acme_update_leads_status_bulk() exists
✔ At least one wp_ajax handler exists

IF ANY FAIL:
→ STOP

--------------------------------------------

DUPLICATION CHECK

IF function already exists:

acme_handle_bulk_status_update

→ STOP

--------------------------------------------

ADD THIS EXACT FUNCTION

function acme_handle_bulk_status_update() {

    if (!isset($_POST['_wpnonce']) || 
        !wp_verify_nonce($_POST['_wpnonce'], 'acme_nonce')) {
        wp_send_json_error(array('message' => 'Invalid nonce'));
    }

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Unauthorized'));
    }

    if (!isset($_POST['lead_ids']) || !is_array($_POST['lead_ids'])) {
        wp_send_json_error(array('message' => 'Invalid lead IDs'));
    }

    if (!isset($_POST['status']) || trim($_POST['status']) === '') {
        wp_send_json_error(array('message' => 'Invalid status'));
    }

    $lead_ids = array_map('intval', $_POST['lead_ids']);
    $status = sanitize_text_field($_POST['status']);

    $valid_ids = array();

    foreach ($lead_ids as $id) {
        if ($id > 0) {
            $valid_ids[] = $id;
        }
    }

    if (empty($valid_ids)) {
        wp_send_json_error(array('message' => 'No valid IDs'));
    }

    $result = acme_update_leads_status_bulk($valid_ids, $status);

    if ($result) {
        wp_send_json_success(array('message' => 'Status updated'));
    } else {
        wp_send_json_error(array('message' => 'Update failed'));
    }
}

--------------------------------------------

ADD THIS EXACT HOOK (BELOW FUNCTION)

add_action('wp_ajax_acme_bulk_status_update', 'acme_handle_bulk_status_update');

--------------------------------------------

STRICT RULES

YOU MUST:
✔ Modify ONLY module-form.php
✔ ADD code ONLY
✔ Insert AFTER existing AJAX hooks

YOU MUST NOT:
❌ Modify any existing function
❌ Modify DAL
❌ Modify UI
❌ Change hook names

--------------------------------------------

SUCCESS CHECK

✔ No PHP error
✔ Function exists
✔ Hook exists
✔ AJAX callable

FAIL IF

❌ Any existing code modified
❌ Wrong placement
❌ Duplicate function

--------------------------------------------

# TASK COMPLETION PROTOCOL

STEP 1:
Move file:
/tasks/active/ → /tasks/completed/

STEP 2:
Verify move

STEP 3:
Update TASK_BOARD.md

STEP 4:
Update PROJECT_STATE.md

STEP 5:
Update DEV_LOG.md

STEP 6:
Verify consistency

IF mismatch → STOP

# ============================================