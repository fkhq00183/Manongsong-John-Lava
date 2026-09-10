<!DOCTYPE html>
<html>
<head>
    <title>Student Profile by John Judel</title>

   <style>
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Share+Tech+Mono&display=swap');

    * {
        box-sizing: border-box;
    }

    :root {
        --bg: #07130f;
        --bg2: #0b1d17;
        --panel: #102820;
        --panel-light: #16362b;
        --green: #b7f34a;
        --green-dark: #6fa52e;
        --cyan: #48e0c2;
        --yellow: #f5d65c;
        --text: #e6f5dc;
        --muted: #91aa9c;
        --line: #284b3c;
        --pixel-shadow: #020705;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        margin: 0;
        min-height: 100vh;
        font-family: 'Share Tech Mono', monospace;
        background:
            linear-gradient(rgba(7, 19, 15, 0.94), rgba(7, 19, 15, 0.98)),
            radial-gradient(circle at 20% 10%, #24533d 0, transparent 30%),
            radial-gradient(circle at 80% 80%, #153e31 0, transparent 30%);
        color: var(--text);
        position: relative;
        overflow-x: hidden;
    }

    /* Pixel / scanline atmosphere */
    body::before {
        content: "";
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 999;
        background:
            repeating-linear-gradient(
                0deg,
                rgba(255,255,255,0.025) 0px,
                rgba(255,255,255,0.025) 1px,
                transparent 1px,
                transparent 4px
            );
        opacity: 0.25;
    }

    /* =========================
       NAVBAR
    ========================= */

    .navbar {
        position: sticky;
        top: 0;
        z-index: 100;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 14px;
        background: rgba(5, 15, 12, 0.96);
        border-bottom: 2px solid var(--green-dark);
        box-shadow: 0 5px 0 rgba(0, 0, 0, 0.4);
    }

    .navbar::before {
        content: "◆";
        color: var(--green);
        margin-right: 12px;
        font-size: 12px;
    }

    .navbar::after {
        content: "◆";
        color: var(--green);
        margin-left: 12px;
        font-size: 12px;
    }

    .navbar a {
        color: var(--muted);
        text-decoration: none;
        padding: 10px 16px;
        font-family: 'Press Start 2P', monospace;
        font-size: 9px;
        text-transform: uppercase;
        border: 1px solid transparent;
        transition: 0.2s ease;
    }

    .navbar a:hover {
        color: var(--green);
        border-color: var(--green);
        background: #122b21;
        box-shadow: 3px 3px 0 var(--pixel-shadow);
        transform: translate(-2px, -2px);
    }

    /* =========================
       MAIN CONTAINER
    ========================= */

    .profile {
        width: 92%;
        max-width: 900px;
        margin: 45px auto 70px;
    }

    /* =========================
       HEADER
    ========================= */

    .header-card {
        position: relative;
        overflow: hidden;
        padding: 45px 30px;
        text-align: center;
        margin-bottom: 25px;

        background:
            linear-gradient(
                135deg,
                rgba(20, 61, 45, 0.95),
                rgba(8, 28, 22, 0.98)
            );

        border: 2px solid var(--green);
        box-shadow:
            8px 8px 0 var(--pixel-shadow),
            0 0 25px rgba(183, 243, 74, 0.08);

        /* Pixel corners */
        clip-path: polygon(
            0 12px,
            12px 12px,
            12px 0,
            calc(100% - 12px) 0,
            calc(100% - 12px) 12px,
            100% 12px,
            100% calc(100% - 12px),
            calc(100% - 12px) calc(100% - 12px),
            calc(100% - 12px) 100%,
            12px 100%,
            12px calc(100% - 12px),
            0 calc(100% - 12px)
        );
    }

    .header-card::before {
        content: "PLAYER PROFILE // SYSTEM ONLINE";
        display: block;
        margin-bottom: 25px;
        color: var(--cyan);
        font-family: 'Press Start 2P', monospace;
        font-size: 8px;
        letter-spacing: 1px;
    }

    .header-card::after {
        content: "01";
        position: absolute;
        right: 20px;
        bottom: 10px;
        font-family: 'Press Start 2P', monospace;
        font-size: 42px;
        color: rgba(183, 243, 74, 0.06);
    }

    /* =========================
       AVATAR
    ========================= */

    .avatar {
        width: 110px;
        height: 110px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;

        background:
            linear-gradient(
                135deg,
                #9fe33f,
                #4e8f2e
            );

        color: #07130f;
        border: 4px solid var(--green);
        outline: 3px solid #102820;

        font-family: 'Press Start 2P', monospace;
        font-size: 20px;
        font-weight: bold;

        box-shadow:
            5px 5px 0 var(--pixel-shadow),
            0 0 20px rgba(183, 243, 74, 0.18);

        /* Pixel-style shape */
        clip-path: polygon(
            12px 0,
            calc(100% - 12px) 0,
            calc(100% - 12px) 8px,
            100% 8px,
            100% calc(100% - 8px),
            calc(100% - 12px) calc(100% - 8px),
            calc(100% - 12px) 100%,
            12px 100%,
            12px calc(100% - 8px),
            0 calc(100% - 8px),
            0 8px,
            12px 8px
        );
    }

    h1 {
        margin: 25px 0 10px;
        color: var(--green);
        font-family: 'Press Start 2P', monospace;
        font-size: clamp(17px, 3vw, 26px);
        line-height: 1.7;
        text-shadow:
            3px 3px 0 #1d3b28;
    }

    .subtitle {
        color: var(--cyan);
        font-size: 15px;
        letter-spacing: 1px;
    }

    /* =========================
       CARDS
    ========================= */

    .card {
        position: relative;
        background:
            linear-gradient(
                145deg,
                rgba(18, 44, 34, 0.98),
                rgba(10, 29, 22, 0.98)
            );

        padding: 28px;
        margin-bottom: 22px;

        border: 1px solid var(--line);
        border-left: 4px solid var(--green);

        box-shadow:
            6px 6px 0 var(--pixel-shadow);

        transition: 0.2s ease;
    }

    .card:hover {
        border-color: var(--green);
        border-left-color: var(--yellow);
        transform: translate(-3px, -3px);
        box-shadow:
            9px 9px 0 var(--pixel-shadow),
            0 0 20px rgba(183, 243, 74, 0.06);
    }

    .card h2 {
        margin: 0 0 20px;
        padding-bottom: 12px;

        color: var(--green);
        font-family: 'Press Start 2P', monospace;
        font-size: 14px;
        line-height: 1.6;

        border-bottom: 2px dashed var(--line);
    }

    .card h2::before {
        content: "> ";
        color: var(--yellow);
    }

    /* =========================
       INFORMATION
    ========================= */

    .info {
        display: flex;
        justify-content: space-between;
        gap: 25px;
        padding: 14px 5px;
        border-bottom: 1px solid #1c3a2e;
    }

    .info:last-child {
        border-bottom: none;
    }

    .label {
        color: var(--yellow);
        font-family: 'Press Start 2P', monospace;
        font-size: 8px;
        line-height: 1.7;
        min-width: 150px;
    }

    .label::before {
        content: "◆ ";
        color: var(--green);
    }

    .value {
        text-align: right;
        color: var(--text);
        font-size: 14px;
        line-height: 1.6;
        word-break: break-word;
    }

    /* =========================
       ABOUT
    ========================= */

    .about {
        position: relative;
        line-height: 1.8;
        color: var(--muted);
        padding: 18px;
        margin-bottom: 18px;

        background: #091c15;
        border: 1px dashed var(--line);
    }

    .about::before {
        content: "BIO_DATA";
        display: block;
        color: var(--cyan);
        font-family: 'Press Start 2P', monospace;
        font-size: 8px;
        margin-bottom: 12px;
    }

    /* =========================
       SOCIAL LINKS
    ========================= */

    .social-links {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .social-links a {
        position: relative;
        display: inline-block;

        padding: 13px 20px;

        background: #0a2119;
        color: var(--green);

        text-decoration: none;
        font-family: 'Press Start 2P', monospace;
        font-size: 9px;

        border: 1px solid var(--green);

        box-shadow: 4px 4px 0 var(--pixel-shadow);
        transition: 0.2s ease;
    }

    .social-links a:hover {
        background: var(--green);
        color: #07130f;

        transform: translate(-3px, -3px);

        box-shadow:
            7px 7px 0 var(--pixel-shadow);
    }

    /* =========================
       BACK BUTTON
    ========================= */

    .back-button {
        display: block;
        width: fit-content;
        margin: 35px auto 0;

        padding: 15px 22px;

        background: var(--green);
        color: #07130f;

        text-decoration: none;

        font-family: 'Press Start 2P', monospace;
        font-size: 9px;

        border: 2px solid #d9ff8a;

        box-shadow:
            5px 5px 0 var(--pixel-shadow);

        transition: 0.2s ease;
    }

    .back-button:hover {
        background: var(--yellow);
        transform: translate(-3px, -3px);
        box-shadow:
            8px 8px 0 var(--pixel-shadow);
    }

    /* =========================
       DECORATIVE PIXEL ELEMENT
    ========================= */

    .profile::before {
        content: "◆  ◆  ◆";
        display: block;
        text-align: center;
        color: var(--green);
        font-family: 'Press Start 2P', monospace;
        font-size: 9px;
        letter-spacing: 8px;
        margin-bottom: 25px;
        opacity: 0.6;
    }

    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 600px) {

        .navbar {
            gap: 3px;
            padding: 10px 5px;
        }

        .navbar::before,
        .navbar::after {
            display: none;
        }

        .navbar a {
            padding: 9px 8px;
            font-size: 7px;
        }

        .profile {
            width: 92%;
            margin-top: 30px;
        }

        .header-card {
            padding: 35px 18px;
        }

        .avatar {
            width: 90px;
            height: 90px;
            font-size: 14px;
        }

        h1 {
            font-size: 15px;
        }

        .subtitle {
            font-size: 12px;
            line-height: 1.7;
        }

        .card {
            padding: 20px 16px;
        }

        .card h2 {
            font-size: 11px;
        }

        .info {
            flex-direction: column;
            gap: 7px;
        }

        .label {
            min-width: auto;
        }

        .value {
            text-align: left;
        }

        .social-links {
            flex-direction: column;
        }

        .social-links a {
            text-align: center;
        }
    }
</style>
</head>

<body>

<?php
$student_id = isset($student_id) ? $student_id : '';
$name = isset($name) ? $name : '';
$course = isset($course) ? $course : '';
$year = isset($year) ? $year : '';
$section = isset($section) ? $section : '';
$email = isset($email) ? $email : '';
$contact = isset($contact) ? $contact : '';
$address = isset($address) ? $address : '';
$skills = isset($skills) ? $skills : '';
$hobbies = isset($hobbies) ? $hobbies : '';
$description = isset($description) ? $description : '';
$facebook = isset($facebook) ? $facebook : '';
$instagram = isset($instagram) ? $instagram : '';
$github = isset($github) ? $github : '';
?>

<div class="navbar">
    <a href="<?= site_url('student'); ?>">Home</a>
    <a href="<?= site_url('student/profile'); ?>">Student Profile</a>
</div>

<div class="profile">

    <!-- Profile Header -->
    <div class="header-card">
        <div class="avatar">Jjm</div>

        <h1>Judel's Digital Student Profile</h1>

        <div class="subtitle">
            Bachelor Of Science in Information Technology Student
        </div>
    </div>

    <!-- Personal Information -->
    <div class="card">
        <h2>Personal Information</h2>

        <div class="info">
            <span class="label">Student ID</span>
            <span class="value"><?= $student_id ?></span>
        </div>

        <div class="info">
            <span class="label">Student Name</span>
            <span class="value"><?= $name ?></span>
        </div>

        <div class="info">
            <span class="label">Course</span>
            <span class="value"><?= $course ?></span>
        </div>

        <div class="info">
            <span class="label">Year Level</span>
            <span class="value"><?= $year ?></span>
        </div>

        <div class="info">
            <span class="label">Section</span>
            <span class="value"><?= $section ?></span>
        </div>

        <div class="info">
            <span class="label">Email</span>
            <span class="value"><?= $email ?></span>
        </div>

        <div class="info">
            <span class="label">Contact Number</span>
            <span class="value"><?= $contact ?></span>
        </div>

        <div class="info">
            <span class="label">Address</span>
            <span class="value"><?= $address ?></span>
        </div>
    </div>

    <!-- About Me -->
    <div class="card">
        <h2>About Me</h2>

        <p class="about">
            <?= $description ?>
        </p>

        <div class="info">
            <span class="label">Skills</span>
            <span class="value"><?= $skills ?></span>
        </div>

        <div class="info">
            <span class="label">Hobbies</span>
            <span class="value"><?= $hobbies ?></span>
        </div>
    </div>

    <!-- Social Media -->
    <div class="card">
        <h2>Social Media</h2>

        <div class="social-links">

            <a href="<?= $Instagram ?>" target="_blank">
                Instagram
            </a>

            <a href="<?= $github ?>" target="_blank">
                GitHub
            </a>

        </div>
    </div>

    <a class="back-button" href="<?= site_url('student'); ?>">
        Back to Student Info
    </a>

</div>

</body>
</html>
