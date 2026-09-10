<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied | Student Portal</title>

   <style>
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Share+Tech+Mono&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --bg: #050d09;
        --panel: #0b2118;
        --panel2: #102d21;

        --green: #b7f34a;
        --green-dark: #638f32;

        --cyan: #48e0c2;
        --yellow: #f5d65c;

        --red: #ff6b5e;

        --text: #e8f6df;
        --muted: #8fa99a;

        --line: #294b3c;
        --shadow: #020705;
    }

    body {
        font-family: 'Share Tech Mono', monospace;

        background:
            radial-gradient(
                circle at 50% 40%,
                rgba(63, 129, 74, 0.18),
                transparent 35%
            ),
            linear-gradient(
                135deg,
                #050d09,
                #0a1d15,
                #050d09
            );

        color: var(--text);

        min-height: 100vh;

        display: flex;
        align-items: center;
        justify-content: center;

        overflow: hidden;

        position: relative;
    }

    /* =========================
       SCANLINE EFFECT
    ========================= */

    body::before {
        content: "";

        position: fixed;
        inset: 0;

        pointer-events: none;

        background:
            repeating-linear-gradient(
                0deg,
                rgba(255,255,255,0.025) 0px,
                rgba(255,255,255,0.025) 1px,
                transparent 1px,
                transparent 4px
            );

        opacity: 0.35;

        z-index: 10;
    }

    /* =========================
       BACKGROUND PIXELS
    ========================= */

    body::after {
        content: "◆     ◆          ◆     ◆";

        position: fixed;

        width: 100%;

        bottom: 30px;

        text-align: center;

        color: var(--green);

        font-family: 'Press Start 2P', monospace;
        font-size: 8px;

        letter-spacing: 5px;

        opacity: 0.25;
    }

    /* =========================
       MAIN CONTAINER
    ========================= */

    .container {
        position: relative;

        width: 92%;
        max-width: 560px;

        padding: 35px 35px 30px;

        text-align: center;

        background:
            linear-gradient(
                145deg,
                rgba(16, 45, 33, 0.98),
                rgba(6, 22, 16, 0.98)
            );

        border: 2px solid var(--green);

        box-shadow:
            9px 9px 0 var(--shadow),
            0 0 35px rgba(183, 243, 74, 0.08);

        /* Pixel corners */
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

    /* =========================
       SYSTEM HEADER
    ========================= */

    .container::before {
        content: "STUDENT PORTAL // SECURITY SYSTEM";

        display: block;

        margin-bottom: 10px;

        color: var(--cyan);

        font-family: 'Press Start 2P', monospace;

        font-size: 7px;

        letter-spacing: 1px;
    }

    .container::after {
        content: "SECURITY LEVEL: 03";

        position: absolute;

        top: 17px;
        right: 20px;

        color: var(--yellow);

        font-family: 'Press Start 2P', monospace;

        font-size: 6px;

        opacity: 0.8;
    }

    /* =========================
       CHARACTER GIF
    ========================= */

    .icon {
        width: 175px;
        height: 175px;

        margin: 15px auto 20px;

        display: flex;
        align-items: center;
        justify-content: center;

        background:
            radial-gradient(
                circle,
                #183e2c,
                #081b13 70%
            );

        border: 2px solid var(--green);

        box-shadow:
            5px 5px 0 var(--shadow),
            inset 0 0 25px rgba(183,243,74,0.08);

        overflow: hidden;

        /* Pixel frame */
        clip-path: polygon(
            12px 0,
            calc(100% - 12px) 0,
            calc(100% - 12px) 7px,
            100% 7px,
            100% calc(100% - 7px),
            calc(100% - 12px) calc(100% - 7px),
            calc(100% - 12px) 100%,
            12px 100%,
            12px calc(100% - 7px),
            0 calc(100% - 7px),
            0 7px,
            12px 7px
        );
    }

    .icon img {
        width: 100%;
        height: 100%;

        object-fit: cover;

        image-rendering: pixelated;

        filter:
            saturate(1.15)
            contrast(1.05);

        transform: scale(1.03);
    }

    /* =========================
       SECURITY STATUS
    ========================= */

    .security-status {
        margin: 5px auto 20px;

        display: inline-flex;

        align-items: center;

        gap: 8px;

        padding: 7px 12px;

        background: #251815;

        border: 1px solid var(--red);

        color: var(--red);

        font-family: 'Press Start 2P', monospace;

        font-size: 7px;
    }

    .security-status::before {
        content: "●";

        font-size: 8px;

        animation: blink 1s infinite;
    }

    @keyframes blink {
        0%, 45% {
            opacity: 1;
        }

        46%, 100% {
            opacity: 0.2;
        }
    }

    /* =========================
       TITLE
    ========================= */

    h1 {
        font-family: 'Press Start 2P', monospace;

        font-size: clamp(18px, 4vw, 25px);

        line-height: 1.7;

        color: var(--green);

        margin-bottom: 12px;

        text-shadow:
            3px 3px 0 #1b3b27;
    }

    h1::before {
        content: "> ";

        color: var(--red);
    }

    p {
        color: var(--muted);

        line-height: 1.8;

        font-size: 14px;

        margin-bottom: 22px;
    }

    /* =========================
       NOTICE BOX
    ========================= */

    .notice {
        position: relative;

        background: #081a13;

        border: 1px dashed var(--line);

        border-left: 4px solid var(--yellow);

        padding: 17px;

        margin-bottom: 25px;

        text-align: left;

        color: var(--muted);

        font-size: 13px;

        line-height: 1.7;
    }

    .notice::before {
        content: "SYSTEM MESSAGE";

        display: block;

        margin-bottom: 9px;

        color: var(--yellow);

        font-family: 'Press Start 2P', monospace;

        font-size: 7px;
    }

    .notice strong {
        color: var(--green);

        font-family: 'Press Start 2P', monospace;

        font-size: 8px;

        line-height: 1.8;
    }

    /* =========================
       BUTTON
    ========================= */

    .button {
        display: inline-block;

        padding: 15px 20px;

        background: var(--green);

        color: #07130f;

        text-decoration: none;

        font-family: 'Press Start 2P', monospace;

        font-size: 8px;

        border: 2px solid #d8ff8a;

        box-shadow:
            5px 5px 0 var(--shadow);

        transition: 0.2s ease;
    }

    .button::before {
        content: "◀ ";
    }

    .button:hover {
        background: var(--yellow);

        transform: translate(-3px, -3px);

        box-shadow:
            8px 8px 0 var(--shadow);
    }

    /* =========================
       FOOTER
    ========================= */

    .footer {
        margin-top: 25px;

        padding-top: 17px;

        border-top: 1px dashed var(--line);

        font-size: 9px;

        color: #607c6c;

        font-family: 'Press Start 2P', monospace;

        line-height: 1.8;
    }

    .footer::before {
        content: "◆  ◆  ◆";

        display: block;

        color: var(--green-dark);

        margin-bottom: 10px;

        font-size: 7px;

        letter-spacing: 5px;
    }

    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 600px) {

        body {
            padding: 20px 0;
            overflow-y: auto;
        }

        .container {
            width: 92%;

            padding: 30px 20px 25px;

            box-shadow:
                6px 6px 0 var(--shadow);
        }

        .container::before {
            font-size: 5px;
        }

        .container::after {
            display: none;
        }

        .icon {
            width: 140px;
            height: 140px;
        }

        h1 {
            font-size: 15px;
        }

        p {
            font-size: 12px;
        }

        .notice {
            font-size: 11px;
        }

        .button {
            width: 100%;

            font-size: 7px;

            padding: 15px 8px;
        }

        .footer {
            font-size: 7px;
        }
    }
</style>
</head>

<body>

    <div class="container">

        <div class="icon">
            <img
        src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExeTV0bDYweGo5ZWdxaWJycWhxeWFyMnA4a2h0NmZsMmFrbmQ3bWkzcSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/5CHHlkMODs3hOYOyoF/giphy.gif">
        </div>
        <div class="security-status">
    ACCESS RESTRICTED
</div>

        <h1>Access Denied</h1>

        <p>
            You currently don't have permission to access
            the Student Profile.
        </p>

        <div class="notice">
            <strong>Student Profile Restricted</strong><br>
            Please contact the administrator if you believe
            you should have access to this page.
        </div>

        <a href="<?= site_url('student') ?>" class="button">
            Back to Student Page
        </a>

        <div class="footer">
            Student Portal
        </div>

    </div>

</body>
</html>
