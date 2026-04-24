# ============================================
# TASK: PHASE-9.24.2.1-FILTER-SYSTEM-V3.md
# ============================================

GOAL:
Create single dominant filtering engine (V3) and safely neutralize previous handlers.

FILES:
ONLY:
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

PRECONDITION_CHECK

✔ table exists (#acme-leads-table)
✔ at least 5 columns exist

IF FAIL:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search:
ACME_FILTER_ENGINE_V3

IF FOUND:
→ STOP

--------------------------------------------

STRICT_SCOPE

✔ ADD only  
✔ DO NOT delete code  

--------------------------------------------

STEP 1 — OPEN FILE

admin.js

---

STEP 2 — SCROLL TO END

---

STEP 3 — ADD CODE

// ACME_FILTER_ENGINE_V3 (DO NOT DUPLICATE)
(function() {

    const table = document.getElementById('acme-leads-table');
    if (!table) return;

    // disable old handlers
    const searchInput = document.getElementById('acme-search');
    const statusFilter = document.getElementById('acme-filter-status');
    const dateFilter = document.getElementById('acme-filter-date');
    const emptyMsg = document.getElementById('acme-search-empty');

    if (searchInput) searchInput.oninput = null;
    if (statusFilter) statusFilter.onchange = null;
    if (dateFilter) dateFilter.onchange = null;

    // prevent duplicate binding
    if (table.dataset.v3Bound === "true") return;
    table.dataset.v3Bound = "true";

    let timer;

    function applyFilters() {

        const searchVal = searchInput ? searchInput.value.trim().toLowerCase() : "";
        const statusVal = statusFilter ? statusFilter.value.toLowerCase() : "";
        const dateVal = dateFilter ? dateFilter.value : "";

        const tbody = table.querySelector('tbody');
        if (!tbody) return;

        const rows = tbody.querySelectorAll('tr');

        let visible = 0;

        rows.forEach(row => {

            if (row.children.length < 5) return;

            const cells = row.children;

            const nameText = cells[1]?.innerText.toLowerCase() || "";
            const emailText = cells[2]?.innerText.toLowerCase() || "";
            const statusText = cells[3]?.innerText.toLowerCase() || "";
            const dateText = cells[4]?.innerText || "";

            let show = true;

            if (searchVal && !(nameText.includes(searchVal) || emailText.includes(searchVal))) {
                show = false;
            }

            if (statusVal && !statusText.includes(statusVal)) {
                show = false;
            }

            if (dateVal && !dateText.includes(dateVal)) {
                show = false;
            }

            row.style.display = show ? '' : 'none';

            if (show) visible++;

        });

        if (emptyMsg) {
            emptyMsg.style.display = visible === 0 ? 'block' : 'none';
        }

    }

    function triggerFilter() {
        clearTimeout(timer);
        timer = setTimeout(applyFilters, 200);
    }

    if (searchInput) searchInput.addEventListener('input', triggerFilter);
    if (statusFilter) statusFilter.addEventListener('change', triggerFilter);
    if (dateFilter) dateFilter.addEventListener('change', triggerFilter);

})();

--------------------------------------------

KEY IMPROVEMENTS

✔ old handlers neutralized  
✔ column validation  
✔ dominant engine  
✔ safer row detection  

--------------------------------------------

SUCCESS_CRITERIA

✔ only V3 active  
✔ correct filtering  
✔ no duplicate events  
✔ no console error  

--------------------------------------------

FAIL_CONDITIONS

❌ multiple engines active  
❌ wrong filtering  
❌ UI break  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  
UPDATE system files  
VERIFY consistency  

# ============================================