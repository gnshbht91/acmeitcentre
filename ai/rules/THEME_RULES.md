# 🎨 THEME RULES — UI LAYER CONTROL SYSTEM (FINAL V6)

SYSTEM TYPE: PRESENTATION LAYER ONLY
ENFORCEMENT LEVEL: ABSOLUTE
AUTHORITY: BELOW MASTER_RULES.md

---

# 🔒 THEME IDENTITY LOCK

THEME NAME:

* acme

YOU MUST NOT:

* Create new theme
* Rename theme

ALL UI MUST LIVE IN:

wp-content/themes/acme/

---

# 🎯 THEME RESPONSIBILITY

THEME HANDLES:

* UI rendering
* Templates
* Layout
* Styling (CSS)

YOU MUST NOT:

* Handle business logic
* Handle DB queries
* Handle form processing
* Handle API logic

---

# 🧱 STRICT BOUNDARY LAW (CRITICAL)

THEME:

→ DISPLAY ONLY

PLUGIN:

→ LOGIC ONLY

YOU MUST:

* Call plugin functions

YOU MUST NOT:

* Write logic in theme

---

# 🔗 PLUGIN INTEGRATION LAW

THEME MUST:

* Use plugin functions (acme_*)

YOU MUST NOT:

* Access DB directly
* Bypass plugin

---

# 📦 DATA CONTRACT LAW (CRITICAL)

THEME MUST:

* Expect structured data

RULE:

* Data must be array/object
* No raw DB structure

YOU MUST NOT:

* Transform data heavily

IF DATA INVALID:

→ STOP RENDER

---

# 📁 TEMPLATE STRUCTURE LAW

YOU MUST:

* Follow WordPress template hierarchy

STANDARD FILES:

* index.php
* single.php
* archive.php
* page.php

NAMING:

* lowercase
* hyphen-separated

---

# 🧩 TEMPLATE PART STANDARD

YOU MUST:

* Use get_template_part()

FORMAT:

template-parts/{type}/{name}.php

EXAMPLE:

template-parts/course/card.php

YOU MUST NOT:

* Scatter reusable UI

---

# 🧠 TEMPLATE LOGIC CONTROL (CRITICAL)

ALLOWED:

* if/else (display logic only)
* foreach (render data)

YOU MUST NOT:

* Write business rules
* Perform calculations
* Process data

---

# 🔁 LOOP CONTROL LAW

YOU MUST:

* Use WP loop ONLY

YOU MUST NOT:

* Write custom WP_Query in theme
* Run DB queries

DATA MUST COME FROM PLUGIN

---

# 🎨 STYLING LAW

THEME OWNS:

* CSS
* Layout

YOU MUST NOT:

* Put styling in plugin

---

# 🎯 JS RESPONSIBILITY SPLIT

THEME JS:

* UI interaction (toggle, animation)

PLUGIN JS:

* Business logic
* AJAX

YOU MUST NOT:

* Put business JS in theme

---

# 📦 ASSET LOADING LAW

YOU MUST:

* Use wp_enqueue_*

YOU MUST NOT:

* Hardcode assets

---

# 🔄 DATA FLOW LAW

FLOW:

PLUGIN → THEME

YOU MUST NOT:

THEME → DB

---

# 🔐 SECURITY ENFORCEMENT

YOU MUST:

* Escape ALL output

---

# 📁 FILE STRUCTURE LAW

acme/
├── style.css
├── functions.php
├── template-parts/
├── assets/

---

# 🔌 FUNCTIONS.PHP CONTROL

YOU MUST:

* Setup theme
* Enqueue assets

YOU MUST NOT:

* Add business logic

---

# ⚠️ FALLBACK UI LAW

YOU MUST:

* Handle empty data

EXAMPLE:

* "No courses found"

YOU MUST NOT:

* Break UI

---

# 🔄 SIDE EFFECT CONTROL

YOU MUST:

* Avoid layout break

---

# 🧪 RESPONSIVENESS LAW

YOU MUST:

* Ensure mobile UI

---

# ⚙️ PERFORMANCE LAW

YOU MUST:

* Load minimal assets

---

# 🧠 ACCESSIBILITY LAW

YOU MUST:

* Use semantic HTML

---

# 🔁 REFACTOR CONTROL

YOU MUST NOT:

* Change structure unnecessarily

---

# 🛑 PARTIAL IMPLEMENTATION BLOCK

YOU MUST:

* Complete UI

YOU MUST NOT:

* Leave broken UI

---

# 🔗 HOOK USAGE LAW

YOU MUST:

* Use wp_head()
* Use wp_footer()

---

# 🚨 FAILURE CONDITIONS

STOP IF:

* Logic in theme
* DB query in theme
* Missing escape
* Asset misuse
* Broken UI

---

# 🔐 FAIL-SAFE

IF ANY DOUBT:

→ STOP

---

# 🚨 FINAL LAW

THEME = UI ONLY

NO LOGIC
NO DATA PROCESSING
NO DB

---

# 🔚 END OF THEME RULES
