<?php

// =========================================================
// DATABASE
// =========================================================
// The database and table match init.sql:
//   database: portfolio
//   table:    projects
//
// For production, move the password to an environment variable.
// =========================================================

$dbHost = "localhost";
$dbName = "portfolio";
$dbUser = "postgres";
$dbPass = "moin@135";

$conn = pg_connect(
    "host={$dbHost} dbname={$dbName} user={$dbUser} password={$dbPass}"
);

if (!$conn) {
    die("Database connection failed.");
}

// Load projects dynamically from PostgreSQL.
$projectQuery = "
    SELECT id, title, description, technologies, github_url
    FROM projects
    ORDER BY id DESC
";

$projectResult = pg_query($conn, $projectQuery);

if (!$projectResult) {
    die("Projects query failed: " . pg_last_error($conn));
}



while ($row = pg_fetch_assoc($projectResult)) {
    $projects[] = [
        "id" => $row["id"],
        "title" => $row["title"],
        "description" => $row["description"],
        "tags" => !empty($row["technologies"])
            ? array_map("trim", explode(",", $row["technologies"]))
            : [],
        "github" => $row["github_url"]
    ];
}

/*
|--------------------------------------------------------------------------
| MOIN RAFI - DEVOPS PORTFOLIO
|--------------------------------------------------------------------------
| Single-file dynamic portfolio
| Stack: PHP + HTML + CSS + JavaScript
|--------------------------------------------------------------------------
*/

// =========================
// PERSONAL INFORMATION
// =========================

$name = "Moin Rafi";
$role = "DevOps Engineer";
$location = "India";

$bio = "DevOps-focused engineer passionate about Linux, automation, infrastructure, CI/CD and building reliable deployment workflows.";

$github = "https://github.com/MoinRafi11";
$linkedin = "https://www.linkedin.com/in/moin-rafi-0eleven";
$email = "moinrafi1011@gmail.com";

// =========================
// EXPERIENCE
// =========================

$experience = [
    [
        "company" => "VervanTech",
        "role" => "DevOps / Infrastructure",
        "period" => "Professional Experience",
        "description" => "Worked with Linux-based infrastructure, automation, web deployment and DevOps workflows. Built and maintained practical infrastructure projects while improving deployment and operational processes."
    ]
];

// =========================
// SKILLS
// =========================

$skills = [
    ["name" => "Linux", "icon" => "⌘", "level" => 90],
    ["name" => "Git & GitHub", "icon" => "◉", "level" => 88],
    ["name" => "Bash", "icon" => "$_", "level" => 82],
    ["name" => "Apache", "icon" => "◆", "level" => 85],
    ["name" => "CI/CD", "icon" => "↯", "level" => 78],
    ["name" => "Docker", "icon" => "⬡", "level" => 72],
    ["name" => "AWS", "icon" => "☁", "level" => 68],
    ["name" => "PostgreSQL", "icon" => "◇", "level" => 78],
    ["name" => "Networking", "icon" => "⌁", "level" => 80],
    ["name" => "VMware", "icon" => "▣", "level" => 75]
];

// =========================
// PROJECTS
// =========================

$projects = [
    [
        "title" => "Automated Portfolio",
        "description" => "A dynamically deployed portfolio application using PHP and Apache on Ubuntu Linux. Includes automated project content and web-server based deployment.",
        "tags" => ["PHP", "Apache", "Linux", "Automation"],
        "github" => "#"
    ],
    [
        "title" => "Linux Practical Lab",
        "description" => "Hands-on Linux administration lab covering users, permissions, services, networking, packages, SSH and server management.",
        "tags" => ["Linux", "Bash", "SSH", "Administration"],
        "github" => "#"
    ],
    [
        "title" => "Static Apache Deployment",
        "description" => "Deployed and configured a web application on Apache HTTP Server with Linux-based server configuration and troubleshooting.",
        "tags" => ["Apache", "Ubuntu", "HTML", "Linux"],
        "github" => "#"
    ],
    [
        "title" => "DevOps Automation",
        "description" => "Practical automation workflows designed around repeatable deployments, infrastructure operations and reducing manual tasks.",
        "tags" => ["DevOps", "Automation", "Git", "Bash"],
        "github" => "#"
    ]
];

// =========================
// CERTIFICATIONS
// =========================

$certifications = [
    [
        "title" => "DevOps / Cloud Certification",
        "issuer" => "Professional Training"
    ],
    [
        "title" => "Linux / System Administration",
        "issuer" => "Technical Training"
    ]
];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="<?= htmlspecialchars($name) ?> - DevOps Engineer Portfolio">

    <title><?= htmlspecialchars($name) ?> | DevOps Engineer</title>

    <style>

        /* =========================================================
           GLOBAL
        ========================================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg: #0b0a09;
            --bg-soft: #11100e;
            --card: #151310;
            --card-hover: #1b1814;

            --warm: #c88a4a;
            --warm-light: #e0a866;
            --warm-dark: #85592e;

            --text: #e8e0d6;
            --muted: #938b81;
            --border: rgba(200, 138, 74, 0.16);

            --green: #829b72;

            --radius: 16px;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            background:
                radial-gradient(
                    circle at 80% 10%,
                    rgba(200, 138, 74, 0.08),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 10% 60%,
                    rgba(200, 138, 74, 0.035),
                    transparent 30%
                ),
                var(--bg);

            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        ::selection {
            background: var(--warm);
            color: #0b0a09;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            width: min(1150px, 90%);
            margin: auto;
        }

        /* =========================================================
           BACKGROUND
        ========================================================= */

        .grid-background {
            position: fixed;
            inset: 0;
            z-index: -2;

            background-image:
                linear-gradient(
                    rgba(255,255,255,0.018) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(255,255,255,0.018) 1px,
                    transparent 1px
                );

            background-size: 45px 45px;

            mask-image:
                linear-gradient(
                    to bottom,
                    black,
                    transparent 90%
                );
        }

        .noise {
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.025;
            z-index: 100;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.5'/%3E%3C/svg%3E");
        }

        /* =========================================================
           NAVBAR
        ========================================================= */

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 50;

            backdrop-filter: blur(16px);
            background: rgba(11, 10, 9, 0.72);
            border-bottom: 1px solid transparent;

            transition: 0.3s ease;
        }

        header.scrolled {
            border-bottom-color: var(--border);
        }

        nav {
            height: 75px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-family: monospace;
            font-size: 19px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .logo span {
            color: var(--warm);
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .nav-links a {
            color: var(--muted);
            font-size: 14px;
            transition: 0.25s;
        }

        .nav-links a:hover {
            color: var(--warm-light);
        }

        .nav-status {
            display: flex;
            align-items: center;
            gap: 8px;

            font-family: monospace;
            font-size: 12px;
            color: var(--muted);
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--green);
            box-shadow: 0 0 12px rgba(130,155,114,.5);
        }

        /* =========================================================
           HERO
        ========================================================= */

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;

            padding-top: 75px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 70px;
            align-items: center;
        }

        .eyebrow {
            font-family: monospace;
            color: var(--warm);
            font-size: 13px;
            margin-bottom: 20px;

            opacity: 0;
            animation: fadeUp .7s .1s forwards;
        }

        .eyebrow::before {
            content: ">";
            margin-right: 8px;
        }

        h1 {
            font-size: clamp(48px, 7vw, 82px);
            line-height: .98;
            letter-spacing: -4px;

            margin-bottom: 25px;

            opacity: 0;
            animation: fadeUp .7s .2s forwards;
        }

        h1 span {
            color: var(--warm-light);
        }

        .hero-description {
            max-width: 570px;
            color: var(--muted);
            font-size: 17px;
            margin-bottom: 32px;

            opacity: 0;
            animation: fadeUp .7s .3s forwards;
        }

        .hero-buttons {
            display: flex;
            gap: 13px;
            flex-wrap: wrap;

            opacity: 0;
            animation: fadeUp .7s .4s forwards;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 8px;

            font-size: 14px;
            font-weight: 600;

            transition: .25s;
        }

        .btn-primary {
            background: var(--warm);
            color: #11100e;
        }

        .btn-primary:hover {
            background: var(--warm-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(200,138,74,.16);
        }

        .btn-secondary {
            border: 1px solid var(--border);
            color: var(--text);
        }

        .btn-secondary:hover {
            border-color: var(--warm-dark);
            background: rgba(200,138,74,.05);
        }

        /* =========================================================
           TERMINAL
        ========================================================= */

        .terminal {
            background: rgba(16,15,13,.92);
            border: 1px solid var(--border);
            border-radius: var(--radius);

            box-shadow:
                0 30px 80px rgba(0,0,0,.4),
                0 0 80px rgba(200,138,74,.04);

            overflow: hidden;

            transform: perspective(900px) rotateY(-4deg);

            opacity: 0;
            animation: terminalIn 1s .4s forwards;
        }

        .terminal-header {
            height: 43px;
            border-bottom: 1px solid var(--border);

            display: flex;
            align-items: center;
            padding: 0 15px;
            gap: 7px;
        }

        .terminal-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #51483e;
        }

        .terminal-title {
            margin-left: auto;
            margin-right: auto;

            font-family: monospace;
            color: #655e56;
            font-size: 11px;
        }

        .terminal-body {
            padding: 27px;
            min-height: 330px;

            font-family: "Courier New", monospace;
            font-size: 13px;
        }

        .line {
            margin-bottom: 14px;
        }

        .prompt {
            color: var(--warm);
        }

        .command {
            color: #d8d0c5;
        }

        .output {
            color: #777067;
            padding-left: 20px;
        }

        .success {
            color: var(--green);
        }

        .cursor {
            display: inline-block;
            width: 7px;
            height: 15px;
            background: var(--warm);
            vertical-align: middle;

            animation: blink 1s infinite;
        }

        /* =========================================================
           SECTIONS
        ========================================================= */

        section {
            padding: 110px 0;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: end;

            margin-bottom: 50px;
        }

        .section-label {
            font-family: monospace;
            font-size: 12px;
            color: var(--warm);
            margin-bottom: 9px;
        }

        .section-heading h2 {
            font-size: clamp(32px, 4vw, 48px);
            letter-spacing: -2px;
            line-height: 1;
        }

        .section-number {
            font-family: monospace;
            color: #403a34;
            font-size: 13px;
        }

        /* =========================================================
           ABOUT
        ========================================================= */

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 70px;
        }

        .about-text {
            color: var(--muted);
            font-size: 16px;
        }

        .about-text p {
            margin-bottom: 18px;
        }

        .about-highlight {
            border-left: 2px solid var(--warm);
            padding-left: 20px;
            color: var(--text);
        }

        .stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .stat {
            background: var(--card);
            border: 1px solid var(--border);
            padding: 25px;
            border-radius: 12px;
            transition: .3s;
        }

        .stat:hover {
            transform: translateY(-5px);
            background: var(--card-hover);
        }

        .stat-number {
            font-size: 30px;
            color: var(--warm-light);
            font-weight: 700;
        }

        .stat-label {
            color: var(--muted);
            font-size: 13px;
        }

        /* =========================================================
           SKILLS
        ========================================================= */

        .skills-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .skill {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;

            transition: .3s;
        }

        .skill:hover {
            transform: translateY(-4px);
            border-color: rgba(200,138,74,.35);
        }

        .skill-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 13px;
        }

        .skill-name {
            display: flex;
            align-items: center;
            gap: 11px;
            font-size: 14px;
            font-weight: 600;
        }

        .skill-icon {
            width: 30px;
            height: 30px;

            display: grid;
            place-items: center;

            background: rgba(200,138,74,.08);
            color: var(--warm-light);

            border-radius: 7px;

            font-family: monospace;
            font-size: 12px;
        }

        .skill-percent {
            color: #655e56;
            font-family: monospace;
            font-size: 11px;
        }

        .skill-bar {
            height: 3px;
            background: #28231e;
            border-radius: 10px;
            overflow: hidden;
        }

        .skill-progress {
            height: 100%;
            width: 0;
            background: linear-gradient(
                90deg,
                var(--warm-dark),
                var(--warm)
            );

            transition: width 1.3s ease;
        }

        /* =========================================================
           EXPERIENCE
        ========================================================= */

        .timeline {
            position: relative;
            max-width: 850px;
        }

        .timeline::before {
            content: "";
            position: absolute;
            left: 8px;
            top: 5px;
            bottom: 0;

            width: 1px;
            background: var(--border);
        }

        .timeline-item {
            position: relative;
            padding-left: 45px;
            margin-bottom: 50px;
        }

        .timeline-dot {
            position: absolute;
            left: 3px;
            top: 6px;

            width: 11px;
            height: 11px;

            border: 2px solid var(--warm);
            border-radius: 50%;
            background: var(--bg);

            box-shadow: 0 0 15px rgba(200,138,74,.3);
        }

        .timeline-period {
            font-family: monospace;
            color: var(--warm);
            font-size: 12px;
            margin-bottom: 8px;
        }

        .timeline-title {
            font-size: 23px;
            margin-bottom: 3px;
        }

        .timeline-company {
            color: var(--muted);
            margin-bottom: 15px;
        }

        .timeline-description {
            max-width: 700px;
            color: var(--muted);
            font-size: 14px;
        }

        /* =========================================================
           PROJECTS
        ========================================================= */

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 17px;
        }

        .project {
            position: relative;
            overflow: hidden;

            background: var(--card);
            border: 1px solid var(--border);

            border-radius: 15px;
            padding: 30px;

            transition:
                transform .35s,
                border-color .35s,
                background .35s;
        }

        .project::after {
            content: "";

            position: absolute;
            width: 180px;
            height: 180px;

            right: -100px;
            top: -100px;

            border-radius: 50%;

            background: rgba(200,138,74,.055);

            transition: .4s;
        }

        .project:hover {
            transform: translateY(-7px);
            border-color: rgba(200,138,74,.35);
            background: var(--card-hover);
        }

        .project:hover::after {
            transform: scale(1.5);
        }

        .project-number {
            color: #4c443c;
            font-family: monospace;
            font-size: 11px;
            margin-bottom: 25px;
        }

        .project h3 {
            font-size: 22px;
            margin-bottom: 12px;
        }

        .project p {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 25px;
        }

        .tags {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .tag {
            font-family: monospace;
            font-size: 10px;
            color: #a9937d;

            padding: 5px 8px;

            border: 1px solid rgba(200,138,74,.14);
            border-radius: 5px;

            background: rgba(200,138,74,.04);
        }

        .project-link {
            display: inline-block;
            margin-top: 23px;

            font-family: monospace;
            font-size: 12px;
            color: var(--warm-light);
        }

        /* =========================================================
           CERTIFICATIONS
        ========================================================= */

        .cert-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .cert {
            border: 1px solid var(--border);
            background: var(--card);
            border-radius: 12px;
            padding: 24px;

            display: flex;
            gap: 18px;
            align-items: center;
        }

        .cert-icon {
            min-width: 45px;
            height: 45px;

            display: grid;
            place-items: center;

            border-radius: 10px;

            color: var(--warm-light);
            background: rgba(200,138,74,.07);

            font-family: monospace;
        }

        .cert h3 {
            font-size: 15px;
        }

        .cert p {
            color: var(--muted);
            font-size: 12px;
        }

        /* =========================================================
           CONTACT
        ========================================================= */

        .contact {
            text-align: center;
            padding-bottom: 130px;
        }

        .contact h2 {
            font-size: clamp(38px, 6vw, 70px);
            letter-spacing: -3px;
            margin-bottom: 17px;
        }

        .contact > p {
            max-width: 550px;
            margin: auto;
            color: var(--muted);
        }

        .contact-links {
            margin-top: 30px;

            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .contact-link {
            border: 1px solid var(--border);
            padding: 10px 18px;
            border-radius: 8px;

            font-family: monospace;
            font-size: 12px;

            transition: .25s;
        }

        .contact-link:hover {
            color: var(--warm-light);
            border-color: var(--warm-dark);
            transform: translateY(-3px);
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        footer {
            border-top: 1px solid var(--border);
            padding: 25px 0;

            color: #5f5851;
            font-family: monospace;
            font-size: 11px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        /* =========================================================
           SCROLL REVEAL
        ========================================================= */

        .reveal {
            opacity: 0;
            transform: translateY(25px);
            transition:
                opacity .8s ease,
                transform .8s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* =========================================================
           ANIMATIONS
        ========================================================= */

        @keyframes fadeUp {

            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        @keyframes terminalIn {

            from {
                opacity: 0;
                transform:
                    perspective(900px)
                    rotateY(-10deg)
                    translateX(30px);
            }

            to {
                opacity: 1;
                transform:
                    perspective(900px)
                    rotateY(-4deg)
                    translateX(0);
            }

        }

        @keyframes blink {

            0%, 45% {
                opacity: 1;
            }

            46%, 100% {
                opacity: 0;
            }

        }

        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 850px) {

            .nav-links {
                display: none;
            }

            .nav-status {
                display: none;
            }

            .hero-grid,
            .about-grid {
                grid-template-columns: 1fr;
                gap: 45px;
            }

            .terminal {
                transform: none;
            }

            .projects-grid,
            .cert-grid {
                grid-template-columns: 1fr;
            }

            .skills-grid {
                grid-template-columns: 1fr;
            }

            h1 {
                letter-spacing: -3px;
            }

            section {
                padding: 80px 0;
            }

        }

        @media (max-width: 500px) {

            .container {
                width: 88%;
            }

            .hero {
                min-height: auto;
                padding-top: 140px;
                padding-bottom: 80px;
            }

            h1 {
                font-size: 52px;
            }

            .terminal-body {
                padding: 20px;
                font-size: 11px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .footer-content {
                flex-direction: column;
            }

        }

    </style>

</head>

<body>

<div class="grid-background"></div>
<div class="noise"></div>


<!-- =========================================================
     NAVIGATION
========================================================= -->

<header id="header">

    <div class="container">

        <nav>

            <a href="#home" class="logo">
                moin<span>@</span>devops
            </a>

            <ul class="nav-links">

                <li>
                    <a href="#about">About</a>
                </li>

                <li>
                    <a href="#skills">Skills</a>
                </li>

                <li>
                    <a href="#experience">Experience</a>
                </li>

                <li>
                    <a href="#projects">Projects</a>
                </li>

                <li>
                    <a href="#contact">Contact</a>
                </li>

            </ul>

            <div class="nav-status">
                <span class="status-dot"></span>
                Available for opportunities
            </div>

        </nav>

    </div>

</header>


<!-- =========================================================
     HERO
========================================================= -->

<main>

<section class="hero" id="home">

    <div class="container">

        <div class="hero-grid">

            <div>

                <div class="eyebrow">
                    DevOps / Infrastructure / Automation
                </div>

                <h1>
                    Building<br>
                    <span>reliable</span><br>
                    systems.
                </h1>

                <p class="hero-description">
                    I'm <?= htmlspecialchars($name) ?> — a
                    <?= htmlspecialchars($role) ?> focused on Linux,
                    automation, infrastructure and continuous delivery.
                </p>

                <div class="hero-buttons">

                    <a href="#projects"
                       class="btn btn-primary">
                        View Projects
                    </a>

                    <a href="<?= htmlspecialchars($github) ?>"
                       target="_blank"
                       class="btn btn-secondary">
                        GitHub ↗
                    </a>

                </div>

            </div>


            <!-- TERMINAL -->

            <div class="terminal">

                <div class="terminal-header">

                    <span class="terminal-dot"></span>
                    <span class="terminal-dot"></span>
                    <span class="terminal-dot"></span>

                    <span class="terminal-title">
                        moin@devops: ~
                    </span>

                </div>

                <div class="terminal-body">

                    <div class="line">
                        <span class="prompt">moin@devops:~$</span>
                        <span class="command"> whoami</span>
                    </div>

                    <div class="line output">
                        <?= htmlspecialchars($name) ?>
                    </div>

                    <div class="line">
                        <span class="prompt">moin@devops:~$</span>
                        <span class="command"> cat role.txt</span>
                    </div>

                    <div class="line output">
                        DevOps Engineer
                    </div>

                    <div class="line">
                        <span class="prompt">moin@devops:~$</span>
                        <span class="command"> ls skills/</span>
                    </div>

                    <div class="line output">
                        linux&nbsp;&nbsp; automation&nbsp;&nbsp;
                        git&nbsp;&nbsp; ci-cd
                    </div>

                    <div class="line output">
                        apache&nbsp;&nbsp; docker&nbsp;&nbsp;
                        cloud&nbsp;&nbsp; postgres
                    </div>

                    <div class="line">
                        <span class="prompt">moin@devops:~$</span>
                        <span class="command"> ./deploy.sh</span>
                    </div>

                    <div class="line success">
                        ✓ Deployment successful
                    </div>

                    <div class="line">
                        <span class="prompt">moin@devops:~$</span>
                        <span class="cursor"></span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     ABOUT
========================================================= -->

<section id="about">

    <div class="container">

        <div class="section-heading reveal">

            <div>
                <div class="section-label">
                    01 / ABOUT
                </div>

                <h2>Behind the terminal.</h2>
            </div>

            <div class="section-number">
                / profile
            </div>

        </div>


        <div class="about-grid reveal">

            <div class="about-text">

                <p class="about-highlight">
                    <?= htmlspecialchars($bio) ?>
                </p>

                <p>
                    My approach to DevOps starts with understanding the
                    fundamentals — Linux systems, networking, version
                    control and server administration — and then building
                    automation around them.
                </p>

                <p>
                    I enjoy turning repetitive infrastructure tasks into
                    reliable, repeatable workflows and continuously
                    improving the way applications are deployed and
                    maintained.
                </p>

            </div>


            <div class="stats">

                <div class="stat">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Technical Skills</div>
                </div>

                <div class="stat">
                    <div class="stat-number">04+</div>
                    <div class="stat-label">DevOps Projects</div>
                </div>

                <div class="stat">
                    <div class="stat-number">∞</div>
                    <div class="stat-label">Things to Automate</div>
                </div>

                <div class="stat">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Learning Mode</div>
                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     SKILLS
========================================================= -->

<section id="skills">

    <div class="container">

        <div class="section-heading reveal">

            <div>
                <div class="section-label">
                    02 / TECH STACK
                </div>

                <h2>Tools I work with.</h2>
            </div>

            <div class="section-number">
                / stack
            </div>

        </div>


        <div class="skills-grid">

            <?php foreach ($skills as $skill): ?>

                <div class="skill reveal">

                    <div class="skill-top">

                        <div class="skill-name">

                            <span class="skill-icon">
                                <?= htmlspecialchars($skill["icon"]) ?>
                            </span>

                            <?= htmlspecialchars($skill["name"]) ?>

                        </div>

                        <span class="skill-percent">
                            <?= $skill["level"] ?>%
                        </span>

                    </div>

                    <div class="skill-bar">

                        <div
                            class="skill-progress"
                            data-width="<?= $skill["level"] ?>%"
                        ></div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<!-- =========================================================
     EXPERIENCE
========================================================= -->

<section id="experience">

    <div class="container">

        <div class="section-heading reveal">

            <div>
                <div class="section-label">
                    03 / EXPERIENCE
                </div>

                <h2>Where I've worked.</h2>
            </div>

            <div class="section-number">
                / career
            </div>

        </div>


        <div class="timeline">

            <?php foreach ($experience as $job): ?>

                <div class="timeline-item reveal">

                    <div class="timeline-dot"></div>

                    <div class="timeline-period">
                        <?= htmlspecialchars($job["period"]) ?>
                    </div>

                    <h3 class="timeline-title">
                        <?= htmlspecialchars($job["role"]) ?>
                    </h3>

                    <div class="timeline-company">
                        <?= htmlspecialchars($job["company"]) ?>
                    </div>

                    <p class="timeline-description">
                        <?= htmlspecialchars($job["description"]) ?>
                    </p>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<!-- =========================================================
     PROJECTS
========================================================= -->

<section id="projects">

    <div class="container">

        <div class="section-heading reveal">

            <div>
                <div class="section-label">
                    04 / PROJECTS
                </div>

                <h2>Things I've built.</h2>
            </div>

            <div class="section-number">
                / postgres / work
            </div>

        </div>


        <div class="projects-grid">

            <?php if (empty($projects)): ?>

                <article class="project reveal">
                    <div class="project-number">-- /</div>
                    <h3>No projects yet</h3>
                    <p>
                        Add a project to the PostgreSQL
                        <code>projects</code> table and it will appear here automatically.
                    </p>
                </article>

            <?php else: ?>

                <?php foreach ($projects as $index => $project): ?>

                <article class="project reveal">

                    <div class="project-number">
                        #<?= htmlspecialchars($project["id"]) ?> /
                    </div>

                    <h3>
                        <?= htmlspecialchars($project["title"]) ?>
                    </h3>

                    <p>
                        <?= htmlspecialchars($project["description"]) ?>
                    </p>


                    <div class="tags">

                        <?php foreach ($project["tags"] as $tag): ?>

                            <span class="tag">
                                <?= htmlspecialchars($tag) ?>
                            </span>

                        <?php endforeach; ?>

                    </div>


                    <?php if (!empty($project["github"]) && $project["github"] !== "#"): ?>

                        <a
                            href="<?= htmlspecialchars($project["github"]) ?>"
                            target="_blank"
                            class="project-link"
                        >
                            View repository ↗
                        </a>

                    <?php else: ?>

                        <span class="project-link">
                            Infrastructure / DevOps
                        </span>

                    <?php endif; ?>

                </article>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </div>

</section>


<!-- =========================================================
     CERTIFICATIONS
========================================================= -->

<section id="certifications">

    <div class="container">

        <div class="section-heading reveal">

            <div>
                <div class="section-label">
                    05 / CERTIFICATIONS
                </div>

                <h2>Learning & credentials.</h2>
            </div>

            <div class="section-number">
                / learning
            </div>

        </div>


        <div class="cert-grid">

            <?php foreach ($certifications as $cert): ?>

                <div class="cert reveal">

                    <div class="cert-icon">
                        ✓
                    </div>

                    <div>

                        <h3>
                            <?= htmlspecialchars($cert["title"]) ?>
                        </h3>

                        <p>
                            <?= htmlspecialchars($cert["issuer"]) ?>
                        </p>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<!-- =========================================================
     CONTACT
========================================================= -->

<section class="contact" id="contact">

    <div class="container reveal">

        <div class="section-label">
            06 / CONTACT
        </div>

        <h2>
            Let's build something.
        </h2>

        <p>
            I'm interested in DevOps opportunities, internships,
            infrastructure projects and teams building reliable systems.
        </p>


        <div class="contact-links">

            <a
                href="mailto:<?= htmlspecialchars($email) ?>"
                class="contact-link"
            >
                Email ↗
            </a>

            <a
                href="<?= htmlspecialchars($github) ?>"
                target="_blank"
                class="contact-link"
            >
                GitHub ↗
            </a>

            <a
                href="<?= htmlspecialchars($linkedin) ?>"
                target="_blank"
                class="contact-link"
            >
                LinkedIn ↗
            </a>

        </div>

    </div>

</section>

</main>


<!-- =========================================================
     FOOTER
========================================================= -->

<footer>

    <div class="container">

        <div class="footer-content">

            <span>
                © <?= date("Y") ?> <?= htmlspecialchars($name) ?>
            </span>

            <span>
                built with Linux & caffeine
            </span>

        </div>

    </div>

</footer>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

    // -----------------------------------------
    // Navbar scroll effect
    // -----------------------------------------

    const header = document.getElementById("header");

    window.addEventListener("scroll", () => {

        if (window.scrollY > 30) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }

    });


    // -----------------------------------------
    // Scroll reveal
    // -----------------------------------------

    const revealElements =
        document.querySelectorAll(".reveal");

    const observer = new IntersectionObserver(
        (entries) => {

            entries.forEach((entry) => {

                if (entry.isIntersecting) {

                    entry.target.classList.add("visible");

                    observer.unobserve(entry.target);

                }

            });

        },
        {
            threshold: 0.12
        }
    );


    revealElements.forEach((element) => {
        observer.observe(element);
    });


    // -----------------------------------------
    // Skill progress animation
    // -----------------------------------------

    const skillBars =
        document.querySelectorAll(".skill-progress");


    const skillObserver = new IntersectionObserver(
        (entries) => {

            entries.forEach((entry) => {

                if (entry.isIntersecting) {

                    const width =
                        entry.target.getAttribute("data-width");

                    entry.target.style.width = width;

                    skillObserver.unobserve(entry.target);

                }

            });

        },
        {
            threshold: 0.5
        }
    );


    skillBars.forEach((bar) => {
        skillObserver.observe(bar);
    });


    // -----------------------------------------
    // Smooth anchor scrolling
    // -----------------------------------------

    document.querySelectorAll(
        'a[href^="#"]'
    ).forEach((anchor) => {

        anchor.addEventListener("click", function (e) {

            const target =
                document.querySelector(
                    this.getAttribute("href")
                );

            if (!target) return;

            e.preventDefault();

            target.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });

        });

    });


    // -----------------------------------------
    // Small terminal typing effect
    // -----------------------------------------

    const terminal =
        document.querySelector(".terminal");


    if (terminal) {

        terminal.addEventListener(
            "mouseenter",
            () => {

                terminal.style.transform =
                    "perspective(900px) rotateY(0deg) translateY(-4px)";

            }
        );


        terminal.addEventListener(
            "mouseleave",
            () => {

                terminal.style.transform =
                    "perspective(900px) rotateY(-4deg)";

            }
        );

    }

</script>

</body>
</html>