# ============================================
# TASK: PHASE-9.24.3-EXPORT-CSV.md
# ============================================

GOAL:
Export visible filtered CRM leads with header into structured CSV.

FILES:
ONLY:
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

PRECONDITION_CHECK

✔ table exists (#acme-leads-table)
✔ tbody exists
✔ filter system active

IF FAIL:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search:
ACME_EXPORT_CSV_V2

IF FOUND:
→ STOP

--------------------------------------------

PART 1 — UI

OPEN:
acme-core.php

SEARCH:
acme-filter-date

ADD BELOW:

<button id="acme-export-csv">Export CSV</button>

--------------------------------------------

PART 2 — JS

OPEN:
admin.js

SCROLL TO END

ADD:

// ACME_EXPORT_CSV_V2 (DO NOT DUPLICATE)
(function() {

    const btn = document.getElementById('acme-export-csv');
    const table = document.getElementById('acme-leads-table');

    if (!btn || !table) return;

    if (btn.dataset.bound === "true") return;
    btn.dataset.bound = "true";

    btn.addEventListener('click', function() {

        const thead = table.querySelector('thead');
        const tbody = table.querySelector('tbody');

        if (!thead || !tbody) return;

        let csv = [];

        // HEADER
        const headers = thead.querySelectorAll('th');
        let headerRow = [];

        headers.forEach(th => {
            headerRow.push('"' + th.innerText.replace(/"/g, '""') + '"');
        });

        csv.push(headerRow.join(','));

        // ROWS
        const rows = tbody.querySelectorAll('tr');

        rows.forEach(row => {

            if (row.dataset.v3Visible === "0") return;

            const cols = row.querySelectorAll('td');
            if (!cols.length) return;

            let rowData = [];

            cols.forEach(col => {
                rowData.push('"' + col.innerText.replace(/"/g, '""') + '"');
            });

            csv.push(rowData.join(','));

        });

        if (csv.length <= 1) {
            alert('No data to export');
            return;
        }

        const today = new Date().toISOString().split('T')[0];

        const blob = new Blob([csv.join("\n")], { type: 'text/csv' });
        const url = URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.href = url;
        a.download = `leads-${today}.csv`;

        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);

        URL.revokeObjectURL(url);

    });

})();

--------------------------------------------

SUCCESS_CRITERIA

✔ header included  
✔ only visible rows  
✔ correct CSV  
✔ no error  

--------------------------------------------

FAIL_CONDITIONS

❌ missing header  
❌ wrong rows  
❌ duplicate event  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  
UPDATE system files  

# ============================================