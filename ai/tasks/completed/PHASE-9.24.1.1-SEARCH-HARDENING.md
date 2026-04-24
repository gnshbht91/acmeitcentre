# ============================================
# TASK: PHASE-9.24.1.1-SEARCH-HARDENING.md
# ============================================

GOAL:
Safely upgrade search logic with debounce and empty state without breaking existing JS.

FILES:
ONLY:
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

PRECONDITION_CHECK

✔ search input exists (id="acme-search")
✔ CRM table exists (#acme-leads-table)

IF ANY FAIL:
→ STOP

--------------------------------------------

PART 1 — UI (SAFE ADD)

OPEN:
acme-core.php

SEARCH:
id="acme-search"

---

DUPLICATION CHECK:

Search:
acme-search-empty

IF FOUND:
→ SKIP INSERT

---

INSERT BELOW INPUT:

<p id="acme-search-empty" style="display:none;">No results found</p>

--------------------------------------------

PART 2 — JS (SAFE REPLACE)

OPEN:
admin.js

---

STEP 1 — IDENTIFY OLD BLOCK

Search:

document.getElementById('acme-search')

---

STEP 2 — VERIFY BLOCK STRUCTURE

Ensure it contains:

addEventListener('keyup'

IF NOT FOUND:
→ SKIP DELETE (DO NOT TOUCH)

---

STEP 3 — DELETE ONLY THIS BLOCK

FROM:

const searchInput = document.getElementById('acme-search');

TO:

closing bracket of event handler

(ONLY this section)

---

STEP 4 — VARIABLE SAFETY

Search:

acmeSearchTimer

IF FOUND:
→ RENAME NEW VARIABLE TO:
acmeSearchTimer2

ELSE:
→ use acmeSearchTimer

---

STEP 5 — ADD NEW CODE AT END

ADD:

let acmeSearchTimer;

const searchInput = document.getElementById('acme-search');
const emptyMsg = document.getElementById('acme-search-empty');

if (searchInput) {

    searchInput.addEventListener('keyup', function() {

        clearTimeout(acmeSearchTimer);

        acmeSearchTimer = setTimeout(() => {

            const value = this.value.toLowerCase();

            const table = document.querySelector('#acme-leads-table');
            if (!table) return;

            const rows = table.querySelectorAll('tbody tr');

            let visibleCount = 0;

            rows.forEach(row => {

                const text = row.innerText.toLowerCase();

                if (text.includes(value)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }

            });

            if (emptyMsg) {
                emptyMsg.style.display = visibleCount === 0 ? 'block' : 'none';
            }

        }, 200);

    });

}

--------------------------------------------

STRICT_SCOPE

✔ ONLY search logic replace  
✔ ONLY UI add  

YOU MUST NOT:

❌ modify other JS  
❌ modify backend  

--------------------------------------------

SUCCESS_CRITERIA

✔ search smooth  
✔ no duplicate events  
✔ empty message works  
✔ no JS error  

--------------------------------------------

FAIL_CONDITIONS

❌ JS breaks  
❌ wrong deletion  
❌ duplicate handler  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  

UPDATE:
- TASK_BOARD.md  
- PROJECT_STATE.md  
- DEV_LOG.md  

VERIFY consistency  

# ============================================