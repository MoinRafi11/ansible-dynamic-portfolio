\c portfolio

-- =========================================================
-- PROJECTS TABLE
-- =========================================================

CREATE TABLE IF NOT EXISTS projects (
    id SERIAL PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    technologies VARCHAR(500),
    github_url VARCHAR(300),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Give application user access
GRANT ALL PRIVILEGES ON TABLE projects TO code;
GRANT USAGE, SELECT ON SEQUENCE projects_id_seq TO code;


-- =========================================================
-- RESET PROJECT DATA
-- =========================================================

TRUNCATE TABLE projects RESTART IDENTITY;


-- =========================================================
-- PORTFOLIO PROJECTS
-- =========================================================

INSERT INTO projects
(title, description, technologies, github_url)
VALUES

(
    'Ansible Automation Lab',
    'Automated Linux server configuration and management using Ansible.',
    'Linux,Ansible,SSH,Automation',
    'https://github.com/MoinRafi11'
),

(
    'Linux Practical Lab',
    'Hands-on Linux administration covering users, permissions, services, networking and server management.',
    'Linux,Bash,SSH,Networking',
    'https://github.com/MoinRafi11'
),

(
    'Static Apache Portfolio',
    'Deployed a portfolio website on Apache HTTP Server running on Ubuntu Linux.',
    'Ubuntu,Apache,HTML,CSS,Linux',
    'https://github.com/MoinRafi11'
),

(
    'DevOps Automation',
    'Practical automation workflows focused on repeatable deployments and reducing manual infrastructure tasks.',
    'DevOps,Automation,Git,Bash',
    'https://github.com/MoinRafi11'
);