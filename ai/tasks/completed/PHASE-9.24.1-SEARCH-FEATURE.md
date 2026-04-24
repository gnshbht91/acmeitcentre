# ============================================
# TASK: PHASE-9.24.1-SEARCH-FEATURE.md
# ============================================

GOAL:
Add search input to filter CRM leads table by name/email without affecting other tables.

FILES:
ONLY:
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

PRECONDITION_CHECK

YOU MUST VERIFY:

✔ CRM table exists  
✔ table contains lead rows  
✔ admin.js is loaded  

IF ANY FAIL:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search:

id="acme-search"

IF FOUND:
→ STOP

--------------------------------------------

PART 1 — UI INSERTION

OPEN:
acme-core.php

---

FIND EXACT ANCHOR:

id="acme-bulk-delete-btn"

---

INSERT BELOW THIS BUTTON:

<input type="text" id="acme-search" placeholder="Search by name or email">

---

STRICT RULES:

✔ DO NOT use <table anchor  
✔ DO NOT insert randomly  
✔ ONLY insert near bulk actions  

--------------------------------------------

PART 2 — JS LOGIC

OPEN:
admin.js

---

DUPLICATION CHECK:

Search:

acme-search

IF event exists:
→ STOP

---

ADD AT END OF FILE:

const searchInput = document.getElementById('acme-search');

if (searchInput) {

    searchInput.addEventListener('keyup', function() {

        const value = this.value.toLowerCase();

        const table = document.querySelector('#acme-leads-table');

        if (!table) return;

        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {

            const text = row.innerText.toLowerCase();

            row.style.display = text.includes(value) ? '' : 'none';

        });

    });

}

---

IMPORTANT:

✔ MUST use #acme-leads-table  
✔ DO NOT use generic 'table' selector  

IF TABLE ID NOT FOUND:
→ STOP

--------------------------------------------

STRICT_SCOPE

YOU MUST:

✔ Add input  
✔ Add JS  

YOU MUST NOT:

❌ Modify table  
❌ Modify backend  
❌ Modify existing JS  

--------------------------------------------

SUCCESS_CRITERIA

✔ search input visible  
✔ typing filters only CRM table  
✔ no other table affected  
✔ no JS error  

--------------------------------------------

FAIL_CONDITIONS

❌ wrong table filtered  
❌ multiple JS events  
❌ input not working  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  

UPDATE:
- TASK_BOARD.md  
- PROJECT_STATE.md  
- DEV_LOG.md  

VERIFY consistency  

# ============================================