# 🔐 SECURITY RULES — ZERO TRUST SYSTEM (FINAL V4)

SYSTEM TYPE: ZERO TRUST SECURITY
ENFORCEMENT LEVEL: ABSOLUTE
AUTHORITY: BELOW MASTER_RULES.md

---

# 🔒 ZERO TRUST LAW (NON-NEGOTIABLE)

ASSUME:

* ALL INPUT IS MALICIOUS
* ALL DATA IS UNTRUSTED

DEFAULT BEHAVIOR:

→ DENY UNLESS EXPLICITLY ALLOWED

---

# 🧼 INPUT SANITIZATION LAW (CRITICAL)

ALL INPUT MUST BE SANITIZED

YOU MUST:

* Sanitize EVERY field
* Allow ONLY expected fields

YOU MUST NOT:

* Accept unknown input fields
* Use raw $_POST / $_GET

IF INVALID FIELD FOUND:

→ STOP

---

# 🧾 INPUT SOURCE VALIDATION

YOU MUST:

* Validate request source
* Validate request structure

RULE:

* Expected fields ONLY
* Reject extra parameters

---

# 🛡️ OUTPUT ESCAPING LAW (CRITICAL)

ALL OUTPUT MUST BE ESCAPED

USE:

* esc_html()
* esc_attr()
* esc_url()

YOU MUST NOT:

* Output raw data

---

# 🔑 NONCE + REQUEST VALIDATION (CRITICAL)

ALL REQUESTS MUST:

* Use nonce
* Verify nonce
* Validate request method

YOU MUST:

* Reject reused / invalid nonce

YOU MUST NOT:

* Process without nonce

---

# 🔁 CSRF PROTECTION (ADVANCED)

YOU MUST:

* Protect POST AND GET requests

YOU MUST NOT:

* Trust GET requests

---

# 👤 PERMISSION CONTROL LAW (CRITICAL)

YOU MUST:

* Check user capability

RULE:

* Match action with role

EXAMPLES:

* Admin → manage_options
* Staff → limited access

YOU MUST NOT:

* Allow privilege escalation

---

# 🧱 ADMIN vs PUBLIC ISOLATION

YOU MUST:

* Separate admin actions
* Separate public actions

YOU MUST NOT:

* Allow public access to admin logic

---

# 🗄️ DATABASE SECURITY LAW

YOU MUST:

* Use WordPress DB methods
* Use $wpdb->prepare()

YOU MUST NOT:

* Use raw SQL
* Concatenate queries

---

# 📁 FILE ACCESS PROTECTION

ALL PHP FILES MUST:

if (!defined('ABSPATH')) exit;

---

# 📤 DATA VALIDATION LAW

YOU MUST:

* Validate format
* Validate required fields

YOU MUST NOT:

* Accept invalid data

---

# 📂 FILE UPLOAD SECURITY (CRITICAL)

YOU MUST:

* Validate MIME
* Restrict types
* Use WP upload API

YOU MUST NOT:

* Allow executable files

---

# 🌐 URL & REDIRECT SECURITY

YOU MUST:

* Use wp_safe_redirect()
* Validate URLs

---

# 🌐 AJAX / REST SECURITY

YOU MUST:

* Verify nonce
* Validate input
* Check permissions

YOU MUST NOT:

* Expose open endpoints

---

# 📡 RESPONSE HARDENING

YOU MUST:

* Return safe responses
* Use wp_send_json_success/error

YOU MUST NOT:

* Expose debug info
* Return raw errors

---

# 🔐 DATA EXPOSURE CONTROL

YOU MUST NOT:

* Leak system paths
* Leak sensitive data

---

# ⚠️ ERROR HANDLING SECURITY

YOU MUST:

* Show generic errors

YOU MUST NOT:

* Reveal internal structure

---

# 🍪 COOKIE & SESSION SAFETY

YOU MUST:

* Avoid sensitive storage

---

# 🔥 RATE LIMIT LAW (CRITICAL)

YOU MUST:

* Apply rate limits per action

EXAMPLES:

* Form → 5/min
* Login → stricter
* AJAX → controlled

---

# 🧾 LOGGING SECURITY

YOU MUST:

* Avoid sensitive logs

---

# 🧠 GDPR & PRIVACY LAW

YOU MUST:

* Support export
* Support erase

---

# 🧱 DAL SECURITY ENFORCEMENT

YOU MUST:

* Use DAL for DB access

YOU MUST NOT:

* Access DB from theme

---

# 🛑 FAIL-SAFE DEFAULT

IF ANY SECURITY CHECK FAILS:

→ DENY ACTION
→ STOP EXECUTION

---

# 🛑 PARTIAL EXECUTION BLOCK

YOU MUST:

* Apply ALL security layers

IF ANY MISSING:

→ STOP

---

# 🚨 FAILURE PROTOCOL (ABSOLUTE)

STOP IF:

* Sanitization missing
* Escaping missing
* Nonce missing
* Permission missing
* Unsafe SQL
* Open endpoint
* Data leak risk

DO NOT:

* GUESS
* RETRY
* WORKAROUND

REPORT AND STOP

---

# 🔚 END OF SECURITY RULES
