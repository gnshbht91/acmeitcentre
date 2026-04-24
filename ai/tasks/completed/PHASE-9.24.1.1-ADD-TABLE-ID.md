# ============================================
# TASK: PHASE-9.24.1.1-ADD-TABLE-ID.md
# ============================================

GOAL:
Add unique ID to CRM leads table for safe JS targeting.

FILES:
ONLY:
- /wp-content/plugins/acme-core/acme-core.php

--------------------------------------------

EDIT_LOCATION

Search:

<table class="widefat fixed striped">

--------------------------------------------

REPLACE WITH:

<table id="acme-leads-table" class="widefat fixed striped">

--------------------------------------------

STRICT_SCOPE

✔ ONLY this line modify  
✔ DO NOT change anything else  

--------------------------------------------

SUCCESS_CRITERIA

✔ table has ID  
✔ no UI break  

--------------------------------------------