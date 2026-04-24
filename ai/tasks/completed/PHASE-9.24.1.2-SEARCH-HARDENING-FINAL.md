# ============================================
# TASK: PHASE-9.24.1.2-SEARCH-HARDENING-FINAL.md
# ============================================

GOAL:
Add fully isolated, duplicate-safe, traceable search logic without modifying existing code.

FILES:
ONLY:
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

PRECONDITION_CHECK

✔ search input exists (id="acme-search")
✔ CRM table exists (#acme-leads-table)

IF ANY FAIL:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search EXACT:

ACME_SEARCH_HANDLER_V2

IF FOUND:
→ STOP

--------------------------------------------

STRICT_SCOPE

✔ ADD code ONLY  
❌ DO NOT delete or modify existing code  

--------------------------------------------

STEP 1 — OPEN FILE

admin.js

---

STEP 2 — SCROLL TO END

---

STEP 3 — ADD CODE

ADD EXACT BLOCK:

// ACME_SEARCH_HANDLER_V2 (DO NOT DUPLICATE)
(function() {

    const input = document.getElementById('acme-search');
    const table = document.getElementById('acme-leads-table');
    const emptyMsg = document.getElementById('acme-search-empty');

    if (!input || !table) return;

    // prevent duplicate binding
    if (input.dataset.acmeSearchBound === "true") return;
    input.dataset.acmeSearchBound = "true";

    let acmeSearchTimer;

    input.addEventListener('input', function() {

        clearTimeout(acmeSearchTimer);

        acmeSearchTimer = setTimeout(() => {

            const value = input.value.trim().toLowerCase();

            const tbody = table.querySelector('tbody');
            if (!tbody) return;

            const rows = tbody.querySelectorAll('tr');

            let visible = 0;

            rows.forEach(row => {

                // ignore empty state row
                if (row.children.length === 1) return;

                const text = row.innerText.toLowerCase();

                if (value === "" || text.includes(value)) {
                    row.style.display = '';
                    visible++;
                } else {
                    row.style.display = 'none';
                }

            });

            if (emptyMsg) {
                emptyMsg.style.display = visible === 0 ? 'block' : 'none';
            }

        }, 200);

    });

})();

--------------------------------------------

SUCCESS_CRITERIA

✔ search works  
✔ no duplicate handler  
✔ empty message works  
✔ no JS error  

--------------------------------------------

FAIL_CONDITIONS

❌ duplicate handler  
❌ UI break  
❌ console error  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  

UPDATE:
- TASK_BOARD.md  
- PROJECT_STATE.md  
- DEV_LOG.md  

VERIFY consistency  

# ============================================