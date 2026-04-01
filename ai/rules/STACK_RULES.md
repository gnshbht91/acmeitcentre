# 🧱 STACK RULES — WORDPRESS STRICT ENGINEERING SYSTEM (FINAL V3)

SYSTEM TYPE: WORDPRESS-NATIVE ONLY
ENFORCEMENT LEVEL: ABSOLUTE
AUTHORITY: BELOW MASTER_RULES.md

---

# 🔒 STACK LOCK (CRITICAL)

ALLOWED STACK:

* WordPress Core
* PHP (WordPress compatible)
* MySQL (WordPress DB only)

YOU MUST NOT USE:

* Node.js
* React
* Next.js
* Express
* Any external backend
* Any non-WordPress system

IF VIOLATION:

→ STOP

---

# 🧠 WORDPRESS EXECUTION LAW

YOU MUST:

* Use WordPress APIs FIRST

YOU MUST NOT:

* Write generic PHP when WP function exists
* Bypass WordPress APIs

IF UNSURE:

→ STOP

---

# 🧱 DATA ACCESS LAYER LAW (CRITICAL)

YOU MUST:

* Use centralized DAL (Data Access Layer)

RULES:

* ALL DB queries MUST be inside plugin DAL
* Theme MUST NOT run queries
* Theme MUST ONLY call DAL functions

EXAMPLES:

* acme_get_courses()
* acme_get_course($id)

YOU MUST NOT:

* Query DB inside theme
* Write direct queries in templates

IF VIOLATION:

→ STOP

---

# 🗄️ DATABASE CONTROL LAW (CRITICAL)

YOU MUST:

* Use WordPress DB methods
* Use $wpdb ONLY when required

YOU MUST:

* Use prepare() with $wpdb

YOU MUST NOT:

* Write raw SQL
* Concatenate queries

IF VIOLATION:

→ STOP

---

# 🧠 DATA STRUCTURE LAW (CRITICAL)

USE:

* CPT → structured content
* post_meta → small fields
* wp_options → global settings

USE CUSTOM TABLE ONLY IF:

* High volume data
* Logging / CRM / analytics

YOU MUST NOT:

* Store structured data randomly
* Abuse wp_options

IF UNSURE:

→ STOP

---

# 🔗 HOOK SYSTEM LAW

YOU MUST:

* Use WordPress hooks

YOU MUST NOT:

* Execute logic outside lifecycle

IF VIOLATION:

→ STOP

---

# 🎨 THEME vs PLUGIN BOUNDARY (CRITICAL)

THEME:

* UI only
* Templates
* Layout

PLUGIN:

* Logic
* Data
* Forms
* APIs

YOU MUST NOT:

* Put logic in theme
* Put UI in plugin (except minimal markup)

---

# 📁 FILE LOCATION CONTROL (CRITICAL)

PLUGIN:

* wp-content/plugins/acme-core/

THEME:

* wp-content/themes/acme/

YOU MUST:

* Place files in correct directory

YOU MUST NOT:

* Create random folders
* Mix plugin & theme code

IF VIOLATION:

→ STOP

---

# 🎯 ASSET OWNERSHIP LAW

PLUGIN:

* JS (logic, AJAX, validation)

THEME:

* CSS (design, layout)

YOU MUST NOT:

* Put business JS in theme
* Put styling in plugin

---

# 📦 ENQUEUE SYSTEM LAW

YOU MUST:

* Use wp_enqueue_style()
* Use wp_enqueue_script()

YOU MUST NOT:

* Hardcode assets
* Use inline scripts

---

# 🚫 NO CUSTOM FRAMEWORK LAW

YOU MUST NOT:

* Build custom architecture
* Replace WordPress

---

# 🔌 DEPENDENCY CONTROL LAW

YOU MUST NOT:

* Use external libraries
* Add frameworks

---

# 🌐 AJAX / REST CONTROL LAW

YOU MUST NOT:

* Create AJAX / REST endpoints without task instruction

YOU MUST:

* Secure endpoints (nonce + permission)

---

# 🔄 DATABASE MIGRATION LAW

YOU MUST:

* Use dbDelta()
* Maintain DB version

YOU MUST NOT:

* Modify DB blindly

---

# ⚙️ PERFORMANCE LAW

YOU MUST:

* Optimize queries
* Use caching when needed

YOU MUST NOT:

* Repeat queries
* Load unnecessary assets

---

# 🧩 OPTIONS TABLE SAFETY

YOU MUST:

* Use wp_options only for small data

YOU MUST NOT:

* Store large datasets

---

# 🛑 PARTIAL EXECUTION BLOCK

YOU MUST:

* Complete implementation fully

YOU MUST NOT:

* Leave partial integration

IF FAIL:

→ STOP

---

# 🧠 COMPATIBILITY LAW

CODE MUST:

* Work with WP latest version
* Not break ecosystem

YOU MUST NOT:

* Modify core

---

# 🚨 FAILURE PROTOCOL

STOP IF:

* Non-WP stack detected
* Raw SQL detected
* Wrong architecture
* DAL violation
* File misplacement
* Unauthorized endpoint

DO NOT:

* GUESS
* RETRY
* WORKAROUND

REPORT AND STOP

---

# 🔚 END OF STACK RULES
