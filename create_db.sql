
# Utilisateur externe
CREATE OR REPLACE USER ruedespotiersadm@'%' IDENTIFIED BY 'ladminderuedespotiersadm';

# Utilisateur local
CREATE OR REPLACE USER ruedespotiersadm@'localhost' IDENTIFIED BY 'ladminderuedespotiersadm';

CREATE OR REPLACE DATABASE ruedespotiers;
USE ruedespotiers;

GRANT ALL PRIVILEGES
ON ruedespotiers.*
TO 'ruedespotiersadm'@'%'
WITH GRANT OPTION;

GRANT ALL PRIVILEGES
ON ruedespotiers.*
TO 'ruedespotiersadm'@'localhost'
WITH GRANT OPTION;


CREATE OR REPLACE TABLE admins (username VARCHAR(50), password VARCHAR(50));
INSERT INTO admins VALUES ('admin', 'admin3il');