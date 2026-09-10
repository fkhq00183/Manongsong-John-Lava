<!DOCTYPE html>
<html>
<head>
    <title>Student Info by John Judel</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/kinich.css') ?>">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Share+Tech+Mono&display=swap');

    * {
        box-sizing: border-box;
    }

    :root {
        --bg: #06120e;
        --bg2: #0b2118;
        --panel: #102d21;
        --green: #b7f34a;
        --green2: #75a934;
        --cyan: #48e0c2;
        --yellow: #f5d65c;
        --text: #e8f6df;
        --muted: #8fa99a;
        --line: #294b3c;
        --shadow: #020705;
    }

    body {
        margin: 0;
        min-height: 100vh;

        font-family: 'Share Tech Mono', monospace;

        color: var(--text);

        background:
            radial-gradient(
                circle at 50% 20%,
                rgba(61, 130, 75, 0.20),
                transparent 35%
            ),
            radial-gradient(
                circle at 10% 90%,
                rgba(72, 224, 194, 0.08),
                transparent 30%
            ),
            linear-gradient(
                135deg,
                #06120e,
                #0a1c15 50%,
                #06110d
            );

        position: relative;
        overflow-x: hidden;
    }

    /* =========================
       PIXEL SCANLINES
    ========================= */

    body::before {
        content: "";
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 999;

        background:
            repeating-linear-gradient(
                0deg,
                rgba(255, 255, 255, 0.025) 0px,
                rgba(255, 255, 255, 0.025) 1px,
                transparent 1px,
                transparent 4px
            );

        opacity: 0.3;
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

        background: rgba(4, 14, 11, 0.97);

        border-bottom: 2px solid var(--green2);

        box-shadow:
            0 5px 0 var(--shadow);
    }

    .navbar::before {
        content: "◆";
        color: var(--green);
        margin-right: 12px;
        font-size: 11px;
    }

    .navbar::after {
        content: "◆";
        color: var(--green);
        margin-left: 12px;
        font-size: 11px;
    }

    .navbar a {
        color: var(--muted);

        text-decoration: none;

        margin: 0;
        padding: 10px 16px;

        font-family: 'Press Start 2P', monospace;
        font-size: 9px;

        border: 1px solid transparent;

        transition: 0.2s ease;
    }

    .navbar a:hover {
        color: var(--green);

        background: #10291f;

        border-color: var(--green);

        transform: translate(-2px, -2px);

        box-shadow:
            4px 4px 0 var(--shadow);
    }

    /* =========================
       HERO
    ========================= */

    .hero {
        position: relative;
        overflow: hidden;

        width: 92%;
        max-width: 900px;

        margin: 70px auto 40px;

        padding: 65px 35px;

        text-align: center;

        background:
            linear-gradient(
                145deg,
                rgba(17, 51, 38, 0.98),
                rgba(7, 25, 19, 0.98)
            );

        border: 2px solid var(--green);

        box-shadow:
            10px 10px 0 var(--shadow),
            0 0 35px rgba(183, 243, 74, 0.07);

        clip-path: polygon(
            0 14px,
            14px 14px,
            14px 0,
            calc(100% - 14px) 0,
            calc(100% - 14px) 14px,
            100% 14px,
            100% calc(100% - 14px),
            calc(100% - 14px) calc(100% - 14px),
            calc(100% - 14px) 100%,
            14px 100%,
            14px calc(100% - 14px),
            0 calc(100% - 14px)
        );
    }

    /* Decorative corner data */

    .hero::before {
        content: "SYSTEM // STUDENT DATABASE";
        position: absolute;

        top: 18px;
        left: 25px;

        color: var(--cyan);

        font-family: 'Press Start 2P', monospace;
        font-size: 7px;

        opacity: 0.8;
    }

    .hero::after {
        content: "ONLINE";

        position: absolute;

        top: 18px;
        right: 25px;

        color: var(--green);

        font-family: 'Press Start 2P', monospace;
        font-size: 7px;

        text-shadow:
            0 0 8px rgba(183, 243, 74, 0.5);
    }

    /* =========================
       AVATAR
    ========================= */

    .avatar {
        position: relative;

        width: 115px;
        height: 115px;

        margin: 10px auto 30px;

        display: flex;
        align-items: center;
        justify-content: center;

        background:
            linear-gradient(
                135deg,
                #a8e94c,
                #4e8e2e
            );

        color: #07130f;

        border: 4px solid var(--green);

        outline: 3px solid #102d21;

        font-family: 'Press Start 2P', monospace;

        font-size: 20px;

        box-shadow:
            6px 6px 0 var(--shadow),
            0 0 25px rgba(183, 243, 74, 0.15);

        clip-path: polygon(
            14px 0,
            calc(100% - 14px) 0,
            calc(100% - 14px) 8px,
            100% 8px,
            100% calc(100% - 8px),
            calc(100% - 14px) calc(100% - 8px),
            calc(100% - 14px) 100%,
            14px 100%,
            14px calc(100% - 8px),
            0 calc(100% - 8px),
            0 8px,
            14px 8px
        );
    }

    /* Small pixel decorations around avatar */

    .avatar::before {
        content: "◆";
        position: absolute;

        top: -22px;
        left: -35px;

        color: var(--yellow);
        font-size: 12px;
    }

    .avatar::after {
        content: "◆";
        position: absolute;

        bottom: -22px;
        right: -35px;

        color: var(--cyan);
        font-size: 12px;
    }

    /* =========================
       TITLE
    ========================= */

    h1 {
        margin: 0;

        color: var(--green);

        font-family: 'Press Start 2P', monospace;

        font-size: clamp(18px, 4vw, 30px);

        line-height: 1.7;

        text-shadow:
            4px 4px 0 #1b3b27;
    }

    h1::before {
        content: "> ";
        color: var(--yellow);
    }

    .subtitle {
        margin: 20px auto;

        max-width: 650px;

        color: var(--muted);

        font-size: 15px;

        line-height: 1.9;
    }

    /* =========================
       STATUS BAR
    ========================= */

    .hero .subtitle::before {
        content: "STATUS: ACTIVE";
        display: block;

        margin-bottom: 15px;

        color: var(--cyan);

        font-family: 'Press Start 2P', monospace;
        font-size: 8px;
    }

    /* =========================
       BUTTON
    ========================= */

    .button {
        position: relative;

        display: inline-block;

        margin-top: 20px;

        padding: 16px 24px;

        background: var(--green);

        color: #07130f;

        text-decoration: none;

        font-family: 'Press Start 2P', monospace;

        font-size: 9px;

        border: 2px solid #d8ff8a;

        box-shadow:
            6px 6px 0 var(--shadow);

        transition: 0.2s ease;
    }

    .button::before {
        content: "▶ ";
        color: #07130f;
    }

    .button:hover {
        background: var(--yellow);

        transform: translate(-3px, -3px);

        box-shadow:
            9px 9px 0 var(--shadow);
    }

    /* =========================
       FOOTER
    ========================= */

    .footer {
        text-align: center;

        padding: 25px 20px 40px;

        color: #607c6c;

        font-size: 11px;

        letter-spacing: 1px;
    }

    .footer::before {
        content: "◆ ───────── ◆ ───────── ◆";
        display: block;

        color: var(--green2);

        font-family: 'Press Start 2P', monospace;
        font-size: 7px;

        margin-bottom: 18px;
    }

    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 600px) {

        .navbar {
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

        .hero {
            margin-top: 50px;
            padding: 55px 18px 45px;
        }

        .hero::before {
            left: 15px;
            font-size: 6px;
        }

        .hero::after {
            right: 15px;
            font-size: 6px;
        }

        .avatar {
            width: 90px;
            height: 90px;

            font-size: 14px;
        }

        h1 {
            font-size: 16px;
        }

        .subtitle {
            font-size: 12px;
            line-height: 1.8;
        }

        .button {
            width: 100%;
            font-size: 8px;
            padding: 15px 10px;
        }

        .footer {
            font-size: 9px;
        }

        .footer::before {
            font-size: 5px;
        }
    }
</style>
</head>

<body>

<div class="navbar">
    <a href="<?= site_url('student'); ?>">Home</a>
    <a href="<?= site_url('student/profile'); ?>">Student Profile</a>
</div>

<div class="hero">

    <div class="avatar">
        JJM
    </div>

    <h1>Welcome to Student Info</h1>

    <p class="subtitle">
        A personal student information page built with LavaLust.
        This includes my studies, skills, hobbies, interest and social media.<br>
        [ps. Design is one and only made by AI]
    </p>

    <a class="button" href="<?= site_url('student/profile'); ?>">
        Explore My Profile
    </a>

    <a class="button" href="<?= site_url('products/login'); ?>">
        Product Login
    </a>

</div>

<div class="footer">
    Student Info using Lavalust | By John Judel
</div>

</body>
</html>
