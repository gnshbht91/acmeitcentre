# ============================================
# TASK: PHASE-9.24.2-FILTER-SYSTEM.md
# ============================================

GOAL:
Add unified filter system (status + date) that works together with search without conflict.

FILES:
ONLY:
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

PRECONDITION_CHECK

✔ table exists (#acme-leads-table)
✔ search handler V2 exists

IF FAIL:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search:
ACME_FILTER_HANDLER_V2

IF FOUND:
→ STOP

--------------------------------------------

PART 1 — UI (SAFE ADD)

OPEN:
acme-core.php

---

SEARCH:
acme-search

---

INSERT BELOW:

<select id="acme-filter-status">
<option value="">All Status</option>
<option value="new">New</option>
<option value="contacted">Contacted</option>
<option value="converted">Converted</option>
</select>

<input type="date" id="acme-filter-date">

---

--------------------------------------------

PART 2 — JS (UNIFIED ENGINE)

OPEN:
admin.js

---

STEP 1 — SCROLL TO END

---

STEP 2 — ADD CODE

// ACME_FILTER_HANDLER_V2 (DO NOT DUPLICATE)
(function() {

    const input = document.getElementById('acme-search');
    const statusFilter = document.getElementById('acme-filter-status');
    const dateFilter = document.getElementById('acme-filter-date');
    const table = document.getElementById('acme-leads-table');
    const emptyMsg = document.getElementById('acme-search-empty');

    if (!table) return;

    if (table.dataset.filterBound === "true") return;
    table.dataset.filterBound = "true";

    function applyFilters() {

        const searchVal = input ? input.value.trim().toLowerCase() : "";
        const statusVal = statusFilter ? statusFilter.value.toLowerCase() : "";
        const dateVal = dateFilter ? dateFilter.value : "";

        const tbody = table.querySelector('tbody');
        if (!tbody) return;

        const rows = tbody.querySelectorAll('tr');

        let visible = 0;

        rows.forEach(row => {

            if (row.children.length === 1) return;

            const text = row.innerText.toLowerCase();

            let show = true;

            if (searchVal && !text.includes(searchVal)) {
                show = false;
            }

            if (statusVal && !text.includes(statusVal)) {
                show = false;
            }

            if (dateVal && !text.includes(dateVal)) {
                show = false;
            }

            row.style.display = show ? '' : 'none';

            if (show) visible++;

        });

        if (emptyMsg) {
            emptyMsg.style.display = visible === 0 ? 'block' : 'none';
        }

    }

    if (input) {
        input.addEventListener('input', applyFilters);
    }

    if (statusFilter) {
        statusFilter.addEventListener('change', applyFilters);
    }

    if (dateFilter) {
        dateFilter.addEventListener('change', applyFilters);
    }

})();

--------------------------------------------

STRICT_SCOPE

✔ ADD only  
✔ DO NOT modify existing handlers  

--------------------------------------------

SUCCESS_CRITERIA

✔ search + filter work together  
✔ no conflict  
✔ correct results  
✔ no JS error  

--------------------------------------------

FAIL_CONDITIONS

❌ mismatch filtering  
❌ duplicate events  
❌ UI break  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  

UPDATE system files  

VERIFY consistency  

# ============================================